<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Cita;
use App\Models\Enfermedad;
use App\Models\HistorialClinico;
use App\Models\ConsultaMedicamento;
use App\Models\Medicamento;

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
            $enfermedades = \App\Models\Enfermedad::all();
            $citas = \App\Models\Cita::with(['paciente.usuario', 'doctor.usuario'])
                        ->where('idDoctor', $doctor->idDoctor)->get();
            return view('vistas.consultas', compact('consultas', 'enfermedades', 'citas'));
        }

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

    public function registrarCompleta(Request $request)
    {
        $request->validate([
            'idCita' => 'required|exists:citas,idCita',
            'idEnfermedad' => 'required|exists:enfermedades,idEnfermedad',
            'diagnostico' => 'required',
            'medicamentos' => 'array',
            'resumen_historial' => 'nullable|string'
        ]);

        if ($request->has('medicamentos')) {
            foreach ($request->medicamentos as $med) {
                $medicamento = Medicamento::find($med['idMedicamento']);
                if (!$medicamento) {
                    return back()->with('error', 'El medicamento seleccionado no existe.');
                }
                if ($medicamento->stock < $med['cantidad']) {
                    return back()->with('error', 'Stock insuficiente para el medicamento "' . $medicamento->nombre . '". Stock actual: ' . $medicamento->stock);
                }
            }
        }

        $cita = \App\Models\Cita::findOrFail($request->idCita);
        $cita->estadoCita = 'Finalizada';
        $cita->save();

        $consulta = new \App\Models\Consulta();
        $consulta->idCita = $request->idCita;
        $consulta->idEnfermedad = $request->idEnfermedad;
        $consulta->diagnostico = $request->diagnostico;
        $consulta->fecha = now()->format('Y-m-d');
        $consulta->save();

        if ($request->has('medicamentos')) {
            foreach ($request->medicamentos as $med) {
                \App\Models\ConsultaMedicamento::create([
                    'idConsulta' => $consulta->idConsulta,
                    'idMedicamento' => $med['idMedicamento'],
                    'cantidad' => $med['cantidad'],
                ]);
                $medicamento = Medicamento::find($med['idMedicamento']);
                $medicamento->stock -= $med['cantidad'];
                $medicamento->save();
            }
        }

        $historial = \App\Models\HistorialClinico::firstOrNew(['idPaciente' => $cita->idPaciente]);
        $historial->resumen = $request->resumen_historial;
        $historial->save();

        return redirect('/citas')->with('success', 'Consulta médica registrada y cita finalizada correctamente.');
    }
}
