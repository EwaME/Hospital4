<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class BitacorasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Bitacora::with('usuario');

        if ($request->filled('usuario')) {
            $query->where('idUsuario', $request->usuario);
        }
        if ($request->filled('accion')) {
            $query->where('accion', 'like', "%{$request->accion}%");
        }
        if ($request->filled('modelo')) {
            $query->where('modelo', $request->modelo);
        }
        if ($request->filled('fecha')) {
            $query->whereDate('created_at', $request->fecha);
        }

        $bitacoras = $query->orderBy('created_at', 'desc')->paginate(20);

        $usuarios = User::orderBy('nombre')->get();
        $modelos = Bitacora::select('modelo')->distinct()->pluck('modelo');

        return view('vistas.bitacoras', compact('bitacoras', 'usuarios', 'modelos'));
    }

    /**
     * Registrar manualmente en la bitácora (si lo necesitas en código custom).
     */
    public static function registrar($idUsuario, $accion, $descripcion, $modelo = null, $id_relacionado = null, $ip = null)
    {
        Bitacora::create([
            'idUsuario'      => $idUsuario,
            'accion'         => $accion,
            'descripcion'    => $descripcion,
            'modelo'         => $modelo,
            'id_relacionado' => $id_relacionado,
            'ip'             => $ip,
        ]);
    }

    public function exportarCsv(Request $request)
    {
        $query = \App\Models\Bitacora::query();

        if ($request->filled('usuario')) $query->where('idUsuario', $request->usuario);
        if ($request->filled('accion')) $query->where('accion', 'like', "%{$request->accion}%");
        if ($request->filled('modelo')) $query->where('modelo', $request->modelo);
        if ($request->filled('fecha')) $query->whereDate('created_at', $request->fecha);

        $bitacoras = $query->with('usuario')->orderBy('created_at', 'desc')->get();

        $filename = "bitacoras_" . date('Ymd_His') . ".csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($bitacoras) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['#', 'Usuario', 'Acción', 'Descripción', 'Módulo', 'Fecha', 'IP']);
            foreach ($bitacoras as $bitacora) {
                fputcsv($handle, [
                    $bitacora->idBitacora,
                    $bitacora->usuario->nombre ?? 'Usuario desconocido',
                    $bitacora->accion,
                    $bitacora->descripcion,
                    $bitacora->modelo ?? '-',
                    $bitacora->created_at ? \Carbon\Carbon::parse($bitacora->created_at)->format('d/m/Y H:i') : '-',
                    $bitacora->ip ?? '-',
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportarPdf(Request $request)
    {
        $query = \App\Models\Bitacora::query();

        if ($request->filled('usuario')) $query->where('idUsuario', $request->usuario);
        if ($request->filled('accion')) $query->where('accion', 'like', "%{$request->accion}%");
        if ($request->filled('modelo')) $query->where('modelo', $request->modelo);
        if ($request->filled('fecha')) $query->whereDate('created_at', $request->fecha);

        $bitacoras = $query->with('usuario')->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('pdf.bitacoras', compact('bitacoras'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('bitacoras_' . date('Ymd_His') . '.pdf');
    }

    public function exportarExcelBitacora()
    {
        $bitacoras = Bitacora::with('usuario')->get();

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=bitacora.xls");

        echo '<table border="1">';
        echo '<tr>
            <th>#</th>
            <th>Usuario</th>
            <th>Accion</th>
            <th>Descripcion</th>
            <th>Modulo</th>
            <th>Fecha</th>
            <th>IP</th>
        </tr>';
        foreach ($bitacoras as $bitacora) {
            echo '<tr>
                <td>' . $bitacora->idBitacora . '</td>
                <td>' . ($bitacora->usuario->nombre ?? 'Usuario desconocido') . '</td>
                <td>' . $bitacora->accion . '</td>
                <td>' . $bitacora->descripcion . '</td>
                <td>' . ($bitacora->modelo ?? '-') . '</td>
                <td>' . ($bitacora->created_at ? \Carbon\Carbon::parse($bitacora->created_at)->format('d/m/Y H:i') : '-') . '</td>
                <td>' . ($bitacora->ip ?? '-') . '</td>
            </tr>';
        }
        echo '</table>';
        exit;
    }

}
