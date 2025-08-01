<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;

class DoctoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctores = Doctor::with('usuario')->get();
        $usuarios = User::all();

        return view('vistas.doctores', compact('doctores', 'usuarios'));
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
        $doctor = new Doctor();
        $doctor->idDoctor = $request->get('idDoctor');
        $doctor->especialidad = $request->get('especialidad');
        $doctor->save();

        return redirect('/doctores');
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
        $doctor = Doctor::findOrFail($request->get('idDoctor'));
        $doctor->especialidad = $request->get('especialidad');
        $doctor->save();

        return redirect('/doctores');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $doctor = Doctor::findOrFail($request->get('idDoctor'));
        $doctor->delete();

        return redirect('/doctores')->with('success', 'Doctor eliminado correctamente.');
    }
}
