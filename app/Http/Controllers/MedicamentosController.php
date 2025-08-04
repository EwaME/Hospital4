<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;
use App\Http\Requests\MedicamentoRequest;
use Illuminate\Routing\Controller;


class MedicamentosController extends Controller
{
    public function index(Request $request)
    {
        $query = Medicamento::query();
        if ($request->has('search')) {
            $busqueda = $request->get('search');
            $query->where('nombre', 'LIKE', "%$busqueda%");
        }
        $listaMedicamentos = $query->get();

        if ($request->ajax()) {
            return response()->json(['listaMedicamentos' => $listaMedicamentos]);
        }
        return view('/vistas.Medicamentos')->with('listaMedicamentos', $listaMedicamentos);
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Acceso denegado');
        }
        $medicamento = new Medicamento();
        $medicamento->nombre = strtoupper ($request->get('nombre'));
        $medicamento->stock = strtoupper ($request->get('stock'));
        $medicamento->save();

        return redirect('/medicamentos');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Acceso denegado');
        }
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->nombre = strtoupper ($request->get('nombreU'));
        $medicamento->stock = strtoupper ($request->get('stockU'));
        $medicamento->save();

        return redirect('/medicamentos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->user()->hasRole('Admin')) {
            abort(403, 'Acceso denegado');
        }
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->delete();

        return redirect('/medicamentos');
    }
}
