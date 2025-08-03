<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfermedad;

class EnfermedadesController extends Controller
{
    public function index()
    {
        $enfermedades = Enfermedad::all();
        return view('vistas.enfermedad')->with('enfermedades', $enfermedades);
    }

    public function store(Request $request)
    {
        $enfermedad = new Enfermedad();
        $enfermedad->nombre = strtoupper($request->get('nombre')); // <-- validación aplicada aquí
        $enfermedad->descripcion = strtoupper ($request->get('descripcion'));
        $enfermedad->save();

        return redirect('/enfermedades');
    }

    public function update(Request $request, $id)
    {
        $enfermedad = Enfermedad::find($id);
        $enfermedad->nombre = strtoupper ($request->get('nombreEditar'));
        $enfermedad->descripcion = strtoupper ($request->get('descripcionEditar'));
        $enfermedad->save();

        return redirect('/enfermedades');
    }

    public function destroy($id)
    {
        $enfermedad = Enfermedad::find($id);
        $enfermedad->delete();

        return redirect('/enfermedades');
    }
}
