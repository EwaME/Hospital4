<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Doctor;

class CitasController extends Controller
{
    public function index() 
    {
        $user = auth()->user();

        if ($user->hasRole('Paciente')) {
            $citas = Cita::with(['doctor.usuario'])
                ->where('idPaciente', $user->id)
                ->orderByDesc('fechaCita')
                ->get();

            return view('vistas.citas', compact('citas'));
        } elseif ($user->hasRole('Doctor')) {
            $citas = Cita::with(['paciente.usuario'])
                ->where('idDoctor', $user->id)
                ->orderByDesc('fechaCita')
                ->get();

            return view('vistas.citas', compact('citas'));
        } elseif ($user->hasRole('Admin')) {
            $citas = Cita::with(['paciente.usuario','doctor.usuario'])->orderByDesc('fechaCita')->get();
            $pacientes = Paciente::with('usuario')->get();
            $doctores = Doctor::with('usuario')->get();
            return view('vistas.citas', compact('citas', 'pacientes', 'doctores'));
        } else {
            $citas = collect();
            return view('vistas.citas', compact('citas'));
        }
    }

    public function store(Request $request)
    {
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
        $cita->estadoCita = strtoupper($request->get('estadoCita')); // validación aplicada aquí
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
        $cita->estadoCita = strtoupper ($request->get('estadoCita'));
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
        $cita = Cita::findOrFail($request->get('idCita'));
        $cita->estadoCita = $request->get('estadoCita');
        $cita->save();
        return redirect('/citas')->with('success', 'Estado de la cita actualizado.');
    }
}
