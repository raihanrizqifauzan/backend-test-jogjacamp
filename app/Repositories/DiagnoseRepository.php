<?php 

namespace App\Repositories;

use App\Models\Diagnose;
use App\Repositories\Contracts\DiagnoseRepositoryInterface;

class DiagnoseRepository implements DiagnoseRepositoryInterface
{
    public function create(array $data)
    {
        return Diagnose::create($data);
    }
}
