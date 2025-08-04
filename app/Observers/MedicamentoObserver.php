<?php

namespace App\Observers;

use App\Models\Medicamento;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class MedicamentoObserver
{
    public function created(Medicamento $medicamento)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Nuevo medicamento registrado',
            'descripcion'    => "Se creó el medicamento: {$medicamento->nombre} (ID: {$medicamento->idMedicamento}), stock inicial: {$medicamento->stock}",
            'modelo'         => 'medicamentos',
            'id_relacionado' => $medicamento->idMedicamento,
            'ip'             => Request::ip(),
        ]);
    }

    public function updated(Medicamento $medicamento)
    {
        $changes = $medicamento->getChanges();
        $eventos = [];

        // Cambio de nombre
        if (array_key_exists('nombre', $changes)) {
            $eventos[] = "Cambio de nombre a: {$medicamento->nombre}";
        }
        // Cambio de stock
        if (array_key_exists('stock', $changes)) {
            $eventos[] = "Cambio de stock a: {$medicamento->stock}";
        }
        // Cambio de estado (si tienes campo, ej. 'activo')
        if (array_key_exists('activo', $changes)) {
            $nuevoEstado = $medicamento->activo ? 'Activo' : 'Inactivo';
            $eventos[] = "Cambio de estado a: $nuevoEstado";
        }
        // Otros cambios generales
        if (empty($eventos)) {
            $eventos[] = "Modificación general: " . json_encode($changes);
        }

        foreach ($eventos as $evento) {
            Bitacora::create([
                'idUsuario'      => Auth::id() ?? 1,
                'accion'         => 'Modificación de medicamento',
                'descripcion'    => "{$evento} (ID: {$medicamento->idMedicamento})",
                'modelo'         => 'medicamentos',
                'id_relacionado' => $medicamento->idMedicamento,
                'ip'             => Request::ip(),
            ]);
        }
    }

    public function deleted(Medicamento $medicamento)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación de medicamento',
            'descripcion'    => "Se eliminó (soft delete) el medicamento: {$medicamento->nombre} (ID: {$medicamento->idMedicamento})",
            'modelo'         => 'medicamentos',
            'id_relacionado' => $medicamento->idMedicamento,
            'ip'             => Request::ip(),
        ]);
    }

    public function restored(Medicamento $medicamento)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Restauración de medicamento',
            'descripcion'    => "Se restauró el medicamento: {$medicamento->nombre} (ID: {$medicamento->idMedicamento})",
            'modelo'         => 'medicamentos',
            'id_relacionado' => $medicamento->idMedicamento,
            'ip'             => Request::ip(),
        ]);
    }

    public function forceDeleted(Medicamento $medicamento)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación definitiva de medicamento',
            'descripcion'    => "Se eliminó definitivamente el medicamento: {$medicamento->nombre} (ID: {$medicamento->idMedicamento})",
            'modelo'         => 'medicamentos',
            'id_relacionado' => $medicamento->idMedicamento,
            'ip'             => Request::ip(),
        ]);
    }
}
