<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::with('rol')->get();
        $roles = Rol::all();
        return view('vistas.usuarios', compact('usuarios', 'roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->nombre = $request->nombre;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->contrasena);
        $usuario->telefono = $request->telefono;
        $usuario->idRol = $request->idRol;
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
        $usuario = User::findOrFail($request->idUsuario);
        $usuario->nombre = $request->nombre;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        if ($request->filled('contrasena')) {
            $usuario->password = bcrypt($request->contrasena);
        }
        $usuario->telefono = $request->telefono;
        $usuario->idRol = $request->idRol;
        $usuario->save();

        return redirect('/usuarios');
    }

    public function destroy(Request $request)
    {
        $usuario = User::findOrFail($request->get('idUsuario'));
        $usuario->delete();
        return redirect('/usuarios');
    }
}
