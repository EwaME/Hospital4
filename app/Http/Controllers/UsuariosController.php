<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Rol;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('rol')->get();
        $roles = Rol::all();
        return view('vistas.usuarios', compact('usuarios', 'roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->usuario = $request->get('usuario');
        $usuario->nombre = $request->get('nombre');
        $usuario->correo = $request->get('correo');
        $usuario->contrasena = bcrypt($request->get('contrasena'));
        $usuario->telefono = $request->get('telefono');
        $usuario->idRol = $request->get('idRol');
        $usuario->save();
        return redirect('/usuarios');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request)
    {
        $usuario = Usuario::findOrFail($request->get('idUsuario'));
        $usuario->nombre = $request->get('nombre');
        $usuario->correo = $request->get('correo');
        if ($request->filled('contrasena')) {
            $usuario->contrasena = bcrypt($request->get('contrasena'));
        }
        $usuario->telefono = $request->get('telefono');
        $usuario->idRol = $request->get('idRol');
        $usuario->save();
        return redirect('/usuarios');
    }

    public function destroy(Request $request)
    {
        $usuario = Usuario::findOrFail($request->get('idUsuario'));
        $usuario->delete();
        return redirect('/usuarios');
    }
}
