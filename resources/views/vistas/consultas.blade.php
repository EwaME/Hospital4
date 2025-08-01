<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <h1 class="text-center mb-4"> Gestión de Consultas</h1>

    <div class="d-flex justify-content-end">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCrearConsulta">
        <i class="fas fa-plus-circle"></i> Agregar Consulta
        </button>
    </div>

    <table class="table table-bordered w-100 mt-4">
        <thead>
        <tr>
            <th>Codigo Consulta</th>
            <th>Codigo Cita</th>
            <th>Paciente</th>
            <th>Doctor</th>
            <th>Enfermedad</th>
            <th>Diagnóstico</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($consultas as $consulta)
        <tr>
            <td>{{ $consulta->idConsulta }}</td>
            <td>{{ $consulta->idCita }}</td>
            <td>{{ $consulta->nombrePaciente }}</td>
            <td>{{ $consulta->nombreDoctor }}</td>
            <td>{{ $consulta->nombreEnfermedad }}</td>
            <td>{{ $consulta->diagnostico }}</td>
            <td>{{ $consulta->fecha }}</td>
            <td>
            <button class="btn btn-secondary editar"
                data-bs-toggle="modal" data-bs-target="#modalEditarConsulta"
                data-id="{{ $consulta->idConsulta }}"
                data-idcita="{{ $consulta->idCita }}"
                data-paciente="{{ $consulta->nombrePaciente }}"
                data-doctor="{{ $consulta->nombreDoctor }}"
                data-fecha="{{ $consulta->fecha }}"
                data-idEnfermedad="{{ $consulta->idEnfermedad }}"
                data-diagnostico="{{ $consulta->diagnostico }}">
                <i class="fas fa-edit"></i> Editar</button>
            <button class="btn btn-danger eliminar"
                data-bs-toggle="modal" data-bs-target="#modalEliminarConsulta"
                data-id="{{ $consulta->idConsulta }}"
                data-paciente="{{ $consulta->nombrePaciente }}">
                <i class="fas fa-trash"></i> Eliminar</button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalCrearConsulta" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/consultas/guardar" method="POST" class="modal-content p-3">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Crear Consulta</h5>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Cita</label>
                <select name="idCita" id="selectCitaCrear" class="form-control" required>
                    @foreach($citas as $cita)
                        <option value="{{ $cita->idCita }}" data-fecha="{{ $cita->fechaCita }}">
                            Dr. {{ $cita->doctor->usuario->nombre }} (Cita #{{ $cita->idCita }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Fecha</label>
                <input type="date" name="fecha" id="fechaCitaSeleccionada" class="form-control" readonly required>
            </div>
            <div class="mb-3">
                <label>Enfermedad</label>
                <select name="idEnfermedad" class="form-control" required>
                    @foreach($enfermedades as $enf)
                    <option value="{{ $enf->idEnfermedad }}">{{ $enf->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Diagnóstico</label>
                <textarea name="diagnostico" class="form-control" rows="2" required></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" type="submit">Guardar</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div>
</div>


<div class="modal fade" id="modalEditarConsulta" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/consultas/editar" method="POST" class="modal-content p-3">
        @csrf
        <input type="hidden" name="idConsulta" id="edit_idConsulta">
        <div class="modal-header">
            <h5 class="modal-title">Editar Consulta</h5>
        </div>
        <div class="modal-body">
            <div class="mb-3">
            <label>Cita</label>
            <select name="idCita" id="edit_idCita" class="form-control" required>
                @foreach($citas as $cita)
                <option value="{{ $cita->idCita }}">{{ $cita->descripcion }}</option>
                @endforeach
            </select>
            </div>
            <div class="mb-3">
            <label>Paciente</label>
            <input type="text" name="nombrePaciente" id="edit_nombrePaciente" class="form-control" required>
            </div>
            <div class="mb-3">
            <label>Doctor</label>
            <input type="text" name="nombreDoctor" id="edit_nombreDoctor" class="form-control" required>
            </div>
            <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" id="edit_fecha" class="form-control" required>
            </div>
            <div class="mb-3">
            <label>Enfermedad</label>
            <select name="idEnfermedad" id="edit_idEnfermedad" class="form-control" required>
                @foreach($enfermedades as $enf)
                <option value="{{ $enf->idEnfermedad }}">{{ $enf->nombre }}</option>
                @endforeach
            </select>            
            </div>
            <div class="mb-3">
            <label>Diagnóstico</label>
            <textarea name="diagnostico" id="edit_diagnostico" class="form-control" rows="2" required></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit">Actualizar</button>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
        </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalEliminarConsulta" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/consultas/eliminar" method="POST" class="modal-content p-3">
        @csrf
        <input type="hidden" name="idConsulta" id="delete_idConsulta">
        <div class="modal-header">
            <h5 class="modal-title">Eliminar Consulta</h5>
        </div>
        <div class="modal-body">
            <p>¿Desea eliminar la consulta de <strong id="delete_nombrePaciente_text"></strong>?</p>
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
    $(document).ready(function() {
        $('.editar').on('click', function () {
            $('#edit_idConsulta').val($(this).data('id'));
            $('#edit_idCita').val($(this).data('idcita'));
            $('#edit_nombrePaciente').val($(this).data('paciente'));
            $('#edit_nombreDoctor').val($(this).data('doctor'));
            $('#edit_fecha').val($(this).data('fecha'));
            $('#edit_idEnfermedad').val($(this).data('idenfermedad'));
            $('#edit_diagnostico').val($(this).data('diagnostico'));
        });

        $('.eliminar').on('click', function () {
            $('#delete_idConsulta').val($(this).data('id'));
            $('#delete_nombrePaciente_text').text($(this).data('paciente'));
        });

        function actualizarFechaDesdeCita() {
            var fecha = $('#selectCitaCrear option:selected').data('fecha');
            $('#fechaCitaSeleccionada').val(fecha);
        }

        $('#modalCrearConsulta').on('shown.bs.modal', function () {
            actualizarFechaDesdeCita();
        });

        $('#selectCitaCrear').on('change', actualizarFechaDesdeCita);
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
            <li class="nav-item"><a class="nav-link" href="/citas">Citas</a></li>
            <li class="nav-item"><a class="nav-link active" href="/consultas">Consultas</a></li>
            <li class="nav-item"><a class="nav-link" href="/consultaMedicamentos">Consulta Medicamentos</a></li>
            <li class="nav-item"><a class="nav-link" href="/historialClinico">Historial Clínico</a></li>
            <li class="nav-item"><a class="nav-link" href="/bitacoras">Bitácoras</a></li>
        </ul>
        </div>
    </div>
</nav>
</body>
</html>
