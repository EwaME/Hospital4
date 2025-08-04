<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bitácoras del Sistema</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            font-size: 12px; 
            background: #f4f9fb;
            color: #27384a;
        }
        h2 {
            color: #00509e;
            margin-bottom: 12px;
            font-size: 1.6em;
            letter-spacing: .01em;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
            background: #fff;
        }
        th, td { 
            border: 1px solid #b4d3ee; 
            padding: 7px 8px; 
            text-align: left;
            font-size: 12px;
        }
        th { 
            background: #00509e;
            color: #fff; 
            font-size: 13px;
            font-weight: bold;
        }
        tr:nth-child(even) { background: #f5fbff; }
        .badge {
            display: inline-block;
            padding: 3px 10px;
            font-size: 12px;
            border-radius: 10px;
            font-weight: bold;
            color: #fff;
            margin: 0 2px;
        }
        /* Badges por acción */
        .badge-crear { background: #18b981; }
        .badge-actualizar { background: #1976d2; }
        .badge-eliminar { background: #e05c3c; }
        .badge-login { background: #7e57c2; }
        .badge-logout { background: #0097a7; }
        .badge-exportar { background: #ebc634; color: #222; }
        .badge-ver { background: #00509e; }
        .badge-otro { background: #789; }
        /* Módulo badge */
        .badge-modulo {
            background: #e1f0fa;
            color: #00509e;
            border-radius: 8px;
            font-size: 11px;
            padding: 2px 9px;
            border: 1px solid #b5d5fa;
            font-weight: 600;
        }
        .usuario-badge {
            background: #e5f9ff;
            color: #12738f;
            border-radius: 9px;
            font-size: 11.5px;
            padding: 3px 9px;
            border: 1px solid #b2e1ee;
            font-weight: 600;
        }
        .row-eliminar { background: #fff3f1 !important;}
        .row-actualizar { background: #eaf6ff !important;}
    </style>
</head>
<body>
    <h2>Bitácoras del Sistema</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>Acción</th>
                <th>Descripción</th>
                <th>Módulo</th>
                <th>Fecha</th>
                <th>IP</th>
            </tr>
        </thead>
        <tbody>
        @foreach($bitacoras as $b)
            @php
                $accion = strtolower($b->accion ?? 'otro');
                $badgeClass = 'badge-otro';
                $rowClass = '';
                if(str_contains($accion,'crear') || str_contains($accion,'add') || str_contains($accion,'registrar')) {
                    $badgeClass = 'badge-crear';
                } else if(str_contains($accion,'editar') || str_contains($accion,'modificar') || str_contains($accion,'update')) {
                    $badgeClass = 'badge-actualizar';
                    $rowClass = 'row-actualizar';
                } else if(str_contains($accion,'eliminar') || str_contains($accion,'borrar') || str_contains($accion,'delete')) {
                    $badgeClass = 'badge-eliminar';
                    $rowClass = 'row-eliminar';
                } else if(str_contains($accion,'login') || str_contains($accion,'inicio')) {
                    $badgeClass = 'badge-login';
                } else if(str_contains($accion,'logout') || str_contains($accion,'cerrar')) {
                    $badgeClass = 'badge-logout';
                } else if(str_contains($accion,'exportar')) {
                    $badgeClass = 'badge-exportar';
                } else if(str_contains($accion,'ver') || str_contains($accion,'consultar')) {
                    $badgeClass = 'badge-ver';
                }
            @endphp
            <tr class="{{ $rowClass }}">
                <td>{{ $b->idBitacora }}</td>
                <td><span class="usuario-badge">{{ $b->usuario->nombre ?? 'Usuario desconocido' }}</span></td>
                <td><span class="badge {{ $badgeClass }}">{{ ucfirst($b->accion) }}</span></td>
                <td>{{ $b->descripcion }}</td>
                <td>
                    <span class="badge-modulo">{{ $b->modelo ?? '-' }}</span>
                </td>
                <td>{{ $b->created_at ? \Carbon\Carbon::parse($b->created_at)->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $b->ip ?? '-' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
