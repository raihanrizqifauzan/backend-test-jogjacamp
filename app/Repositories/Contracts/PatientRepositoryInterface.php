<?php 

namespace App\Repositories\Contracts;

interface PatientRepositoryInterface
{
    public function create(array $data);
}