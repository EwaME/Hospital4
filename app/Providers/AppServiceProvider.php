<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\User;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Medicamento;
use App\Models\Enfermedad;
use App\Models\ConsultaMedicamento;
use App\Models\HistorialClinico;

use App\Observers\UserObserver;
use App\Observers\PacienteObserver;
use App\Observers\DoctorObserver;
use App\Observers\CitaObserver;
use App\Observers\ConsultaObserver;
use App\Observers\MedicamentoObserver;
use App\Observers\EnfermedadObserver;
use App\Observers\ConsultaMedicamentoObserver;
use App\Observers\HistorialClinicoObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Paciente::observe(PacienteObserver::class);
        Doctor::observe(DoctorObserver::class);
        Cita::observe(CitaObserver::class);
        Consulta::observe(ConsultaObserver::class);
        Medicamento::observe(MedicamentoObserver::class);
        Enfermedad::observe(EnfermedadObserver::class);
        ConsultaMedicamento::observe(ConsultaMedicamentoObserver::class);
        HistorialClinico::observe(HistorialClinicoObserver::class);
    }
}