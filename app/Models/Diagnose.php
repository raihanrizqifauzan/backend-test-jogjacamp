<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Diagnose",
 *     description="Diagnose model",
 *     @OA\Xml(name="Diagnose")
 * )
 */
class Diagnose extends Model {
    protected $fillable = ['name'];

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID of the diagnose",
     *     example=1,
     *     type="integer"
     * )
     */
    private $id;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Name of the diagnose",
     *     example="Ringan",
     *     type="string"
     * )
     */
    private $name;
}
