<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Lista de Enfermedades</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <style>
      .error-message {
        color: red;
        font-size: 0.875em;
        margin-top: 0.25rem;
        display: none;
      }
    </style>
  </head>
  <body>
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
            <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
            <li class="nav-item"><a class="nav-link" href="/roles">Roles</a></li>
            <li class="nav-item"><a class="nav-link" href="/pacientes">Pacientes</a></li>
            <li class="nav-item"><a class="nav-link" href="/doctores">Doctores</a></li>
            <li class="nav-item"><a class="nav-link" href="/usuarios">Usuarios</a></li>
            <li class="nav-item"><a class="nav-link" href="/medicamentos">Medicamentos</a></li>
            <li class="nav-item"><a class="nav-link active" href="/enfermedades">Enfermedades</a></li>
            <li class="nav-item"><a class="nav-link" href="/citas">Citas</a></li>
            <li class="nav-item"><a class="nav-link" href="/consultas">Consultas</a></li>
            <li class="nav-item"><a class="nav-link" href="/historialClinico">Historial Clínico</a></li>
            <li class="nav-item"><a class="nav-link" href="/bitacoras">Bitácoras</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-5 pt-5">
      <h1>Lista de Enfermedades</h1>

      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#mCrearEnfermedad">
        Crear enfermedad
      </button>

      <table class="table mt-3">
        <thead>
          <tr>
            <th>ID Enfermedad</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($listaEnfermedades as $enfermedad)
          <tr>
            <td>{{ $enfermedad->idEnfermedad }}</td>
            <td>{{ $enfermedad->nombre }}</td>
            <td>{{ $enfermedad->descripcion }}</td>
            <td>
              <button class="btn btn-primary ejecutar" data-bs-toggle="modal" data-bs-target="#mEditarEnfermedad"
                data-id="{{ $enfermedad->idEnfermedad }}" data-nombre="{{ $enfermedad->nombre }}"
                data-descripcion="{{ $enfermedad->descripcion }}">
                Editar
              </button>
            </td>
            <td>
              <form action="/enfermedades/delete/{{ $enfermedad->idEnfermedad }}" method="POST">
                @csrf @method('DELETE')
                <button class="btn btn-danger">Eliminar</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Modal CREAR -->
    <div class="modal fade" id="mCrearEnfermedad" tabindex="-1">
      <div class="modal-dialog">
        <form id="formCrear" action="/enfermedades/create" method="POST">
          @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Crear Enfermedad</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <label>Nombre:</label>
              <input type="text" id="nombre" name="nombre" class="form-control" required>
              <div class="error-message" id="errorNombreCrear"></div>

              <label class="mt-3">Descripción:</label>
              <input type="text" id="descripcion" name="descripcion" class="form-control" required>
              <div class="error-message" id="errorDescripcionCrear"></div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit">Guardar</button>
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal EDITAR -->
    <div class="modal fade" id="mEditarEnfermedad" tabindex="-1">
      <div class="modal-dialog">
        <form id="formEditar" method="POST">
          @csrf @method('PUT')
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Editar Enfermedad</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="idEnfermedadEditar" name="idEnfermedadEditar">

              <label>Nombre:</label>
              <input type="text" id="nombreEditar" name="nombreEditar" class="form-control" required>
              <div class="error-message" id="errorNombreEditar"></div>

              <label class="mt-3">Descripción:</label>
              <input type="text" id="descripcionEditar" name="descripcionEditar" class="form-control" required>
              <div class="error-message" id="errorDescripcionEditar"></div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit">Editar</button>
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <script>
      function soloLetras(selector, errorId) {
        $(selector).on('input', function () {
          var limpio = $(this).val().replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
          if ($(this).val() !== limpio) {
            $(this).val(limpio);
            $(errorId).text('Solo se permiten letras y espacios.').show();
            setTimeout(() => { $(errorId).hide(); }, 3000);
          }
        });
      }

      $(document).ready(function () {
        // Validación en tiempo real
        soloLetras('#nombre', '#errorNombreCrear');
        soloLetras('#descripcion', '#errorDescripcionCrear');
        soloLetras('#nombreEditar', '#errorNombreEditar');
        soloLetras('#descripcionEditar', '#errorDescripcionEditar');

        // Llenar modal editar
        $('.ejecutar').on('click', function () {
          let id = $(this).data('id');
          let nombre = $(this).data('nombre');
          let descripcion = $(this).data('descripcion');

          $('#idEnfermedadEditar').val(id);
          $('#nombreEditar').val(nombre);
          $('#descripcionEditar').val(descripcion);
          $('#formEditar').attr('action', '/enfermedades/edit/' + id);
        });

        // Validar campos vacíos
        $('#formCrear').on('submit', function (e) {
          let nombre = $('#nombre').val().trim();
          let descripcion = $('#descripcion').val().trim();
          let hayError = false;

          if (nombre === '') {
            $('#errorNombreCrear').text('Este campo es obligatorio.').show(); hayError = true;
          }
          if (descripcion === '') {
            $('#errorDescripcionCrear').text('Este campo es obligatorio.').show(); hayError = true;
          }
          if (hayError) {
            setTimeout(() => { $('.error-message').hide(); }, 3000);
            e.preventDefault();
          }
        });

        $('#formEditar').on('submit', function (e) {
          let nombre = $('#nombreEditar').val().trim();
          let descripcion = $('#descripcionEditar').val().trim();
          let hayError = false;

          if (nombre === '') {
            $('#errorNombreEditar').text('Este campo es obligatorio.').show(); hayError = true;
          }
          if (descripcion === '') {
            $('#errorDescripcionEditar').text('Este campo es obligatorio.').show(); hayError = true;
          }
          if (hayError) {
            setTimeout(() => { $('.error-message').hide(); }, 3000);
            e.preventDefault();
          }
        });

        // Resetear formularios al cerrar modales
        $('#mCrearEnfermedad, #mEditarEnfermedad').on('hidden.bs.modal', function () {
          $(this).find('form')[0].reset();
          $(this).find('.error-message').hide();
        });
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
