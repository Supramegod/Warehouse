<?php

namespace App\Services;

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Models\PenataanGudang;

class MqttService
{
    protected $mqtt;

    public function __construct()
    {
        $host = 'broker.emqx.io';
        $port = 1883;
        $clientId = 'laravel_mqtt_client_' . uniqid();
        $username = 'rehan';
        $password = 'qwert';

        $settings = (new ConnectionSettings)
            ->setUsername($username)
            ->setPassword($password);

        $this->mqtt = new MqttClient($host, $port, $clientId);

        echo "🚀 Menghubungkan ke MQTT broker...\n";
        $this->mqtt->connect($settings, true);
        echo "✅ MQTT connected successfully to {$host}:{$port}\n";
    }

    public function subscribeAndHandle()
    {
        echo "📡 Subscribing to topic: qr/hasil\n";

        $this->mqtt->subscribe('qr/hasil', function (string $topic, string $textId) {

            $startReceive = microtime(true);
            echo "[📥] Menerima message pada topic [{$topic}]: {$textId}\n";

            $data = PenataanGudang::where('text_id', $textId)
                ->whereNull('status')
                ->orderBy('id')
                ->first();

            if ($data) {
                $beforePublish = microtime(true);
                $durationReceiveToSend = $beforePublish - $startReceive;

                echo "✅ Data ditemukan untuk text_id: {$textId}\n";
                echo "⏱️ Waktu dari terima text_id hingga publish ke rak/tujuan: " . number_format($durationReceiveToSend, 3) . " detik\n";

                echo "📤 Mengirim ke rak/tujuan dengan koordinat_x: {$data->koordinat_x}\n";
                $this->mqtt->publish('rak/tujuan', $data->koordinat_x, 0);

                $afterPublish = microtime(true);
                echo "⏳ Menunggu konfirmasi dari rak/status...\n";

                $this->mqtt->subscribe('rak/status', function ($topic, $statusMessage) use ($data, $afterPublish) {
                    $afterStatus = microtime(true);
                    $durationPublishToStatus = $afterStatus - $afterPublish;

                    echo "📥 Pesan diterima dari rak/status: {$statusMessage}\n";

                    // Decode JSON
                    $payload = json_decode($statusMessage, true);

                    if (is_array($payload) && isset($payload['status'])) {
                        $status = strtolower($payload['status']);
                        $rak = $payload['rak'] ?? '-';
                        $waktu = $payload['waktu'] ?? '-';

                        echo "📦 Status: {$status}, Rak: {$rak}, Waktu dari perangkat: {$waktu}\n";
                        echo "⏱️ Waktu dari publish ke rak/tujuan hingga terima status: " . number_format($durationPublishToStatus, 3) . " detik\n";

                        if ($status === 'selesai') {
                            $data->status = 'Sudah Masuk Rak';
                            $data->save();
                            echo "✅ Barang ditandai sebagai 'Sudah Masuk Rak'\n";
                        } else {
                            echo "⚠️ Status belum selesai: {$status}\n";
                        }
                    } else {
                        echo "❌ Format pesan tidak valid atau tidak dikenali\n";
                    }
                }, 0);

                $this->mqtt->loop(true); // untuk menunggu status
            } else {
                echo "⚠️ Tidak ada data ditemukan untuk text_id: {$textId} atau sudah diproses.\n";
            }
        }, 0);

        // Loop utama
        $this->mqtt->loop(true);
    }

    public function disconnect()
    {
        echo "🔌 Disconnecting from MQTT broker...\n";
        $this->mqtt->disconnect();
    }
}
