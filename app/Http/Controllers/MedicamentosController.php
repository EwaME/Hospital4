<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;

class MedicamentosController extends Controller
{
    public function index()
    {
        $listaMedicamentos = Medicamento::all();
        return view('medicamentos.Medicamentos')->with('listaMedicamentos', $listaMedicamentos);
    }

    public function store(Request $request)
    {
        $medicamento = new Medicamento();
        $medicamento->nombre = $request->get('nombre');
        $medicamento->stock = $request->get('stock');
        $medicamento->save();

        return redirect('/medicamentos');
    }

    public function update(Request $request, $id)
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->nombre = $request->get('nombreU');
        $medicamento->stock = $request->get('stockU');
        $medicamento->save();

        return redirect('/medicamentos');
    }

    public function destroy($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->delete();

        return redirect('/medicamentos');
    }
}
    