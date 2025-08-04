<?php

namespace App\Observers;

use App\Models\HistorialClinico;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class HistorialClinicoObserver
{
    public function created(HistorialClinico $historial)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Nuevo historial registrado',
            'descripcion'    => "Se creó el historial clínico (ID: {$historial->idHistorial}) para paciente ID: {$historial->idPaciente}",
            'modelo'         => 'historialClinico',
            'id_relacionado' => $historial->idHistorial,
            'ip'             => Request::ip(),
        ]);
    }

    public function updated(HistorialClinico $historial)
    {
        $changes = $historial->getChanges();
        $eventos = [];

        // Cambio de resumen
        if (array_key_exists('resumen', $changes)) {
            $eventos[] = "Actualización de resumen clínico.";
        }
        // Otros cambios generales
        if (empty($eventos)) {
            $eventos[] = "Modificación general: " . json_encode($changes);
        }

        foreach ($eventos as $evento) {
            Bitacora::create([
                'idUsuario'      => Auth::id() ?? 1,
                'accion'         => 'Modificación de historial',
                'descripcion'    => "{$evento} (ID: {$historial->idHistorial})",
                'modelo'         => 'historialClinico',
                'id_relacionado' => $historial->idHistorial,
                'ip'             => Request::ip(),
            ]);
        }
    }

    public function deleted(HistorialClinico $historial)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación de historial',
            'descripcion'    => "Se eliminó (soft delete) el historial clínico (ID: {$historial->idHistorial}) para paciente ID: {$historial->idPaciente}",
            'modelo'         => 'historialClinico',
            'id_relacionado' => $historial->idHistorial,
            'ip'             => Request::ip(),
        ]);
    }

    public function restored(HistorialClinico $historial)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Restauración de historial',
            'descripcion'    => "Se restauró el historial clínico (ID: {$historial->idHistorial}) para paciente ID: {$historial->idPaciente}",
            'modelo'         => 'historialClinico',
            'id_relacionado' => $historial->idHistorial,
            'ip'             => Request::ip(),
        ]);
    }

    public function forceDeleted(HistorialClinico $historial)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación definitiva de historial',
            'descripcion'    => "Se eliminó definitivamente el historial clínico (ID: {$historial->idHistorial}) para paciente ID: {$historial->idPaciente}",
            'modelo'         => 'historialClinico',
            'id_relacionado' => $historial->idHistorial,
            'ip'             => Request::ip(),
        ]);
    }
}
