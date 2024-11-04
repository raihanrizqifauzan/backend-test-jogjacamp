<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Service",
 *     description="Service model",
 *     @OA\Xml(name="Service")
 * )
 */
class Service extends Model {
    protected $fillable = ['name'];

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID of the service",
     *     example=1,
     *     type="integer"
     * )
     */
    private $id;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Name of the service",
     *     example="Obat",
     *     type="string"
     * )
     */
    private $name;
}
