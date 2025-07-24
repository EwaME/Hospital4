<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Rol::all();
        return view('vistas.roles', compact('roles'));
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
        $rol = new Rol();
        $rol->nombreRol = $request->get('nombreRol');
        $rol->save();
        return redirect('/roles');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
        $rol = Rol::findOrFail($request->get('idRol'));
        $rol->nombreRol = $request->get('nombreRol');
        $rol->save();
        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rol = Rol::findOrFail($request->get('idRol'));
        $rol->delete();
        return redirect('/roles');
    }
}
