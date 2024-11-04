<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface AppointmentRepositoryInterface
{
    public function create(array $data);
    public function findById($id);
    public function update($id, array $data);
}
