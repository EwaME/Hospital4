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
        $user = auth()->user();

        if ($user->hasRole('Paciente')) {
            $paciente = $user->paciente;
            $consultas = collect();
            if ($paciente) {
                $consultas = \App\Models\Consulta::join('citas', 'consultas.idCita', '=', 'citas.idCita')
                    ->join('pacientes', 'citas.idPaciente', '=', 'pacientes.idPaciente')
                    ->join('users as usuarios_paciente', 'pacientes.idPaciente', '=', 'usuarios_paciente.id')
                    ->join('doctores', 'citas.idDoctor', '=', 'doctores.idDoctor')
                    ->join('users as usuarios_doctor', 'doctores.idDoctor', '=', 'usuarios_doctor.id')
                    ->leftJoin('enfermedades', 'consultas.idEnfermedad', '=', 'enfermedades.idEnfermedad')
                    ->where('citas.idPaciente', $paciente->idPaciente)
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
            }
            $enfermedades = \App\Models\Enfermedad::all();
            return view('vistas.consultas', compact('consultas', 'enfermedades'));
        }

        elseif ($user->hasRole('Doctor')) {
            $doctor = $user->doctor;
            $consultas = collect();
            if ($doctor) {
                $consultas = \App\Models\Consulta::join('citas', 'consultas.idCita', '=', 'citas.idCita')
                    ->join('pacientes', 'citas.idPaciente', '=', 'pacientes.idPaciente')
                    ->join('users as usuarios_paciente', 'pacientes.idPaciente', '=', 'usuarios_paciente.id')
                    ->join('doctores', 'citas.idDoctor', '=', 'doctores.idDoctor')
                    ->join('users as usuarios_doctor', 'doctores.idDoctor', '=', 'usuarios_doctor.id')
                    ->leftJoin('enfermedades', 'consultas.idEnfermedad', '=', 'enfermedades.idEnfermedad')
                    ->where('citas.idDoctor', $doctor->idDoctor)
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
            }
            // También necesita enfermedades y las citas asignadas a este doctor (por si editas)
            $enfermedades = \App\Models\Enfermedad::all();
            $citas = \App\Models\Cita::with(['paciente.usuario', 'doctor.usuario'])
                        ->where('idDoctor', $doctor->idDoctor)->get();
            return view('vistas.consultas', compact('consultas', 'enfermedades', 'citas'));
        }

        // Admin: ve TODO
        else if ($user->hasRole('Admin')) {
            $consultas = \App\Models\Consulta::join('citas', 'consultas.idCita', '=', 'citas.idCita')
                ->join('pacientes', 'citas.idPaciente', '=', 'pacientes.idPaciente')
                ->join('users as usuarios_paciente', 'pacientes.idPaciente', '=', 'usuarios_paciente.id')
                ->join('doctores', 'citas.idDoctor', '=', 'doctores.idDoctor')
                ->join('users as usuarios_doctor', 'doctores.idDoctor', '=', 'usuarios_doctor.id')
                ->leftJoin('enfermedades', 'consultas.idEnfermedad', '=', 'enfermedades.idEnfermedad')
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
            $citas = \App\Models\Cita::with([
                'paciente.usuario',
                'doctor.usuario'
            ])->get();
            $enfermedades = \App\Models\Enfermedad::all();
            return view('vistas.consultas', compact('consultas', 'citas', 'enfermedades'));
        }

        // Otros roles (vacío)
        else {
            $consultas = collect();
            $enfermedades = \App\Models\Enfermedad::all();
            return view('vistas.consultas', compact('consultas', 'enfermedades'));
        }
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
        $consulta->diagnostico = strtoupper($request->get('diagnostico')); // <-- validación aplicada aquí
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
        $consulta->diagnostico = strtoupper ($request->get('diagnostico'));
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
