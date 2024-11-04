<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\PatientRepositoryInterface;
use App\Repositories\Contracts\DiagnoseRepositoryInterface;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Repositories\Contracts\AppointmentRepositoryInterface;
use App\Repositories\PatientRepository;
use App\Repositories\DiagnoseRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\AppointmentRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(DiagnoseRepositoryInterface::class, DiagnoseRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
