<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;
use App\Http\Requests\MedicamentoRequest;
use Illuminate\Routing\Controller;


class MedicamentosController extends Controller
{
    public function index()
    {
        $listaMedicamentos = Medicamento::all();
        return view('/vistas.Medicamentos')->with('listaMedicamentos', $listaMedicamentos);
    }

    public function store(Request $request)
    {
        $medicamento = new Medicamento();
        $medicamento->nombre = $request->get('nombre');
        $medicamento->stock = $request->get('stock');
        $medicamento->save();

        return redirect('/medicamentos');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->nombre = $request->get('nombreU');
        $medicamento->stock = $request->get('stockU');
        $medicamento->save();

        return redirect('/medicamentos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->delete();

        return redirect('/medicamentos');
    }
}
