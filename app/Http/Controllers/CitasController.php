<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Consulta;
use App\Models\Medicamento;
use App\Models\Enfermedad;
use App\Models\HistorialClinico;
use Illuminate\Support\Facades\Auth;

class CitasController extends Controller
{
    public function index() 
    {
        $user = auth()->user();

        $doctores = Doctor::with('usuario')->get();
        $pacientes = Paciente::with('usuario')->get();
        $medicamentos = Medicamento::all();
        $enfermedades = Enfermedad::all();
        $historialClinico = HistorialClinico::all();

        if ($user->hasRole('Paciente')) {
            $citas = Cita::with(['doctor.usuario'])
                ->where('idPaciente', $user->id)
                ->orderByDesc('fechaCita')
                ->get();

            return view('vistas.citas', compact('citas', 'doctores', 'pacientes', 'medicamentos', 'enfermedades', 'historialClinico'));
        } elseif ($user->hasRole('Doctor')) {
            $citas = Cita::with(['paciente.usuario'])
                ->where('idDoctor', $user->id)
                ->orderByDesc('fechaCita')
                ->get();
            return view('vistas.citas', compact('citas', 'pacientes', 'doctores', 'medicamentos', 'enfermedades', 'historialClinico'));
        } elseif ($user->hasRole('Admin')) {
            $citas = Cita::with(['paciente.usuario','doctor.usuario'])->orderByDesc('fechaCita')->get();
            return view('vistas.citas', compact('citas', 'pacientes', 'doctores', 'medicamentos', 'enfermedades', 'historialClinico'));
        } else {
            $citas = collect();
            return view('vistas.citas', compact('citas', 'pacientes', 'doctores', 'medicamentos', 'enfermedades', 'historialClinico'));
        }
    }

    public function store(Request $request)
    {
        $user = auth()->user();
    
        if ($user->hasRole('Paciente')) {
            $request['idPaciente'] = $user->id;
            $request['estadoCita'] = 'Pendiente';
        }

        $fecha = $request->get('fechaCita');
        $hora = $request->get('horaCita');

        if (strlen($hora) == 5) {
            $hora .= ':00';
        }

        $existeCita = Cita::where('idDoctor', $request->get('idDoctor'))
            ->where('fechaCita', $fecha)
            ->where('horaCita', $hora)
            ->exists();

        if ($existeCita) {
            return redirect('/citas')->with('error', 'Ya existe una cita para ese doctor en la misma fecha y hora.');
        }

        $cita = new Cita();
        $cita->idPaciente = $request->get('idPaciente');
        $cita->idDoctor = $request->get('idDoctor');
        $cita->fechaCita = $fecha;
        $cita->horaCita = $hora;
        $cita->estadoCita = $request->get('estadoCita');
        $cita->save();

        return redirect('/citas');
    }

    public function update(Request $request)
    {
        $fecha = $request->get('fechaCita');
        $hora = $request->get('horaCita');

        if (strlen($hora) == 5) {
            $hora .= ':00';
        }

        $existeCita = Cita::where('idDoctor', $request->get('idDoctor'))
            ->where('fechaCita', $fecha)
            ->where('horaCita', $hora)
            ->where('idCita', '<>', $request->get('idCita'))
            ->exists();

        if ($existeCita) {
            return redirect('/citas')->with('error', 'Ya existe otra cita para ese doctor en la misma fecha y hora.');
        }

        $cita = Cita::findOrFail($request->get('idCita'));
        $cita->idPaciente = $request->get('idPaciente');
        $cita->idDoctor = $request->get('idDoctor');
        $cita->fechaCita = $fecha;
        $cita->horaCita = $hora;
        $cita->estadoCita = $request->get('estadoCita');
        $cita->save();

        return redirect('/citas');
    }

    public function destroy(Request $request)
    {
        $cita = Cita::findOrFail($request->get('idCita'));
        $cita->delete();

        return redirect('/citas');
    }

    public function cambiarEstado(Request $request)
    {
        $user = auth()->user();
        $cita = Cita::findOrFail($request->get('idCita'));

        if ($user->hasRole('Paciente')) {
            if ($cita->idPaciente != $user->id || $cita->estadoCita != 'Pendiente') {
                return back()->with('error', 'No puedes cancelar esta cita.');
            }
            $nuevoEstado = $request->get('estadoCita');
            if ($nuevoEstado !== 'Cancelada') {
                return back()->with('error', 'Solo puedes cancelar tu propia cita.');
            }
            $cita->estadoCita = $nuevoEstado;
            $cita->save();
            
            return back()->with('success', 'Cita cancelada correctamente.');
        }

        $nuevoEstado = $request->get('estadoCita');
        $cita->estadoCita = $nuevoEstado;
        $cita->save();

        if ($nuevoEstado == 'Finalizada') {
            $existeConsulta = Consulta::where('idCita', $cita->idCita)->exists();
            if (!$existeConsulta) {
                Consulta::create([
                    'idCita' => $cita->idCita,
                    'idEnfermedad' => null, 
                    'diagnostico' => '',
                    'fecha' => now()->format('Y-m-d'),
                ]);
            }
        }
        return redirect('/citas')->with('success', 'Estado de la cita actualizado.');
    }
}
