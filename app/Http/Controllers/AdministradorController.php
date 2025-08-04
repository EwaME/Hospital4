<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\User;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function index()
    {
        $administradores = Administrador::withTrashed()->with('usuario')->get();
        $usuarios = User::whereDoesntHave('administrador')->whereHas('roles', function($q){
            $q->where('name', 'Admin');
        })->get();
        return view('vistas.administradores', compact('administradores', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idUsuario' => 'required|unique:administradores,idUsuario',
            'cargo' => 'nullable|string|max:255',
        ]);
        Administrador::create($request->only('idUsuario', 'cargo'));
        return redirect()->route('administradores.index')->with('success', 'Administrador creado correctamente');
    }

    public function update(Request $request, $id)
    {
        $admin = Administrador::withTrashed()->findOrFail($id);
        $request->validate([
            'cargo' => 'nullable|string|max:255',
        ]);
        $admin->update($request->only('cargo'));
        return redirect()->route('administradores.index')->with('success', 'Administrador actualizado');
    }

    public function destroy($id)
    {
        $admin = Administrador::findOrFail($id);
        $admin->delete();
        return redirect()->route('administradores.index')->with('success', 'Administrador eliminado (soft delete)');
    }

    public function restore($id)
    {
        $admin = Administrador::withTrashed()->findOrFail($id);
        $admin->restore();
        return redirect()->route('administradores.index')->with('success', 'Administrador restaurado');
    }
}
