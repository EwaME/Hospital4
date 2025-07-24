<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Enfermedades</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
      crossorigin="anonymous"
    />
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
    <div class="container">
      <h1>Lista de Enfermedades</h1>

      <button
        class="btn btn-success"
        data-bs-toggle="modal"
        data-bs-target="#mCrearEnfermedad"
      >
        Crear enfermedad
      </button>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID Enfermedad</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($listaEnfermedades as $enfermedad)
          <tr>
            <th scope="row">{{ $enfermedad->idEnfermedad }}</th>
            <td>{{ $enfermedad->nombre }}</td>
            <td>{{ $enfermedad->descripcion }}</td>

            <td>
              <button
                class="btn btn-primary ejecutar"
                data-bs-toggle="modal"
                data-bs-target="#mEditarEnfermedad"
                data-id="{{ $enfermedad->idEnfermedad }}"
                data-nombre="{{ $enfermedad->nombre }}"
                data-descripcion="{{ $enfermedad->descripcion }}"
              >
                Editar
              </button>
            </td>

            <td>
              <button
                class="btn btn-danger eli"
                data-bs-toggle="modal"
                data-bs-target="#mEliminarEnfermedad"
                data-ideli="{{ $enfermedad->idEnfermedad }}"
                data-nombreeli="{{ $enfermedad->nombre }}"
              >
                Eliminar
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="modal" id="mCrearEnfermedad">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Crear Enfermedad</h2>
            </div>
            <div class="modal-body">
              <form action="/enfermedades" id="miForm" method="POST" novalidate>
                @csrf
                <div class="form-floating mb-3">
                  <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    class="form-control"
                    required
                    pattern="[A-Za-z\s]+"
                    title="Solo letras y espacios, bro"
                    autocomplete="off"
                  />
                  <label for="nombre">Nombre</label>
                  <div class="error-message" id="errorNombreCrear">
                    Solo se permiten letras y espacios, bro
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <textarea
                    id="descripcion"
                    name="descripcion"
                    class="form-control"
                    required
                    rows="3"
                  ></textarea>
                  <label for="descripcion">Descripción</label>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit" form="miForm">
                Guardar
              </button>
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                Cancelar
              </button>
            </div>
              </form>
          </div>
        </div>
      </div>

      <div class="modal" id="mEditarEnfermedad">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Editar Enfermedad</h2>
            </div>
            <div class="modal-body">
              <form action="" id="miFormU" method="POST" novalidate>
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                  <input
                    type="text"
                    id="idEnfermedadU"
                    name="idEnfermedadU"
                    class="form-control"
                    readonly
                  />
                  <label for="idEnfermedadU">ID Enfermedad</label>
                </div>
                <div class="form-floating mb-3">
                  <input
                    type="text"
                    id="nombreU"
                    name="nombreU"
                    class="form-control"
                    required
                    pattern="[A-Za-z\s]+"
                    title="Solo letras y espacios, bro"
                    autocomplete="off"
                  />
                  <label for="nombreU">Nombre</label>
                  <div class="error-message" id="errorNombreEditar">
                    Solo se permiten letras y espacios, bro
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <textarea
                    id="descripcionU"
                    name="descripcionU"
                    class="form-control"
                    required
                    rows="3"
                  ></textarea>
                  <label for="descripcionU">Descripción</label>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit" form="miFormU">
                Editar
              </button>
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                Cancelar
              </button>
            </div>
              </form>
          </div>
        </div>
      </div>

      <div class="modal" id="mEliminarEnfermedad">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Eliminar Enfermedad</h2>
            </div>
            <div class="modal-body">
              <form action="" id="miFormE" method="POST">
                @csrf @method('DELETE')
                <div class="form-floating mb-3">
                  <input
                    type="text"
                    id="idEnfermedadE"
                    name="idEnfermedadE"
                    class="form-control"
                    readonly
                  />
                  <label for="idEnfermedadE">ID Enfermedad</label>
                </div>
                <div class="form-floating mb-3">
                  <input
                    type="text"
                    id="nombreE"
                    name="nombreE"
                    class="form-control"
                    readonly
                  />
                  <label for="nombreE">Nombre</label>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit" form="miFormE">
                Eliminar
              </button>
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                Cancelar
              </button>
            </div>
              </form>
          </div>
        </div>
      </div>
    </div>

  <script>
  $(document).ready(function () {
    $('.ejecutar').on('click', function () {
      let id = $(this).data('id');
      let nombre = $(this).data('nombre');
      let descripcion = $(this).data('descripcion');
      $('#idEnfermedadU').val(id);
      $('#nombreU').val(nombre);
      $('#descripcionU').val(descripcion);
      $('#miFormU').attr('action', '/enfermedades/edit/' + id);
      $('#errorNombreEditar').hide();
    });

    $('.eli').on('click', function () {
      let ideli = $(this).data('ideli');
      let nombreeli = $(this).data('nombreeli');
      $('#idEnfermedadE').val(ideli);
      $('#nombreE').val(nombreeli);
      $('#miFormE').attr('action', '/enfermedades/delete/' + ideli);
    });

    // NO PERMITIR NUMEROS AL ESCRIBIR EN NOMBRE CREAR
    $('#nombre').on('keydown', function (e) {
      const key = e.key;
      const allowedKeys = ['Backspace', 'ArrowLeft', 'ArrowRight', 'Delete', 'Tab', ' '];
      if (!/^[a-zA-Z\s]$/.test(key) && !allowedKeys.includes(key)) {
        e.preventDefault();
        $('#errorNombreCrear').show();
      } else {
        $('#errorNombreCrear').hide();
      }
    });

    // Validación tiempo real crear nombre (solo letras y espacios)
    $('#nombre').on('input', function () {
      const val = $(this).val();
      const regex = /^[A-Za-z\s]+$/;
      if (!regex.test(val)) {
        $('#errorNombreCrear').show();
      } else {
        $('#errorNombreCrear').hide();
      }
    });

    // NO PERMITIR NUMEROS AL ESCRIBIR EN NOMBRE EDITAR
    $('#nombreU').on('keydown', function (e) {
      const key = e.key;
      const allowedKeys = ['Backspace', 'ArrowLeft', 'ArrowRight', 'Delete', 'Tab', ' '];
      if (!/^[a-zA-Z\s]$/.test(key) && !allowedKeys.includes(key)) {
        e.preventDefault();
        $('#errorNombreEditar').show();
      } else {
        $('#errorNombreEditar').hide();
      }
    });

    // Validación tiempo real editar nombre
    $('#nombreU').on('input', function () {
      const val = $(this).val();
      const regex = /^[A-Za-z\s]+$/;
      if (!regex.test(val)) {
        $('#errorNombreEditar').show();
      } else {
        $('#errorNombreEditar').hide();
      }
    });

    // Validación submit crear
    $('#miForm').on('submit', function (e) {
      let nombreOk = /^[A-Za-z\s]+$/.test($('#nombre').val());
      if (!nombreOk) {
        e.preventDefault();
        alert('Por favor ingresa solo letras y espacios en Nombre. Gracias bro :=)');
      }
    });

    // Validación submit editar
    $('#miFormU').on('submit', function (e) {
      let nombreOk = /^[A-Za-z\s]+$/.test($('#nombreU').val());
      if (!nombreOk) {
        e.preventDefault();
        alert('Por favor ingresa solo letras y espacios en Nombre. Gracias bro :=)');
      }
    });

    // Confirmación eliminar
    $('#miFormE').on('submit', function(e) {
      if (!confirm('¿Estás seguro de que deseas eliminar esta enfermedad, bro?')) {
        e.preventDefault();
      }
    });
  });
</script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
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
  </body>
</html>
