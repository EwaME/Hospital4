<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\MedicamentosController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\HistorialClinicoController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
// medicamentos
Route::resource('/medicamentos', 'App\Http\Controllers\MedicamentosController');
Route::put('/medicamentos/edit/{U}', 'App\Http\Controllers\MedicamentosController@update');
Route::delete('/medicamentos/delete/{E}', 'App\Http\Controllers\MedicamentosController@destroy');
Route::get('/medicamentos/lista/{id}', 'App\Http\Controllers\MedicamentosController@index');

//roles
Route::resource('/roles', 'App\Http\Controllers\RolesController');
Route::post('/roles/guardar', 'App\Http\Controllers\RolesController@store');
Route::post('/roles/editar', 'App\Http\Controllers\RolesController@update');
Route::post('/roles/eliminar', 'App\Http\Controllers\RolesController@destroy');

//usuarios
Route::resource('/usuarios', 'App\Http\Controllers\UsuariosController');
Route::post('/usuarios/guardar', 'App\Http\Controllers\UsuariosController@store');
Route::post('/usuarios/editar', 'App\Http\Controllers\UsuariosController@update');
Route::post('/usuarios/eliminar', 'App\Http\Controllers\UsuariosController@destroy');

//citas
Route::resource('/citas', 'App\Http\Controllers\CitasController');
Route::post('/citas/guardar', 'App\Http\Controllers\CitasController@store');
Route::post('/citas/editar', 'App\Http\Controllers\CitasController@update');
Route::post('/citas/eliminar', 'App\Http\Controllers\CitasController@destroy');

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