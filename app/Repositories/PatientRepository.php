<?php 

namespace App\Repositories;

use App\Models\Patient;
use App\Repositories\Contracts\PatientRepositoryInterface;

class PatientRepository implements PatientRepositoryInterface
{
    public function create(array $data)
    {
        return Patient::create($data);
    }
}
