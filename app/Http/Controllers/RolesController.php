<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get(); 
        $permisos = Permission::all();

        return view('vistas.roles', compact('roles', 'permisos'));
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
        $request->validate([
            'nombreRol' => 'required|string|max:255',
            'permisos' => 'required|array',
        ]);

        // Crear rol con el campo 'name'
        $rol = Role::create(['name' => $request->nombreRol]);

        // Sincronizar permisos con array de nombres o IDs
        $rol->syncPermissions($request->permisos);

        return redirect('/roles')->with('success', 'Rol creado correctamente.');
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
        $request->validate([
            'idRol' => 'required|exists:roles,id',
            'nombreRol' => 'required|string|max:255',
            'permisos' => 'required|array',
        ]);

        $rol = Role::findOrFail($request->idRol);
        $rol->name = $request->nombreRol;
        $rol->save();

        $rol->syncPermissions($request->permisos);

        return redirect('/roles')->with('success', 'Rol actualizado con permisos.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $rol = Role::findOrFail($request->idRol);
        $rol->delete();

        return redirect('/roles')->with('success', 'Rol eliminado correctamente.');
    }

    public function obtenerPermisos($id)
    {
        $rol = Role::findOrFail($id);
        return response()->json($rol->permissions->pluck('name'));
    }
}
