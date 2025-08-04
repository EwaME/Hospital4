<?php

namespace App\Observers;

use App\Models\Doctor;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class DoctorObserver
{
    public function created(Doctor $doctor)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Nuevo doctor registrado',
            'descripcion'    => "Se creó el doctor (ID: {$doctor->idDoctor}, Especialidad: {$doctor->especialidad})",
            'modelo'         => 'doctores',
            'id_relacionado' => $doctor->idDoctor,
            'ip'             => Request::ip(),
        ]);
    }

    public function updated(Doctor $doctor)
    {
        $changes = $doctor->getChanges();
        $eventos = [];

        // Cambio de especialidad
        if (array_key_exists('especialidad', $changes)) {
            $eventos[] = "Cambio de especialidad a: {$doctor->especialidad}";
        }
        // Cambio de estado (si tienes campo, ej. 'activo')
        if (array_key_exists('activo', $changes)) {
            $nuevoEstado = $doctor->activo ? 'Activo' : 'Inactivo';
            $eventos[] = "Cambio de estado a: $nuevoEstado";
        }
        // Otros cambios generales
        if (empty($eventos)) {
            $eventos[] = "Modificación de datos generales: " . json_encode($changes);
        }

        foreach ($eventos as $evento) {
            Bitacora::create([
                'idUsuario'      => Auth::id() ?? 1,
                'accion'         => 'Modificación de doctor',
                'descripcion'    => "{$evento} (ID: {$doctor->idDoctor})",
                'modelo'         => 'doctores',
                'id_relacionado' => $doctor->idDoctor,
                'ip'             => Request::ip(),
            ]);
        }
    }

    public function deleted(Doctor $doctor)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación de doctor',
            'descripcion'    => "Se eliminó (soft delete) el doctor (ID: {$doctor->idDoctor})",
            'modelo'         => 'doctores',
            'id_relacionado' => $doctor->idDoctor,
            'ip'             => Request::ip(),
        ]);
    }

    public function restored(Doctor $doctor)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Restauración de doctor',
            'descripcion'    => "Se restauró el doctor (ID: {$doctor->idDoctor})",
            'modelo'         => 'doctores',
            'id_relacionado' => $doctor->idDoctor,
            'ip'             => Request::ip(),
        ]);
    }

    public function forceDeleted(Doctor $doctor)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación definitiva de doctor',
            'descripcion'    => "Se eliminó definitivamente el doctor (ID: {$doctor->idDoctor})",
            'modelo'         => 'doctores',
            'id_relacionado' => $doctor->idDoctor,
            'ip'             => Request::ip(),
        ]);
    }
}
