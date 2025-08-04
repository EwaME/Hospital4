<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Reporte de Pacientes</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
        }
        .btn-pdf {
            display: block;
            width: 200px;
            margin: 10px auto;
            padding: 8px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        table.tabla {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
        }
        table.tabla th, table.tabla td {
            border: 1px solid #000;
            padding: 5px;
        }
        table.tabla th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2>Reporte de Pacientes</h2>

    <a href="{{ route('reporte.pacientes', ['pdf' => 1]) }}" class="btn-pdf" target="_blank">Descargar PDF</a>

    <table class="tabla">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Fecha de Nacimiento</th>
                <th>Género</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $p)
            <tr>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ \Carbon\Carbon::parse($p->fechaNacimiento)->format('d/m/Y') }}</td>
                <td>{{ ucfirst($p->genero) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
