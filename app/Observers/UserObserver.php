<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserObserver
{
    public function created(User $user)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Creación de usuario',
            'descripcion'    => "Se creó el usuario: {$user->nombre} (ID: {$user->id})",
            'modelo'         => 'users',
            'id_relacionado' => $user->id,
            'ip'             => Request::ip(),
        ]);
    }

    public function updated(User $user)
    {
        $changes = $user->getChanges();
        $eventos = [];

        if (array_key_exists('email', $changes)) {
            $eventos[] = "Cambio de correo de {$user->getOriginal('email')} a {$user->email}";
        }
        if (array_key_exists('password', $changes)) {
            $eventos[] = "Cambio de contraseña";
        }
        if (array_key_exists('idRol', $changes)) {
            $eventos[] = "Cambio de rol de {$user->getOriginal('idRol')} a {$user->idRol}";
        }
        if (array_key_exists('activo', $changes)) {
            $nuevoEstado = filter_var($user->activo, FILTER_VALIDATE_BOOLEAN) ? 'Activo' : 'Inactivo';
            $estadoAnterior = filter_var($user->getOriginal('activo'), FILTER_VALIDATE_BOOLEAN) ? 'Activo' : 'Inactivo';
            $eventos[] = "Cambio de estado de $estadoAnterior a $nuevoEstado";
        }
        if (empty($eventos)) {
            $eventos[] = "Actualización de datos generales: " . json_encode($changes);
        }

        foreach ($eventos as $evento) {
            Bitacora::create([
                'idUsuario'      => Auth::id() ?? 1,
                'accion'         => 'Actualización de usuario',
                'descripcion'    => "{$evento} (Usuario: {$user->nombre} - ID: {$user->id})",
                'modelo'         => 'users',
                'id_relacionado' => $user->id,
                'ip'             => Request::ip(),
            ]);
        }
    }

    public function deleted(User $user)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación de usuario',
            'descripcion'    => "Se eliminó (soft delete) el usuario: {$user->nombre} (ID: {$user->id})",
            'modelo'         => 'users',
            'id_relacionado' => $user->id,
            'ip'             => Request::ip(),
        ]);
    }

    public function restored(User $user)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Restauración de usuario',
            'descripcion'    => "Se restauró el usuario: {$user->nombre} (ID: {$user->id})",
            'modelo'         => 'users',
            'id_relacionado' => $user->id,
            'ip'             => Request::ip(),
        ]);
    }

    public function forceDeleted(User $user)
    {
        Bitacora::create([
            'idUsuario'      => Auth::id() ?? 1,
            'accion'         => 'Eliminación definitiva de usuario',
            'descripcion'    => "Se eliminó definitivamente el usuario: {$user->nombre} (ID: {$user->id})",
            'modelo'         => 'users',
            'id_relacionado' => $user->id,
            'ip'             => Request::ip(),
        ]);
    }
}
