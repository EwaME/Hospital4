<?php

namespace App\Observers;

use App\Models\ConsultaMedicamento;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ConsultaMedicamentoObserver
{
    public function created(ConsultaMedicamento $cm)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Asignación de medicamento',
            'descripcion'    => "Se asignó el medicamento (ID: {$cm->idMedicamento}) a la consulta (ID: {$cm->idConsulta}) en cantidad: {$cm->cantidad}",
            'modelo'         => 'consulta_medicamentos',
            'id_relacionado' => $cm->idCMedicamento,
            'ip'             => Request::ip(),
        ]);
    }

    public function updated(ConsultaMedicamento $cm)
    {
        $changes = $cm->getChanges();
        $eventos = [];

        // Cambio de medicamento
        if (array_key_exists('idMedicamento', $changes)) {
            $eventos[] = "Cambio de medicamento a ID: {$cm->idMedicamento}";
        }
        // Cambio de cantidad
        if (array_key_exists('cantidad', $changes)) {
            $eventos[] = "Cambio de cantidad a: {$cm->cantidad}";
        }
        // Otros cambios generales
        if (empty($eventos)) {
            $eventos[] = "Modificación general: " . json_encode($changes);
        }

        foreach ($eventos as $evento) {
            Bitacora::create([
                'idUsuario'      => Auth::id() ?? 1,
                'accion'         => 'Modificación de asignación de medicamento',
                'descripcion'    => "{$evento} (ID: {$cm->idCMedicamento}) para consulta (ID: {$cm->idConsulta})",
                'modelo'         => 'consulta_medicamentos',
                'id_relacionado' => $cm->idCMedicamento,
                'ip'             => Request::ip(),
            ]);
        }
    }

    public function deleted(ConsultaMedicamento $cm)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación de medicamento de consulta',
            'descripcion'    => "Se eliminó (soft delete) el medicamento (ID: {$cm->idMedicamento}) de la consulta (ID: {$cm->idConsulta})",
            'modelo'         => 'consulta_medicamentos',
            'id_relacionado' => $cm->idCMedicamento,
            'ip'             => Request::ip(),
        ]);
    }

    public function restored(ConsultaMedicamento $cm)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Restauración de asignación de medicamento',
            'descripcion'    => "Se restauró la asignación del medicamento (ID: {$cm->idMedicamento}) a la consulta (ID: {$cm->idConsulta})",
            'modelo'         => 'consulta_medicamentos',
            'id_relacionado' => $cm->idCMedicamento,
            'ip'             => Request::ip(),
        ]);
    }

    public function forceDeleted(ConsultaMedicamento $cm)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación definitiva de asignación de medicamento',
            'descripcion'    => "Se eliminó definitivamente el medicamento (ID: {$cm->idMedicamento}) de la consulta (ID: {$cm->idConsulta})",
            'modelo'         => 'consulta_medicamentos',
            'id_relacionado' => $cm->idCMedicamento,
            'ip'             => Request::ip(),
        ]);
    }
}
