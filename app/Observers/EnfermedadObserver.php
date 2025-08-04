<?php

namespace App\Observers;

use App\Models\Enfermedad;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class EnfermedadObserver
{
    public function created(Enfermedad $enfermedad)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Alta de enfermedad',
            'descripcion'    => "Se creó la enfermedad: {$enfermedad->nombre} (ID: {$enfermedad->idEnfermedad})",
            'modelo'         => 'enfermedades',
            'id_relacionado' => $enfermedad->idEnfermedad,
            'ip'             => Request::ip(),
        ]);
    }

    public function updated(Enfermedad $enfermedad)
    {
        $changes = $enfermedad->getChanges();
        $eventos = [];

        // Cambio de nombre
        if (array_key_exists('nombre', $changes)) {
            $eventos[] = "Cambio de nombre a: {$enfermedad->nombre}";
        }
        // Cambio de descripción
        if (array_key_exists('descripcion', $changes)) {
            $eventos[] = "Cambio de descripción a: {$enfermedad->descripcion}";
        }
        // Otros cambios generales
        if (empty($eventos)) {
            $eventos[] = "Modificación general: " . json_encode($changes);
        }

        foreach ($eventos as $evento) {
            Bitacora::create([
                'idUsuario'      => Auth::id() ?? 1,
                'accion'         => 'Modificación de enfermedad',
                'descripcion'    => "{$evento} (ID: {$enfermedad->idEnfermedad})",
                'modelo'         => 'enfermedades',
                'id_relacionado' => $enfermedad->idEnfermedad,
                'ip'             => Request::ip(),
            ]);
        }
    }

    public function deleted(Enfermedad $enfermedad)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación de enfermedad',
            'descripcion'    => "Se eliminó (soft delete) la enfermedad: {$enfermedad->nombre} (ID: {$enfermedad->idEnfermedad})",
            'modelo'         => 'enfermedades',
            'id_relacionado' => $enfermedad->idEnfermedad,
            'ip'             => Request::ip(),
        ]);
    }

    public function restored(Enfermedad $enfermedad)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Restauración de enfermedad',
            'descripcion'    => "Se restauró la enfermedad: {$enfermedad->nombre} (ID: {$enfermedad->idEnfermedad})",
            'modelo'         => 'enfermedades',
            'id_relacionado' => $enfermedad->idEnfermedad,
            'ip'             => Request::ip(),
        ]);
    }

    public function forceDeleted(Enfermedad $enfermedad)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación definitiva de enfermedad',
            'descripcion'    => "Se eliminó definitivamente la enfermedad: {$enfermedad->nombre} (ID: {$enfermedad->idEnfermedad})",
            'modelo'         => 'enfermedades',
            'id_relacionado' => $enfermedad->idEnfermedad,
            'ip'             => Request::ip(),
        ]);
    }
}
