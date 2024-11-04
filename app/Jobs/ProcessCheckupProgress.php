<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\CheckupProgress;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCheckupProgress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function handle()
    {
        $services = match($this->appointment->diagnose->name) {
            'Ringan' => ['obat'],
            'Berat' => ['obat', 'rawat inap'],
            'Kritis' => ['obat', 'rawat inap', 'icu'],
        };

        foreach ($services as $serviceName) {
            $service = Service::where('name', $serviceName)->first();
            if ($service) {
                CheckupProgress::create([
                    'appointment_id' => $this->appointment->id,
                    'service_id' => $service->id,
                    'status' => 0,
                ]);
            }
        }
    }
}

