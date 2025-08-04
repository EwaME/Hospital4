<?php

namespace App\Observers;

use App\Models\Cita;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CitaObserver
{
    public function created(Cita $cita)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Creación de cita',
            'descripcion'    => "Se creó la cita (ID: {$cita->idCita}) para paciente {$cita->idPaciente} con doctor {$cita->idDoctor} el {$cita->fechaCita} a las {$cita->horaCita} [Estado: {$cita->estadoCita}]",
            'modelo'         => 'citas',
            'id_relacionado' => $cita->idCita,
            'ip'             => Request::ip(),
        ]);
    }

    public function updated(Cita $cita)
    {
        $changes = $cita->getChanges();
        $eventos = [];

        // Cambio de estado
        if (array_key_exists('estadoCita', $changes)) {
            $eventos[] = "Cambio de estado de cita a: {$cita->estadoCita}";
        }
        // Cambio de doctor
        if (array_key_exists('idDoctor', $changes)) {
            $eventos[] = "Cambio de doctor asignado a: {$cita->idDoctor}";
        }
        // Cambio de fecha
        if (array_key_exists('fechaCita', $changes)) {
            $eventos[] = "Cambio de fecha de cita a: {$cita->fechaCita}";
        }
        // Cambio de hora
        if (array_key_exists('horaCita', $changes)) {
            $eventos[] = "Cambio de hora de cita a: {$cita->horaCita}";
        }
        // Otros cambios generales
        if (empty($eventos)) {
            $eventos[] = "Modificación general de cita: " . json_encode($changes);
        }

        foreach ($eventos as $evento) {
            Bitacora::create([
                'idUsuario'      => Auth::id() ?? 1,
                'accion'         => 'Modificación de cita',
                'descripcion'    => "{$evento} (ID: {$cita->idCita})",
                'modelo'         => 'citas',
                'id_relacionado' => $cita->idCita,
                'ip'             => Request::ip(),
            ]);
        }
    }

    public function deleted(Cita $cita)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación de cita',
            'descripcion'    => "Se eliminó (soft delete) la cita (ID: {$cita->idCita})",
            'modelo'         => 'citas',
            'id_relacionado' => $cita->idCita,
            'ip'             => Request::ip(),
        ]);
    }

    public function restored(Cita $cita)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Restauración de cita',
            'descripcion'    => "Se restauró la cita (ID: {$cita->idCita})",
            'modelo'         => 'citas',
            'id_relacionado' => $cita->idCita,
            'ip'             => Request::ip(),
        ]);
    }

    public function forceDeleted(Cita $cita)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación definitiva de cita',
            'descripcion'    => "Se eliminó definitivamente la cita (ID: {$cita->idCita})",
            'modelo'         => 'citas',
            'id_relacionado' => $cita->idCita,
            'ip'             => Request::ip(),
        ]);
    }
}
