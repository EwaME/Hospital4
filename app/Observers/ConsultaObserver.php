<?php

namespace App\Observers;

use App\Models\Consulta;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ConsultaObserver
{
    public function created(Consulta $consulta)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Creación de consulta',
            'descripcion'    => "Se creó la consulta (ID: {$consulta->idConsulta}) para cita ID: {$consulta->idCita}",
            'modelo'         => 'consultas',
            'id_relacionado' => $consulta->idConsulta,
            'ip'             => Request::ip(),
        ]);
    }

    public function updated(Consulta $consulta)
    {
        $changes = $consulta->getChanges();
        $eventos = [];

        // Cambio de diagnóstico
        if (array_key_exists('diagnostico', $changes)) {
            $eventos[] = "Edición de diagnóstico a: {$consulta->diagnostico}";
        }
        // Cambio de enfermedad
        if (array_key_exists('idEnfermedad', $changes)) {
            $nuevoEnfermedad = $consulta->idEnfermedad ? $consulta->idEnfermedad : 'Sin enfermedad asignada';
            $eventos[] = "Cambio/Asignación de enfermedad a: {$nuevoEnfermedad}";
        }
        // Otros cambios generales
        if (empty($eventos)) {
            $eventos[] = "Modificación general de consulta: " . json_encode($changes);
        }

        foreach ($eventos as $evento) {
            Bitacora::create([
                'idUsuario'      => Auth::id() ?? 1,
                'accion'         => 'Modificación de consulta',
                'descripcion'    => "{$evento} (ID: {$consulta->idConsulta})",
                'modelo'         => 'consultas',
                'id_relacionado' => $consulta->idConsulta,
                'ip'             => Request::ip(),
            ]);
        }
    }

    public function deleted(Consulta $consulta)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación de consulta',
            'descripcion'    => "Se eliminó (soft delete) la consulta (ID: {$consulta->idConsulta})",
            'modelo'         => 'consultas',
            'id_relacionado' => $consulta->idConsulta,
            'ip'             => Request::ip(),
        ]);
    }

    public function restored(Consulta $consulta)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Restauración de consulta',
            'descripcion'    => "Se restauró la consulta (ID: {$consulta->idConsulta})",
            'modelo'         => 'consultas',
            'id_relacionado' => $consulta->idConsulta,
            'ip'             => Request::ip(),
        ]);
    }

    public function forceDeleted(Consulta $consulta)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación definitiva de consulta',
            'descripcion'    => "Se eliminó definitivamente la consulta (ID: {$consulta->idConsulta})",
            'modelo'         => 'consultas',
            'id_relacionado' => $consulta->idConsulta,
            'ip'             => Request::ip(),
        ]);
    }
}
