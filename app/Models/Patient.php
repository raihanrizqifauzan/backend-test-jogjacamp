<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Patient",
 *     description="Patient model",
 *     @OA\Xml(name="Patient")
 * )
 */
class Patient extends Model
{
    protected $fillable = ['name'];
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID of the patient",
     *     example=1,
     *     type="integer"
     * )
     */
    private $id;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Name of the patient",
     *     example="John Doe",
     *     type="string"
     * )
     */
    private $name;
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
