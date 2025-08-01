<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfermedad;

class EnfermedadesController extends Controller
{
    public function index()
    {
        $listaEnfermedades = Enfermedad::all();
        return view('vistas.enfermedad')->with('listaEnfermedades', $listaEnfermedades);
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
        $enfermedad->nombre = $request->get('nombreEditar');
        $enfermedad->descripcion = $request->get('descripcionEditar');
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
