<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistorialClinico;
use App\Models\Paciente;

class HistorialClinicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historiales = HistorialClinico::join('pacientes', 'historialclinico.idPaciente', '=', 'pacientes.idPaciente')
            ->join('users', 'pacientes.idPaciente', '=', 'users.id')
            ->select(
                'historialClinico.*',
                'users.nombre as nombrePaciente'
            )->get();

        $pacientes = Paciente::join('users', 'pacientes.idPaciente', '=', 'users.id')
            ->select('pacientes.idPaciente', 'users.nombre')
            ->get();

        return view('vistas.historialClinico', compact('historiales', 'pacientes'));
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
        $historial = new HistorialClinico();
        $historial->idPaciente = $request->get('idPaciente');
        $historial->fechaActualizacion = now();
        $historial->resumen = $request->get('resumen');
        $historial->save();
        return redirect('/historialClinico');
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
        $historial = HistorialClinico::findOrFail($request->get('idHistorial'));
        $historial->resumen = $request->get('resumen');
        $historial->fechaActualizacion = now();
        $historial->save();
        return redirect('/historialClinico');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $historial = HistorialClinico::findOrFail($request->get('idHistorial'));
        $historial->delete();
        return redirect('/historialClinico');
    }
}
