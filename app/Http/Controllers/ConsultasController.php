<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Cita;
use App\Models\Enfermedad;

class ConsultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultas = Consulta::join('citas', 'consultas.idCita', '=', 'citas.idCita')
            ->join('pacientes', 'citas.idPaciente', '=', 'pacientes.idPaciente')
            ->join('users as usuarios_paciente', 'pacientes.idPaciente', '=', 'usuarios_paciente.id')
            ->join('doctores', 'citas.idDoctor', '=', 'doctores.idDoctor')
            ->join('users as usuarios_doctor', 'doctores.idDoctor', '=', 'usuarios_doctor.id')
            ->join('enfermedades', 'consultas.idEnfermedad', '=', 'enfermedades.idEnfermedad')
            ->select(
                'consultas.idConsulta',
                'consultas.idCita',
                'consultas.idEnfermedad',
                'consultas.diagnostico',
                'consultas.fecha',
                'usuarios_paciente.nombre as nombrePaciente',
                'usuarios_doctor.nombre as nombreDoctor',
                'enfermedades.nombre as nombreEnfermedad'
            )
            ->get();
            $citas = Cita::with([
                'paciente.usuario',
                'doctor.usuario'
            ])->get();
            
            $enfermedades = Enfermedad::all();
        return view('vistas.consultas', compact('consultas', 'citas', 'enfermedades'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $consulta = new Consulta();
        $consulta->idCita = $request->get('idCita');
        $consulta->idEnfermedad = $request->get('idEnfermedad');
        $consulta->diagnostico = $request->get('diagnostico');
        $consulta->fecha = $request->get('fecha');
        $consulta->save();
        return redirect('/consultas');
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
        $consulta = Consulta::findOrFail($request->get('idConsulta'));
        $consulta->idCita = $request->get('idCita');
        $consulta->idEnfermedad = $request->get('idEnfermedad');
        $consulta->diagnostico = $request->get('diagnostico');
        $consulta->fecha = $request->get('fecha');
        $consulta->save();
        return redirect('/consultas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $consulta = Consulta::findOrFail($request->get('idConsulta'));
        $consulta->delete();
        return redirect('/consultas');
    }
}
