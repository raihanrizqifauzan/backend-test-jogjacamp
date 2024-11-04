<?php

namespace App\Repositories;

use App\Models\Appointment;
use App\Models\CheckupProgress;
use App\Models\Service;
use App\Jobs\ProcessCheckupProgress;
use App\Repositories\Contracts\AppointmentRepositoryInterface;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    public function create(array $data)
    {
        $appointment = Appointment::create([
            'patient_id' => $data['patient_id'],
            'diagnose_id' => $data['diagnose_id'],
            'status' => 0,
        ]);

        ProcessCheckupProgress::dispatch($appointment);

        return $appointment;
    }

    public function findById($id)
    {
        return Appointment::with([
            'patient:id,name',
            'diagnose:id,name',
            'checkupProgress' => function ($query) {
                $query->with('service:id,name');
            }
        ])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'patient_id' => $data['patient_id'],
            'diagnose_id' => $data['diagnose_id'],
            'status' => $data['status'],
        ]);

        return $appointment;
    }
}
