<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MqttService;

class MqttSubscribe extends Command
{
    protected $signature = 'mqtt:listen';
    protected $description = 'Listen and handle MQTT messages';

    public function handle(MqttService $mqttService)
    {
        $mqttService->subscribeAndHandle();
    }
}
