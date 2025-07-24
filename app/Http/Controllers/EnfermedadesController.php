<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfermedad;

class EnfermedadesController extends Controller
{
    public function index()
    {
        $listaEnfermedades = Enfermedad::all();
        return view('enfermedades.Enfermedad')->with('listaEnfermedades', $listaEnfermedades);
    }

    public function store(Request $request)
    {
        $enfermedad = new Enfermedad();
        $enfermedad->nombre = $request->get('nombre');
        $enfermedad->descripcion = $request->get('descripcion');
        $enfermedad->save();

        return redirect('/enfermedades');
    }

    public function update(Request $request, $id)
    {
        $enfermedad = Enfermedad::find($id);
        $enfermedad->nombre = $request->get('nombreU');
        $enfermedad->descripcion = $request->get('descripcionU');
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
