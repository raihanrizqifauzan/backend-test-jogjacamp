<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Appointment",
 *     description="Appointment model",
 *     @OA\Xml(name="Appointment")
 * )
 */
class Appointment extends Model {
    protected $fillable = ['patient_id', 'diagnose_id', 'status'];
    
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID of the appointment",
     *     example=1,
     *     type="integer"
     * )
     */
    private $id;

    /**
     * @OA\Property(
     *     title="Patient ID",
     *     description="ID of the patient",
     *     example=1,
     *     type="integer"
     * )
     */
    private $patient_id;

    /**
     * @OA\Property(
     *     title="Diagnose ID",
     *     description="ID of the diagnose",
     *     example=1,
     *     type="integer"
     * )
     */
    private $diagnose_id;

    /**
     * @OA\Property(
     *     title="Status",
     *     description="Status of the appointment (0 = ongoing, 1 = completed)",
     *     example=0,
     *     type="integer"
     * )
     */
    private $status;
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    public function diagnose()
    {
        return $this->belongsTo(Diagnose::class);
    }

    public function checkupProgress()
    {
        return $this->hasMany(CheckupProgress::class);
    }
}