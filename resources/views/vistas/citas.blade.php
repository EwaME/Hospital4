<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Citas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5 pt-5">
    <h1 class="text-center mb-4">Gestión de Citas</h1>

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCrearCita">
            <i class="fas fa-plus-circle"></i> Agregar Cita
        </button>
    </div>

    <table class="table table-bordered w-100 mt-4">
        <thead>
            <tr>
                <th>Codigo Cita</th>
                <th>Paciente</th>
                <th>Doctor</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
            <tr>
                <td>{{ $cita->idCita }}</td>
                <td>{{ $cita->paciente->usuario->nombre ?? 'Paciente desconocido' }}</td>
                <td>{{ $cita->doctor->usuario->nombre ?? 'Doctor desconocido' }}</td>
                <td>{{ $cita->fechaCita }}</td>
                <td>{{ \Carbon\Carbon::parse($cita->horaCita)->format('H:i') }}</td>
                <td>{{ $cita->estadoCita }}</td>
                <td>
                    <button class="btn btn-secondary editar"
                        data-bs-toggle="modal" data-bs-target="#modalEditarCita"
                        data-id="{{ $cita->idCita }}"
                        data-idpaciente="{{ $cita->idPaciente }}"
                        data-iddoctor="{{ $cita->idDoctor }}"
                        data-fecha="{{ $cita->fechaCita }}"
                        data-hora="{{ \Carbon\Carbon::parse($cita->horaCita)->format('H:i') }}"
                        data-estado="{{ $cita->estadoCita }}">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn btn-danger eliminar"
                        data-bs-toggle="modal" data-bs-target="#modalEliminarCita"
                        data-id="{{ $cita->idCita }}">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalCrearCita" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/citas/guardar" method="POST" class="modal-content p-3">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Crear Cita</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Paciente</label>
                    <select name="idPaciente" class="form-control" required>
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente->idPaciente }}">{{ $paciente->usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Doctor</label>
                    <select name="idDoctor" class="form-control" required>
                        @foreach($doctores as $doctor)
                            <option value="{{ $doctor->idDoctor }}">{{ $doctor->usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Fecha</label>
                    <input type="date" name="fechaCita" class="form-control" required>
                </div>
                <select name="horaCita" class="form-control" required>
                    <option value="">Selecciona una hora</option>
                    <option value="08:00:00">07:30</option>
                    <option value="08:00:00">08:00</option>
                    <option value="08:30:00">08:30</option>
                    <option value="09:00:00">09:00</option>
                    <option value="09:30:00">09:30</option>
                    <option value="10:00:00">10:00</option>
                    <option value="10:30:00">10:30</option>
                    <option value="11:00:00">11:00</option>
                    <option value="11:30:00">11:30</option>
                    <option value="13:00:00">13:00</option>
                    <option value="13:30:00">13:30</option>
                    <option value="14:00:00">14:00</option>
                    <option value="14:30:00">14:30</option>
                    <option value="15:00:00">15:00</option>
                    <option value="15:30:00">15:30</option>
                    <option value="16:00:00">16:00</option>
                    <option value="16:30:00">16:30</option>
                </select>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="estadoCita" class="form-control" required>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Confirmada">Confirmada</option>
                        <option value="Cancelada">Cancelada</option>
                        <option value="Finalizada">Finalizada</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Guardar</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEditarCita" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/citas/editar" method="POST" class="modal-content p-3">
            @csrf
            <input type="hidden" name="idCita" id="edit_idCita">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cita</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Paciente</label>
                    <select name="idPaciente" id="edit_idPaciente" class="form-control" required>
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente->idPaciente }}">{{ $paciente->usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Doctor</label>
                    <select name="idDoctor" id="edit_idDoctor" class="form-control" required>
                        @foreach($doctores as $doctor)
                            <option value="{{ $doctor->idDoctor }}">{{ $doctor->usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Fecha</label>
                    <input type="date" name="fechaCita" id="edit_fechaCita" class="form-control" required>
                </div>
                <select name="horaCita" id="edit_horaCita" class="form-control" required>
                    <option value="">Selecciona una hora</option>
                    <option value="08:00:00">07:30</option>
                    <option value="08:00:00">08:00</option>
                    <option value="08:30:00">08:30</option>
                    <option value="09:00:00">09:00</option>
                    <option value="09:30:00">09:30</option>
                    <option value="10:00:00">10:00</option>
                    <option value="10:30:00">10:30</option>
                    <option value="11:00:00">11:00</option>
                    <option value="11:30:00">11:30</option>
                    <option value="13:00:00">13:00</option>
                    <option value="13:30:00">13:30</option>
                    <option value="14:00:00">14:00</option>
                    <option value="14:30:00">14:30</option>
                    <option value="15:00:00">15:00</option>
                    <option value="15:30:00">15:30</option>
                    <option value="16:00:00">16:00</option>
                    <option value="16:30:00">16:30</option>
                </select>
                <div class="mb-3">
                    <label>Estado</label>
                    <select name="estadoCita" id="edit_estadoCita" class="form-control" required>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Confirmada">Confirmada</option>
                        <option value="Cancelada">Cancelada</option>
                        <option value="Finalizada">Finalizada</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Actualizar</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEliminarCita" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/citas/eliminar" method="POST" class="modal-content p-3">
            @csrf
            <input type="hidden" name="idCita" id="delete_idCita">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Cita</h5>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar esta cita?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="submit">Eliminar</button>
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('.editar').on('click', function () {
            $('#edit_idCita').val($(this).data('id'));
            $('#edit_idPaciente').val($(this).data('idpaciente'));
            $('#edit_idDoctor').val($(this).data('iddoctor'));
            $('#edit_fechaCita').val($(this).data('fecha'));
            $('#edit_horaCita').val($(this).data('hora'));
            $('#edit_estadoCita').val($(this).data('estado'));
        });

        $('.eliminar').on('click', function () {
            $('#delete_idCita').val($(this).data('id'));
        });
    });
</script>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Gestión de Datos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="dashboard">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="/roles">Roles</a></li>
            <li class="nav-item"><a class="nav-link" href="/pacientes">Pacientes</a></li>
            <li class="nav-item"><a class="nav-link" href="/doctores">Doctores</a></li>
            <li class="nav-item"><a class="nav-link" href="/usuarios">Usuarios</a></li>
            <li class="nav-item"><a class="nav-link" href="/medicamentos">Medicamentos</a></li>
            <li class="nav-item"><a class="nav-link" href="/enfermedades">Enfermedades</a></li>
            <li class="nav-item"><a class="nav-link active" href="/citas">Citas</a></li>
            <li class="nav-item"><a class="nav-link" href="/consultas">Consultas</a></li>
            <li class="nav-item"><a class="nav-link" href="/consultaMedicamentos">Consulta Medicamentos</a></li>
            <li class="nav-item"><a class="nav-link" href="/historialClinico">Historial Clínico</a></li>
            <li class="nav-item"><a class="nav-link" href="/bitacoras">Bitácoras</a></li>
        </ul>
        </div>
    </div>
</nav>

</body>
</html>
