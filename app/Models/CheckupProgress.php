<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckupProgress extends Model {
    protected $fillable = ['appointment_id', 'service_id', 'status'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
