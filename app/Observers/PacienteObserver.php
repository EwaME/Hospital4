<?php

namespace App\Observers;

use App\Models\Paciente;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PacienteObserver
{
    public function created(Paciente $paciente)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Alta de paciente',
            'descripcion'    => "Se creó el paciente (ID: {$paciente->idPaciente})",
            'modelo'         => 'pacientes',
            'id_relacionado' => $paciente->idPaciente,
            'ip'             => Request::ip(),
        ]);
    }

    public function updated(Paciente $paciente)
    {
        $changes = $paciente->getChanges();
        $eventos = [];

        // Cambio de estado (si existe, ejemplo campo: activo)
        if (array_key_exists('activo', $changes)) {
            $nuevoEstado = $paciente->activo ? 'Activo' : 'Inactivo';
            $eventos[] = "Cambio de estado a: $nuevoEstado";
        }
        // Otros cambios generales
        if (empty($eventos)) {
            $eventos[] = "Modificación de datos generales: " . json_encode($changes);
        }

        foreach ($eventos as $evento) {
            Bitacora::create([
                'idUsuario'      => Auth::id() ?? 1,
                'accion'         => 'Modificación de paciente',
                'descripcion'    => "{$evento} (ID: {$paciente->idPaciente})",
                'modelo'         => 'pacientes',
                'id_relacionado' => $paciente->idPaciente,
                'ip'             => Request::ip(),
            ]);
        }
    }

    public function deleted(Paciente $paciente)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación de paciente',
            'descripcion'    => "Se eliminó (soft delete) el paciente (ID: {$paciente->idPaciente})",
            'modelo'         => 'pacientes',
            'id_relacionado' => $paciente->idPaciente,
            'ip'             => Request::ip(),
        ]);
    }

    public function restored(Paciente $paciente)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Restauración de paciente',
            'descripcion'    => "Se restauró el paciente (ID: {$paciente->idPaciente})",
            'modelo'         => 'pacientes',
            'id_relacionado' => $paciente->idPaciente,
            'ip'             => Request::ip(),
        ]);
    }

    public function forceDeleted(Paciente $paciente)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación definitiva de paciente',
            'descripcion'    => "Se eliminó definitivamente el paciente (ID: {$paciente->idPaciente})",
            'modelo'         => 'pacientes',
            'id_relacionado' => $paciente->idPaciente,
            'ip'             => Request::ip(),
        ]);
    }
}
