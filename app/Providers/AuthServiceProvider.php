<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\User;
use App\Policies\AppointmentPolicy;
use App\Policies\DoctorPolicy;
use App\Policies\HospitalPolicy;
use App\Policies\PatientPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Appointment::class => AppointmentPolicy::class,
        Doctor::class => DoctorPolicy::class,
        Hospital::class=> HospitalPolicy::class,
        Patient::class=>PatientPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
    }
}
