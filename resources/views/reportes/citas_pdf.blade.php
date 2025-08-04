<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Citas</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            background: #f4faff;
            margin: 0;
            padding: 0;
        }
        .reporte-header {
            background: linear-gradient(90deg,#e9f3ff 75%,#d6f3ea 100%);
            color: #00509e;
            padding: 16px 0 12px 0;
            text-align: center;
            border-radius: 0 0 14px 14px;
            border-bottom: 2px solid #b0d5fa;
            margin-bottom: 26px;
            box-shadow: 0 2px 10px #b2e2e36e;
            font-size: 1.7em;
            letter-spacing: 0.03em;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 10px #d9e2ed50;
            border-radius: 12px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #c2d5ee;
            padding: 7px 6px;
            text-align: center;
        }
        th {
            background: #eaf7fd;
            color: #0862b5;
            font-size: 1.07em;
            letter-spacing: 0.02em;
            font-weight: 700;
        }
        tr:nth-child(even) {
            background: #f6fcff;
        }
        tr:nth-child(odd) {
            background: #fefefe;
        }
        /* Badge por estado */
        .badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 11px;
            font-weight: 700;
            font-size: 0.95em;
            letter-spacing: 0.01em;
        }
        .badge-pendiente {
            background: #fff4db;
            color: #b76e00;
            border: 1px solid #ffe6a4;
        }
        .badge-confirmada {
            background: #e4ffea;
            color: #22996e;
            border: 1px solid #90f1c8;
        }
        .badge-finalizada {
            background: #d6eaff;
            color: #0862b5;
            border: 1px solid #afd6fa;
        }
        .badge-cancelada {
            background: #ffe4e8;
            color: #b10d3a;
            border: 1px solid #ffb9cd;
        }
        /* Responsive para PDF (no afecta en pantalla, ayuda en impresión) */
        @media print {
            .reporte-header {
                font-size: 1.2em;
                padding: 8px 0 7px 0;
            }
            th, td {
                padding: 4px 3px;
            }
        }
    </style>
</head>
<body>
    <div class="reporte-header">📋 Reporte de Citas</div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Paciente</th>
                <th>Doctor</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($citas as $cita)
                <tr>
                    <td>{{ $cita->idCita }}</td>
                    <td>{{ $cita->paciente->usuario->nombre ?? '-' }}</td>
                    <td>{{ $cita->doctor->usuario->nombre ?? '-' }}</td>
                    <td>{{ $cita->fechaCita }}</td>
                    <td>{{ \Carbon\Carbon::parse($cita->horaCita)->format('H:i') }}</td>
                    <td>
                        @php
                            $estado = strtolower($cita->estadoCita);
                        @endphp
                        @if($estado === 'pendiente')
                            <span class="badge badge-pendiente">Pendiente</span>
                        @elseif($estado === 'confirmada')
                            <span class="badge badge-confirmada">Confirmada</span>
                        @elseif($estado === 'finalizada')
                            <span class="badge badge-finalizada">Finalizada</span>
                        @elseif($estado === 'cancelada')
                            <span class="badge badge-cancelada">Cancelada</span>
                        @else
                            <span class="badge">{{ $cita->estadoCita }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:#aab3ba;background:#fafcfe;">No hay citas para este reporte.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
