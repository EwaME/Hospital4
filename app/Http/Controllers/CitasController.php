<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Doctor;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = Cita::with([
            'paciente.usuario',
            'doctor.usuario'
        ])->get();

        $pacientes = Paciente::with('usuario')->get();
        $doctores = Doctor::with('usuario')->get();

        return view('vistas.citas', compact('citas', 'pacientes', 'doctores'));
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
        $cita = new Cita();
        $cita->idPaciente = $request->get('idPaciente');
        $cita->idDoctor = $request->get('idDoctor');
        $cita->fechaCita = $request->get('fechaCita');
        $cita->horaCita = $request->get('horaCita');
        $cita->estadoCita = $request->get('estadoCita');
        $cita->save();
        return redirect('/citas');
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
        $cita = Cita::findOrFail($request->get('idCita'));
        $cita->idPaciente = $request->get('idPaciente');
        $cita->idDoctor = $request->get('idDoctor');
        $cita->fechaCita = $request->get('fechaCita');
        $cita->horaCita = $request->get('horaCita');
        $cita->estadoCita = $request->get('estadoCita');
        $cita->save();
        return redirect('/citas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cita = Cita::findOrFail($request->get('idCita'));
        $cita->delete();
        return redirect('/citas');
    }
}
