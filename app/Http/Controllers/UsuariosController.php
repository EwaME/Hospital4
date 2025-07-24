<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Rol;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::with('rol')->get();
        $roles = Rol::all();
        return view('vistas.usuarios', compact('usuarios', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($request->get('idUsuario'));
        $usuario->delete();
        return redirect('/usuarios');
    }
}
