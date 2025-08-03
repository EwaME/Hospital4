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
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->hasRole('Paciente')) {
            if ($user->paciente) {
                return redirect()->route('historialClinico.paciente', ['idPaciente' => $user->paciente->idPaciente]);
            } else {
                abort(403, 'No autorizado');
            }
        }

        return redirect()->route('dashboard');
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
        $historial->resumen = strtoupper ($request->get('resumen'));
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
        $historial->resumen = strtoupper ($request->get('resumen'));
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

    public function verPorPaciente($idPaciente)
    {
        $historial = \App\Models\HistorialClinico::where('historialclinico.idPaciente', $idPaciente)
            ->join('pacientes', 'historialclinico.idPaciente', '=', 'pacientes.idPaciente')
            ->join('users', 'pacientes.idPaciente', '=', 'users.id')
            ->select('historialclinico.*', 'users.nombre as nombrePaciente')
            ->first();

        if (!$historial) {
            return back()->with('error', 'Historial clínico no encontrado.');
        }

        $user = auth()->user();
        $puedeEditar = false;
        $soloLectura = false;

        if ($user->hasRole('Admin')) {
            $puedeEditar = true;
        } elseif ($user->hasRole('Doctor')) {
            $puedeEditar = true;
        } elseif ($user->hasRole('Paciente')) {
            if ($user->paciente && $user->paciente->idPaciente == $idPaciente) {
                $soloLectura = true;
            } else {
                abort(403, 'No autorizado');
            }
        }

        return view('vistas.historialClinico', compact('historial', 'puedeEditar', 'soloLectura'));
    }
}
