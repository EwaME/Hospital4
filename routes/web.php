<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Carbon\Carbon;
use App\Http\Controllers\BitacorasController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\ConsultaMedicamentosController;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\EnfermedadesController;
use App\Http\Controllers\HistorialClinicoController;
use App\Http\Controllers\MedicamentosController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuariosController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Medicamento;
use App\Models\Enfermedad;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Bitacora;
use App\Models\HistorialClinico;
use App\Models\ConsultaMedicamento;

// Rutas del sistema
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/wel', function () {
    return view('welcome');
})->name('logeo');

Route::get('/dashboard', function () {
    // Calcula las estadísticas solo para la vista de estadísticas (dashboard)
    $estadisticas = [];

    if (Auth::user()->hasRole('Paciente')) {
        $paciente = Auth::user()->paciente;
        if ($paciente) {
            $proximaCita = $paciente->citas()
                ->where('fechaCita', '>=', now())
                ->orderBy('fechaCita')
                ->orderBy('horaCita')
                ->first();
            $citasProximas = $paciente->citas()
                ->where('fechaCita', '>=', now())
                ->orderBy('fechaCita')
                ->orderBy('horaCita')
                ->take(3)
                ->get();
        } else {
            $proximaCita = null;
            $citasProximas = collect();
        }
        $estadisticas['paciente'] = compact('proximaCita', 'citasProximas');
    }

    if (Auth::user()->hasRole('Doctor')) {
        $doctor = Auth::user()->doctor;
        if ($doctor) {
            $totalPacientes = Cita::where('idDoctor', $doctor->idDoctor)
                ->where('estadoCita', 'Completada')
                ->distinct('idPaciente')->count('idPaciente');
            $citasPendientesHoy = Cita::where('idDoctor', $doctor->idDoctor)
                ->whereDate('fechaCita', today())
                ->where('estadoCita', 'Pendiente')
                ->count();
            $consultasSemana = Consulta::whereHas('cita', function ($q) use ($doctor) {
                $q->where('idDoctor', $doctor->idDoctor)
                    ->whereBetween('fechaCita', [
                        now()->startOfWeek(), now()->endOfWeek()
                    ]);
            })->count();
            $citasProximas = Cita::with(['paciente.usuario'])
                ->where('idDoctor', $doctor->idDoctor)
                ->where('fechaCita', '>=', now())
                ->orderBy('fechaCita')
                ->orderBy('horaCita')
                ->take(5)
                ->get();
            $promedioSatisfaccion = 4.7;
            $promedioSatisfaccion = $promedioSatisfaccion ? number_format($promedioSatisfaccion, 1) : 'N/A';
        } else {
            $totalPacientes = 0;
            $citasPendientesHoy = 0;
            $consultasSemana = 0;
            $citasProximas = collect();
            $promedioSatisfaccion = 'N/A';
        }
        $estadisticas['doctor'] = compact(
            'totalPacientes',
            'citasPendientesHoy',
            'consultasSemana',
            'citasProximas',
            'promedioSatisfaccion'
        );
    }

    if (Auth::user()->hasRole('Admin')) {
        $totalUsuarios = User::count();
        $totalDoctores = Doctor::count();
        $totalPacientes = Paciente::count();
        $totalRoles = Role::count();

        $bitacoras = \Schema::hasColumn('bitacoras', 'created_at')
            ? Bitacora::orderByDesc('created_at')->take(5)->get()
            : Bitacora::orderByDesc('id')->take(5)->get();

        $usuariosRecientes = User::orderByDesc('created_at')->take(5)->get();
        $medicamentosEntregados = ConsultaMedicamento::with(['medicamento', 'consulta.cita.paciente.usuario'])
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        $estadisticas['admin'] = compact(
            'totalUsuarios',
            'totalDoctores',
            'totalPacientes',
            'totalRoles',
            'bitacoras',
            'usuariosRecientes',
            'medicamentosEntregados'
        );
    }
    return view('dashboard', compact('estadisticas'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::get('/stats', function () {
    return view('vistas.estadisticas');
});

// Rutas de Medicamentos
Route::get('/medicamentos', 'App\Http\Controllers\MedicamentosController@index');
Route::post('/medicamentos', 'App\Http\Controllers\MedicamentosController@store');
Route::put('/medicamentos/edit/{U}', 'App\Http\Controllers\MedicamentosController@update');
Route::delete('/medicamentos/delete/{E}', 'App\Http\Controllers\MedicamentosController@destroy');

// Rutas de Enfermedades
Route::get('/enfermedades', 'App\Http\Controllers\EnfermedadesController@index');
Route::post('/enfermedades', 'App\Http\Controllers\EnfermedadesController@store');
Route::put('/enfermedades/edit/{U}', 'App\Http\Controllers\EnfermedadesController@update');
Route::delete('/enfermedades/delete/{E}', 'App\Http\Controllers\EnfermedadesController@destroy');

// Rutas de Consulta Medicamentos
Route::get('/consultaMedicamentos', 'App\Http\Controllers\ConsultaMedicamentosController@index');
Route::post('/consultaMedicamentos', 'App\Http\Controllers\ConsultaMedicamentosController@store');
Route::put('/consultaMedicamentos/edit/{id}', 'App\Http\Controllers\ConsultaMedicamentosController@update');
Route::delete('/consultaMedicamentos/delete/{id}', 'App\Http\Controllers\ConsultaMedicamentosController@destroy');

//roles
Route::get('/roles', 'App\Http\Controllers\RolesController@index');
Route::post('/roles/guardar', 'App\Http\Controllers\RolesController@store');
Route::post('/roles/editar', 'App\Http\Controllers\RolesController@update');
Route::post('/roles/eliminar', 'App\Http\Controllers\RolesController@destroy');
Route::get('/roles/permisos/{id}', 'App\Http\Controllers\RolesController@obtenerPermisos');

//usuarios
Route::resource('/usuarios', 'App\Http\Controllers\UsuariosController');
Route::post('/usuarios/guardar', 'App\Http\Controllers\UsuariosController@store');
Route::post('/usuarios/editar', 'App\Http\Controllers\UsuariosController@update');
Route::post('/usuarios/eliminar', 'App\Http\Controllers\UsuariosController@destroy');

// doctores
Route::resource('/doctores', 'App\Http\Controllers\DoctoresController');
Route::post('/doctores/guardar', 'App\Http\Controllers\DoctoresController@store');
Route::post('/doctores/editar', 'App\Http\Controllers\DoctoresController@update');
Route::post('/doctores/eliminar', 'App\Http\Controllers\DoctoresController@destroy');

// pacientes
Route::resource('/pacientes', 'App\Http\Controllers\PacientesController');
Route::post('/pacientes/guardar', 'App\Http\Controllers\PacientesController@store');
Route::post('/pacientes/editar', 'App\Http\Controllers\PacientesController@update');
Route::post('/pacientes/eliminar', 'App\Http\Controllers\PacientesController@destroy');

//citas
Route::get('/citas', [CitasController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('citas');
Route::resource('citas', App\Http\Controllers\CitasController::class);
Route::post('/citas/guardar', 'App\Http\Controllers\CitasController@store');
Route::post('/citas/editar', 'App\Http\Controllers\CitasController@update');
Route::post('/citas/eliminar', 'App\Http\Controllers\CitasController@destroy');
Route::patch('/citas/{cita}/cambiar-estado', [CitasController::class, 'cambiarEstado'])
    ->name('citas.cambiarEstado')->middleware(['auth', 'role:Doctor']);

//consultas
Route::resource('/consultas', 'App\Http\Controllers\ConsultasController');
Route::post('/consultas/guardar', 'App\Http\Controllers\ConsultasController@store');
Route::post('/consultas/editar', 'App\Http\Controllers\ConsultasController@update');
Route::post('/consultas/eliminar', 'App\Http\Controllers\ConsultasController@destroy');

//Historial Clinico
Route::resource('/historialClinico', 'App\Http\Controllers\HistorialClinicoController');
Route::post('/historialClinico/guardar', 'App\Http\Controllers\HistorialClinicoController@store');
Route::post('/historialClinico/editar', 'App\Http\Controllers\HistorialClinicoController@update');
Route::post('/historialClinico/eliminar', 'App\Http\Controllers\HistorialClinicoController@destroy');
Route::get('/historialClinico/paciente/{idPaciente}', [HistorialClinicoController::class, 'verPorPaciente'])
    ->name('historialClinico.paciente')
    ->middleware(['auth', 'can:Ver Historiales']);

// Bitácoras
Route::resource('/bitacoras', 'App\Http\Controllers\BitacorasController')->only(['index']);

Route::resource('roles', RolesController::class)->middleware(['auth', 'can:Ver Roles']);
Route::resource('usuarios', UsuariosController::class)->middleware(['auth', 'can:Ver Usuarios']);
Route::resource('pacientes', PacientesController::class)->middleware(['auth', 'can:Ver Pacientes']);
Route::resource('doctores', DoctoresController::class)->middleware(['auth', 'can:Ver Doctores']);
Route::resource('medicamentos', MedicamentosController::class)->middleware(['auth', 'can:Ver Medicamentos']);
Route::resource('enfermedades', EnfermedadesController::class)->middleware(['auth', 'can:Ver Enfermedades']);
Route::resource('citas', CitasController::class)->middleware(['auth', 'can:Ver Citas']);
Route::resource('consultas', ConsultasController::class)->middleware(['auth', 'can:Ver Consultas']);
Route::resource('consultaMedicamentos', ConsultaMedicamentosController::class)->middleware(['auth', 'can:Ver ConsultaMedicamentos']);
Route::resource('historialClinico', HistorialClinicoController::class)->middleware(['auth', 'can:Ver Historiales']);
Route::resource('bitacoras', BitacorasController::class)->only(['index'])->middleware(['auth', 'can:Ver Bitacoras']);