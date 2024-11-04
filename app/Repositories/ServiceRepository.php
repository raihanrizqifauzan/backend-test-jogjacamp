<?php 

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\Contracts\ServiceRepositoryInterface;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function create(array $data)
    {
        return Service::create($data);
    }
}
