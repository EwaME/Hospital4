<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\User;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::with('usuario')->get();
        $usuarios = User::all();

        return view('vistas.pacientes', compact('pacientes', 'usuarios'));
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
        $paciente = new Paciente();
        $paciente->idPaciente = $request->get('idPaciente');
        $paciente->fechaNacimiento = $request->get('fechaNacimiento');
        $paciente->genero = $request->get('genero');
        $paciente->save();

        return redirect('/pacientes');
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
        $paciente = Paciente::findOrFail($request->get('idPaciente'));
        $paciente->fechaNacimiento = $request->get('fechaNacimiento');
        $paciente->genero = $request->get('genero');
        $paciente->save();

        return redirect('/pacientes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $paciente = Paciente::findOrFail($request->get('idPaciente'));
        $paciente->delete();

        return redirect('/pacientes');
    }
}
