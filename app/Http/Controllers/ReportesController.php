<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cita;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Paciente;
use App\Models\Consulta;
use App\Models\ConsultaMedicamento;
use App\Models\Administrador;
use App\Models\HistorialClinico;

class ReportesController extends Controller
{
    public function reporteCitasPdf(Request $request)
    {
        $query = Cita::with(['paciente.usuario', 'doctor.usuario']);

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fechaCita', [$request->fecha_inicio, $request->fecha_fin]);
        }
        if ($request->filled('estado')) {
            $query->where('estadoCita', $request->estado);
        }

        $citas = $query->orderBy('fechaCita', 'desc')->get();

        $pdf = Pdf::loadView('reportes.citas_pdf', compact('citas'));

        return $pdf->download('reporte_citas_' . now()->format('Ymd_His') . '.pdf');
    }

    public function reporteConsultasPdf(Request $request)
    {
        $query = Consulta::with([
            'cita.paciente.usuario', 
            'cita.doctor.usuario',
        ]);

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereHas('cita', function ($q) use ($request) {
                $q->whereBetween('fechaCita', [$request->fecha_inicio, $request->fecha_fin]);
            });
        }

        if ($request->filled('estado')) {
            $query->whereHas('cita', function ($q) use ($request) {
                $q->where('estadoCita', $request->estado);
            });
        }

        $consultas = $query->orderByDesc('idConsulta')->get();

        $pdf = Pdf::loadView('reportes.consultas_pdf', compact('consultas'));

        return $pdf->download('reporte_consultas_' . now()->format('Ymd_His') . '.pdf');
    }

}
