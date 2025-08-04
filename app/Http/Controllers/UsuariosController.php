<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;
use App\Models\HistorialClinico;
use Spatie\Permission\Models\Role;
use App\Models\Administrador;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::with('rol')->get();
        $roles = Role::all();
        return view('vistas.usuarios', compact('usuarios', 'roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->nombre =  $request->nombre;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->contrasena);
        $usuario->telefono = $request->telefono;
        $usuario->idRol = $request->idRol;
        $usuario->save();

        $rolNombre = \Spatie\Permission\Models\Role::find($usuario->idRol)->name;
        $usuario->syncRoles($rolNombre);
        \App\Models\Paciente::create([
            'idPaciente' => $usuario->id,
            'fechaNacimiento' => $request->fechaNacimiento ?? '2000-01-01',
            'genero' => $request->genero ?? 'No especificado',
            'activo' => true,
        ]);
        \App\Models\HistorialClinico::create([
            'idPaciente' => $usuario->id,
            'resumen' => 'Historial creado automáticamente',
        ]);
        if ($rolNombre === 'Doctor') {
            \App\Models\Doctor::create([
                'idDoctor' => $usuario->id,
                'especialidad' => $request->especialidad ?? 'General',
                'activo' => true,
            ]);
        }
        if ($rolNombre === 'Admin') {
            Administrador::create([
                'idUsuario' => $usuario->id,
                'activo' => true,
            ]);
        }
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
        $usuario = User::findOrFail($request->id);
        $usuario->nombre =  $request->nombre ;
        $usuario->usuario = $request->usuario; 
        $usuario->email = $request->email;
        if ($request->filled('contrasena')) {
            $usuario->password = bcrypt($request->contrasena);
        }
        $usuario->telefono = $request->telefono;
        $usuario->idRol = $request->idRol;
        $usuario->save();

        $rolNombre = \Spatie\Permission\Models\Role::find($usuario->idRol)->name;
        $usuario->syncRoles($rolNombre);

        return redirect('/usuarios');
    }

    public function destroy(Request $request)
    {
        $usuario = User::findOrFail($request->get('id'));
        $usuario->delete();
        return redirect('/usuarios');
    }
}
