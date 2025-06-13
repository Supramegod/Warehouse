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
            echo "📨 Received message on topic [{$topic}]: {$textId}\n";

            $data = PenataanGudang::where('text_id', $textId)
                ->whereNull('status')
                ->orderBy('id')
                ->first();

            if ($data) {
                echo "✅ Data ditemukan untuk text_id: {$textId}\n";
                echo "📤 Mengirim ke rak/tujuan dengan koordinat_x: {$data->koordinat_x}\n";

                $this->mqtt->publish('rak/tujuan', $data->koordinat_x, 0);

                // Subscribe ke status
                echo "⏳ Menunggu konfirmasi dari rak/status...\n";
                $this->mqtt->subscribe('rak/status', function ($topic, $statusMessage) use ($data) {
                    echo "📥 Status dari rak: {$statusMessage}\n";

                    if (strtolower($statusMessage) === 'ok') {
                        $data->status = 'Sudah Masuk Rak';
                        $data->save();
                        echo "✅ Barang ditandai sebagai 'Sudah Masuk Rak'\n";
                    } else {
                        echo "⚠️ Status tidak dikenali: {$statusMessage}\n";
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
