<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\MedicamentoController;


// Rutas del sistema
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
