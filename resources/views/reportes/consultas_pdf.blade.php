<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Consultas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; background: #f8fafc;}
        h2 { color: #18b981; margin-bottom: 18px;}
        table { width: 100%; border-collapse: collapse; margin-top: 15px;}
        th, td { border: 1px solid #b7e4c7; padding: 6px 8px; text-align: left;}
        th { background: #e9fdf7; color: #10755e; }
        tr:nth-child(even) { background: #f5fcf9; }
        .text-center { text-align: center;}
        .fw-bold { font-weight: bold; }
        .small { font-size: 12px;}
    </style>
</head>
<body>
    <h2 class="text-center">Reporte de Consultas Médicas</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Paciente</th>
                <th>Doctor</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Motivo</th>
                <th>Diagnóstico</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($consultas as $i => $consulta)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ optional($consulta->cita->paciente->usuario)->nombre ?? 'N/D' }}</td>
                    <td>{{ optional($consulta->cita->doctor->usuario)->nombre ?? 'N/D' }}</td>
                    <td>{{ $consulta->cita->fechaCita ?? '' }}</td>
                    <td>{{ $consulta->cita->horaCita ?? '' }}</td>
                    <td>{{ $consulta->motivoConsulta }}</td>
                    <td>{{ $consulta->diagnostico }}</td>
                    <td>{{ $consulta->cita->estadoCita ?? '' }}</td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">No hay registros</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="small text-center" style="margin-top:18px;">
        Generado por el sistema Hospital EKO - {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
