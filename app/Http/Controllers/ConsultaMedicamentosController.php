<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsultaMedicamento;

class ConsultaMedicamentosController extends Controller
{
    public function index()
    {
        $listaConsultaMedicamentos = ConsultaMedicamento::all();
        return view('vistas.consultam')->with('listaConsultaMedicamentos', $listaConsultaMedicamentos);
    }

    public function store(Request $request)
    {
        $registro = new ConsultaMedicamento();
        $registro->idConsulta = $request->get('idConsulta');
        $registro->idMedicamento = $request->get('idMedicamento');
        $registro->cantidad = strtoupper($request->get('cantidad')); // <-- validación aplicada aquí
        $registro->save();

        return redirect('/consultaMedicamentos');
    }

    public function update(Request $request, $id)
    {
        $registro = ConsultaMedicamento::findOrFail($id);
        $registro->idConsulta = $request->get('idConsultaU');
        $registro->idMedicamento = $request->get('idMedicamentoU');
        $registro->cantidad =strtoupper ($request->get('cantidadU'));
        $registro->save();

        return redirect('/consultaMedicamentos');
    }

    public function destroy($id)
    {
        $registro = ConsultaMedicamento::findOrFail($id);
        $registro->delete();

        return redirect('/consultaMedicamentos');
    }
}
