<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Citas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #e9f3ff 0%, #d5f3ea 100%);
            min-height: 100vh;
        }
        .main-content {
            margin-left: 260px;
            transition: margin-left 0.25s;
        }
        .main-collapsed {
            margin-left: 70px !important;
        }
        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
            }
        }
        .glass-bg {
            background: linear-gradient(135deg, rgba(248,252,255,0.97) 0%, rgba(48,107,165,0.09) 100%);
            border-radius: 1.7rem;
            border: 1.5px solid #b5d5fa;
            box-shadow: 0 10px 36px 0 rgba(0, 80, 158, 0.14), 0 2px 12px #00509e13;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 2.7rem 2.1rem 2rem 2.1rem;
            margin-top: 3.7rem;
            animation: fade-in-up 0.8s cubic-bezier(.4,2,.6,1) both;
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(60px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .citas-header {
            font-size: 2.3rem;
            font-weight: 900;
            color: #00509e;
            text-shadow: 0 2px 16px #00509e23;
            letter-spacing: 0.01em;
            margin-bottom: 2.1rem;
            text-align: center;
            display: flex;
            gap: .5em;
            justify-content: center;
            align-items: center;
        }
        .citas-header .fa-calendar-check {
            color: #18B981;
            font-size: 1.2em;
            filter: drop-shadow(0 2px 9px #00509e21);
        }
        .table-glass {
            background: rgba(255,255,255,0.95);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 2px 16px #00509e10;
            border: 1.3px solid #e3f1ff;
            transition: box-shadow 0.2s;
        }
        .table-glass th, .table-glass td {
            vertical-align: middle !important;
            padding: 0.85em 1em;
        }
        .table-glass th {
            background: rgba(11, 112, 187, 0.13);
            color: #00509e;
            font-size: 1.11rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            position: sticky;
            top: 0;
            z-index: 3;
            box-shadow: 0 2px 7px #00509e11;
        }
        .table-glass tbody tr:hover {
            background: rgba(24,185,129,0.13) !important;
        }
        .table-glass td {
            font-size: 1.03rem;
            color: #263253;
            transition: color 0.2s;
        }
        .fw-bold { font-weight: 600 !important; }
        .btn-glass, .btn-ico {
            background: linear-gradient(92deg, #14996b 40%, #18B981 100%);
            color: #fff !important;
            font-weight: 500;
            border: none;
            border-radius: 0.9em;
            box-shadow: 0 2px 12px #00509e18;
            transition: background 0.2s, transform 0.17s, box-shadow 0.2s;
        }
        .btn-glass:hover, .btn-ico:hover, .btn-glass:focus, .btn-ico:focus {
            background: linear-gradient(92deg, #0eab78 30%, #16e59d 100%);
            box-shadow: 0 8px 18px #00509e2c;
            transform: scale(1.057);
            color: #fff;
        }
        .btn-ico {
            padding: 0.53em 0.68em;
            border-radius: 50%;
            font-size: 1.1em;
            margin: 0 .14em;
            background: linear-gradient(88deg, #e1f6f0 40%, #d1f6ff 100%);
            color: #14996b !important;
            border: 1.4px solid #e0ebf5;
            box-shadow: 0 1px 8px #14996b17;
            transition: background 0.2s, color 0.14s, box-shadow 0.2s, border 0.18s;
        }
        .btn-ico.edit { color: #1976D2 !important; border-color: #bee1ff; background: #f6faff;}
        .btn-ico.edit:hover { background: #e2f3ff; color: #125fb7 !important;}
        .btn-ico.del { color: #e05c3c !important; border-color: #ffdad2; background: #fff7f6;}
        .btn-ico.del:hover { background: #ffebe6; color: #af2d08 !important;}
        .btn-ico.estado { color: #18b981 !important; border-color: #cbf8ea; background: #edfcf8;}
        .btn-ico.estado:hover { background: #d8faee; color: #089f73 !important;}
        .btn-glass i, .btn-ico i { margin-right: 0; }
        .badge-cita {
            display: inline-block;
            padding: .4em 1em;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: .01em;
            font-size: .98em;
            margin-bottom: 0.18em;
            margin-right: 0.3em;
            border: 1px solid #e0ebf5;
            box-shadow: 0 1px 5px #00509e13;
            background: linear-gradient(95deg,#eaf6ff 70%,#b8e7fa 100%);
            color: #1976D2;
        }
        .badge-pendiente {
            background: linear-gradient(95deg,#fff9e2 60%,#fbeabb 100%);
            color: #b98d00;
            border-color: #f7e7a5;
        }
        .badge-confirmada {
            background: linear-gradient(92deg,#eafcff 70%,#b2f2fb 100%);
            color: #149bc7;
            border-color: #c4effa;
        }
        .badge-cancelada {
            background: linear-gradient(92deg,#ffe9e9 70%,#ffc1c1 100%);
            color: #da3a38;
            border-color: #ffbdbd;
        }
        .badge-finalizada {
            background: linear-gradient(95deg,#eafff3 60%,#b7f9d3 100%);
            color: #16a14a;
            border-color: #bff5d2;
        }
        .form-control, .form-select {
            border-radius: 0.75em !important;
            background: rgba(255,255,255,0.93) !important;
            border: 1.4px solid #c7e5f8 !important;
            box-shadow: 0 1.5px 6px #00509e11;
            font-size: 1.04em !important;
            transition: border 0.18s, box-shadow 0.22s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #18b981 !important;
            box-shadow: 0 0 0 2px #18b9813c !important;
        }
        label.form-label {
            font-weight: 600;
            color: #1976d2;
            margin-bottom: .5em;
        }
        .modal-content.glass-bg {
            padding: 2rem 2.1rem 1.5rem 2.1rem !important;
        }
        .modal-header {
            border-bottom: none;
            background: transparent;
            padding-bottom: 0;
        }
        .modal-title {
            color: #00509e;
            font-weight: bold;
            font-size: 1.35rem;
            letter-spacing: 0.02em;
        }
        .modal-footer {
            border-top: none;
            background: transparent;
            padding-top: 0;
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }
        @media (max-width: 575px) {
            .glass-bg { padding: 0.7rem 0.05rem; }
            .table-glass th, .table-glass td { font-size: .91rem;}
            .citas-header { font-size: 1.12rem;}
            .btn-glass, .btn-ico { font-size: 1em; padding: 0.37em 0.71em;}
            .modal-content.glass-bg { padding: 1.1rem 0.8rem 1.1rem 0.8rem !important;}
        }
    </style>
</head>
<body>
<body>
<div class="d-flex">
    @include('components.layouts.sidebar')
    <main id="main-content" class="main-content flex-fill p-4">
        <div class="glass-bg mx-auto" style="max-width: 1050px;">
            {{-- Mensajes flash --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <h1 class="citas-header">
                <i class="fas fa-calendar-check"></i>
                @role('Paciente')
                    Mis Citas Médicas
                @elserole('Doctor')
                    Citas de Mis Pacientes
                @elserole('Admin')
                    Gestión Completa de Citas
                @endrole
            </h1>

            @role('Admin')
            <div class="d-flex justify-content-end">
                <button class="btn btn-glass mb-3" data-bs-toggle="modal" data-bs-target="#modalCrearCita">
                    <i class="fas fa-plus-circle"></i> Agregar Cita
                </button>
            </div>
            @endrole

            <div class="table-responsive">
                <table class="table table-glass align-middle w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($citas as $cita)
                        <tr>
                            <td class="fw-bold">{{ $cita->idCita }}</td>
                            <td>{{ ucwords(strtolower($cita->paciente->usuario->nombre ?? 'Desconocido')) }}</td>
                            <td>{{ ucwords(strtolower($cita->doctor->usuario->nombre ?? 'Desconocido')) }}</td>
                            <td>{{ $cita->fechaCita }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->horaCita)->format('H:i') }}</td>
                            <td>
                                <span class="badge badge-cita
                                    @if($cita->estadoCita=='Pendiente') badge-pendiente
                                    @elseif($cita->estadoCita=='Confirmada') badge-confirmada
                                    @elseif($cita->estadoCita=='Cancelada') badge-cancelada
                                    @else badge-finalizada @endif">
                                    {{ ucfirst(strtolower($cita->estadoCita)) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @role('Admin')
                                    <button class="btn btn-ico edit editar"
                                        data-bs-toggle="modal" data-bs-target="#modalEditarCita"
                                        data-id="{{ $cita->idCita }}"
                                        data-idpaciente="{{ $cita->idPaciente }}"
                                        data-iddoctor="{{ $cita->idDoctor }}"
                                        data-fecha="{{ $cita->fechaCita }}"
                                        data-hora="{{ \Carbon\Carbon::parse($cita->horaCita)->format('H:i') }}"
                                        data-estado="{{ $cita->estadoCita }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @if(in_array($cita->estadoCita, ['Cancelada', 'Finalizada']))
                                    <button type="button" class="btn btn-ico del eliminar-cita"
                                        data-bs-toggle="modal" data-bs-target="#modalEliminarCita"
                                        data-id="{{ $cita->idCita }}"
                                        data-codigo="{{ $cita->idCita }}"
                                        data-paciente="{{ ucwords(strtolower($cita->paciente->usuario->nombre ?? '')) }}"
                                        data-doctor="{{ ucwords(strtolower($cita->doctor->usuario->nombre ?? '')) }}"
                                        data-fecha="{{ $cita->fechaCita }}"
                                        title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                @endrole

                                @role('Doctor')
                                    <button class="btn btn-ico estado cambiar-estado"
                                        data-bs-toggle="modal" data-bs-target="#modalEstadoCita"
                                        data-id="{{ $cita->idCita }}"
                                        data-estado="{{ $cita->estadoCita }}">
                                        <i class="fas fa-exchange-alt"></i>
                                    </button>
                                @endrole
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No hay citas registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

{{-- Modal Crear (Admin) --}}
@role('Admin')
<div class="modal fade" id="modalCrearCita" tabindex="-1" aria-labelledby="modalCrearCitaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content glass-bg">
            <form action="/citas" method="POST" id="formCrearCita">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearCitaLabel">Agregar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Paciente</label>
                        <select name="idPaciente" class="form-select" required>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->idPaciente }}">{{ ucwords(strtolower($paciente->usuario->nombre)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Doctor</label>
                        <select name="idDoctor" class="form-select" required>
                            @foreach($doctores as $doctor)
                                <option value="{{ $doctor->idDoctor }}">{{ ucwords(strtolower($doctor->usuario->nombre)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" name="fechaCita" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hora</label>
                        <select name="horaCita" class="form-select" required>
                            <option value="">Selecciona una hora</option>
                            @foreach(['07:30:00','08:00:00','08:30:00','09:00:00','09:30:00','10:00:00','10:30:00','11:00:00','11:30:00','13:00:00','13:30:00','14:00:00','14:30:00','15:00:00','15:30:00','16:00:00','16:30:00'] as $hora)
                                <option value="{{ $hora }}">{{ \Carbon\Carbon::createFromFormat('H:i:s', $hora)->format('H:i') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="estadoCita" class="form-select" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Confirmada">Confirmada</option>
                            <option value="Cancelada">Cancelada</option>
                            <option value="Finalizada">Finalizada</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-glass" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endrole

{{-- Modal Editar (Admin) --}}
@role('Admin')
<div class="modal fade" id="modalEditarCita" tabindex="-1" aria-labelledby="modalEditarCitaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content glass-bg">
            <form action="/citas/actualizar" method="POST" id="formEditarCita">
                @csrf
                @method('PUT')
                <input type="hidden" name="idCita" id="editIdCita">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarCitaLabel">Editar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Paciente</label>
                        <select class="form-select" id="editIdPaciente" name="idPaciente" required>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->idPaciente }}">{{ ucwords(strtolower($paciente->usuario->nombre)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Doctor</label>
                        <select class="form-select" id="editIdDoctor" name="idDoctor" required>
                            @foreach($doctores as $doctor)
                                <option value="{{ $doctor->idDoctor }}">{{ ucwords(strtolower($doctor->usuario->nombre)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="editFechaCita" name="fechaCita" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hora</label>
                        <select class="form-select" id="editHoraCita" name="horaCita" required>
                            @foreach(['07:30:00','08:00:00','08:30:00','09:00:00','09:30:00','10:00:00','10:30:00','11:00:00','11:30:00','13:00:00','13:30:00','14:00:00','14:30:00','15:00:00','15:30:00','16:00:00','16:30:00'] as $hora)
                                <option value="{{ $hora }}">{{ \Carbon\Carbon::createFromFormat('H:i:s', $hora)->format('H:i') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" id="editEstadoCita" name="estadoCita" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Confirmada">Confirmada</option>
                            <option value="Cancelada">Cancelada</option>
                            <option value="Finalizada">Finalizada</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-glass" type="submit">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endrole

@role('Admin')
<div class="modal fade" id="modalEliminarCita" tabindex="-1" aria-labelledby="modalEliminarCitaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content glass-bg">
            <form action="/citas/eliminar" method="POST" id="formEliminarCita">
                @csrf
                <input type="hidden" name="idCita" id="delete_idCita">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarCitaLabel">Eliminar Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>
                        ¿Estás seguro de que quieres eliminar la cita
                        <span id="delete_cita_codigo" class="fw-bold"></span>
                        de <span id="delete_cita_paciente" class="fw-bold"></span>
                        con el doctor <span id="delete_cita_doctor" class="fw-bold"></span>
                        el <span id="delete_cita_fecha" class="fw-bold"></span>?
                    </p>
                    <div class="alert alert-warning mt-2">
                        Esta acción <b>no se puede deshacer</b>.
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-danger" type="submit">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endrole

@role('Doctor')
<div class="modal fade" id="modalEstadoCita" tabindex="-1" aria-labelledby="modalEstadoCitaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content glass-bg">
            <form action="{{ route('citas.cambiarEstado', 0) }}" method="POST" id="formEstadoCita">
                @csrf
                @method('PATCH')
                <input type="hidden" name="idCita" id="estado_idCita">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEstadoCitaLabel">Cambiar Estado de la Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" id="estado_estadoCita" name="estadoCita" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Confirmada">Confirmada</option>
                            <option value="Cancelada">Cancelada</option>
                            <option value="Finalizada">Finalizada</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-glass" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endrole

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#modalEditarCita').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        $('#editIdCita').val(button.data('id'));
        $('#editIdPaciente').val(button.data('idpaciente'));
        $('#editIdDoctor').val(button.data('iddoctor'));
        $('#editFechaCita').val(button.data('fecha'));
        if (button.data('hora')) {
            let hora = button.data('hora').trim();
            $('#editHoraCita option').each(function() {
                if($(this).val().startsWith(hora)) {
                    $(this).prop('selected', true);
                }
            });
        }
        $('#editEstadoCita').val(button.data('estado'));
    });

    $('#modalEstadoCita').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        $('#estado_idCita').val(button.data('id'));
        $('#estado_estadoCita').val(button.data('estado'));
        $('#formEstadoCita').attr('action', '/citas/' + button.data('id') + '/cambiar-estado');
    });

    $('.eliminar-cita').on('click', function () {
        $('#delete_idCita').val($(this).data('id'));
        $('#delete_cita_codigo').text($(this).data('codigo') || '');
        $('#delete_cita_paciente').text($(this).data('paciente') || '');
        $('#delete_cita_doctor').text($(this).data('doctor') || '');
        $('#delete_cita_fecha').text($(this).data('fecha') || '');
    });
});
</script>
</body>
</html>