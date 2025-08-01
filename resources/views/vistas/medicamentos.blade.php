<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Medicamentos</title>
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
    <div class="container">
      <h1>Lista de Medicamentos</h1>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#mCrearMedicamento">Crear medicamento</button>
      <table class="table">
        <thead>
          <tr>
            <th>ID Medicamento</th>
            <th>Nombre</th>
            <th>Stock</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($listaMedicamentos as $medicamento)
          <tr>
            <td>{{ $medicamento->idMedicamento }}</td>
            <td>{{ $medicamento->nombre }}</td>
            <td>{{ $medicamento->stock }}</td>
            <td>
              <button class="btn btn-primary ejecutar" data-bs-toggle="modal" data-bs-target="#mEditarMedicamento" data-id="{{ $medicamento->idMedicamento }}" data-nombre="{{ $medicamento->nombre }}" data-stock="{{ $medicamento->stock }}">Editar</button>
            </td>
            <td>
              <button class="btn btn-danger eli" data-bs-toggle="modal" data-bs-target="#mEliminarMedicamento" data-ideli="{{ $medicamento->idMedicamento }}" data-nombreeli="{{ $medicamento->nombre }}">Eliminar</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Modal Crear -->
      <div class="modal" id="mCrearMedicamento">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Crear Medicamento</h2>
            </div>
            <div class="modal-body">
              <form action="/medicamentos" id="miForm" method="POST">
                @csrf
                <div class="form-floating mb-3">
                  <input type="text" id="nombre" name="nombre" class="form-control" required />
                  <label for="nombre">Nombre</label>
                  <div class="error-message" id="errorNombreCrear">Solo se permiten letras y espacios</div>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" id="stock" name="stock" class="form-control" required />
                  <label for="stock">Stock</label>
                  <div class="error-message" id="errorStockCrear">Solo se permiten números</div>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit">Guardar</button>
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" id="cancelarCrear">Cancelar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Editar -->
      <div class="modal" id="mEditarMedicamento">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Editar Medicamento</h2>
            </div>
            <div class="modal-body">
              <form action="" id="miFormU" method="POST">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                  <input type="text" id="idMedicamentoU" name="idMedicamentoU" class="form-control" readonly />
                  <label for="idMedicamentoU">ID Medicamento</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" id="nombreU" name="nombreU" class="form-control" required />
                  <label for="nombreU">Nombre</label>
                  <div class="error-message" id="errorNombreEditar">Solo se permiten letras y espacios</div>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" id="stockU" name="stockU" class="form-control" required />
                  <label for="stockU">Stock</label>
                  <div class="error-message" id="errorStockEditar">Solo se permiten números</div>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit">Editar</button>
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" id="cancelarEditar">Cancelar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Eliminar -->
      <div class="modal" id="mEliminarMedicamento">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Eliminar Medicamento</h2>
            </div>
            <div class="modal-body">
              <form action="" id="miFormE" method="POST">
                @csrf @method('DELETE')
                <div class="form-floating mb-3">
                  <input type="text" id="idMedicamentoE" name="idMedicamentoE" class="form-control" readonly />
                  <label for="idMedicamentoE">ID Medicamento</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" id="nombreE" name="nombreE" class="form-control" readonly />
                  <label for="nombreE">Nombre</label>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit">Eliminar</button>
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<script>
  function configurarValidacionTexto(selector, errorSelector) {
    $(selector).on('keypress', function(e) {
      var char = String.fromCharCode(e.which);
      if (e.which === 8 || e.which === 0 || e.which === 46) return true;
      if (!/[A-Za-zÁÉÍÓÚáéíóúÑñ\s]/.test(char)) {
        e.preventDefault();
        $(errorSelector).show();
        setTimeout(function() { $(errorSelector).hide(); }, 3000);
        return false;
      }
    });
    $(selector).on('input paste', function() {
      var val = $(this).val();
      var limpio = val.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
      if (val !== limpio) {
        $(this).val(limpio);
        $(errorSelector).show();
        setTimeout(function() { $(errorSelector).hide(); }, 3000);
      }
    });
  }

  function configurarValidacionNumerica(selector, errorSelector) {
    $(selector).on('keypress', function(e) {
      var char = String.fromCharCode(e.which);
      if (e.which === 8 || e.which === 0 || e.which === 46) return true;
      if (!/[0-9]/.test(char)) {
        e.preventDefault();
        $(errorSelector).show();
        setTimeout(function() { $(errorSelector).hide(); }, 3000);
        return false;
      }
    });
    $(selector).on('input paste', function() {
      var val = $(this).val();
      var limpio = val.replace(/[^0-9]/g, '');
      if (val !== limpio) {
        $(this).val(limpio);
        $(errorSelector).show();
        setTimeout(function() { $(errorSelector).hide(); }, 3000);
      }
    });
  }

  $(document).ready(function () {
    $('.ejecutar').on('click', function () {
      $('#miFormU')[0].reset();
      let id = $(this).data('id');
      let nombre = $(this).data('nombre');
      let stock = $(this).data('stock');
      $('#idMedicamentoU').val(id);
      $('#nombreU').val(nombre);
      $('#stockU').val(stock);
      $('#miFormU').attr('action', '/medicamentos/edit/' + id);
    });

    $('.eli').on('click', function () {
      let ideli = $(this).data('ideli');
      let nombreeli = $(this).data('nombreeli');
      $('#idMedicamentoE').val(ideli);
      $('#nombreE').val(nombreeli);
      $('#miFormE').attr('action', '/medicamentos/delete/' + ideli);
    });

    configurarValidacionTexto('#nombre', '#errorNombreCrear');
    configurarValidacionNumerica('#stock', '#errorStockCrear');
    configurarValidacionTexto('#nombreU', '#errorNombreEditar');
    configurarValidacionNumerica('#stockU', '#errorStockEditar');

    $('#cancelarCrear').on('click', function () {
      $('#miForm')[0].reset();
    });

    $('#cancelarEditar').on('click', function () {
      $('#miFormU')[0].reset();
    });

    $('#miFormE').on('submit', function(e) {
      if (!confirm('¿Estás seguro de que deseas eliminar este medicamento?')) {
        e.preventDefault();
      }
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Gestión de Datos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="dashboard">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="/roles">Roles</a></li>
        <li class="nav-item"><a class="nav-link" href="/pacientes">Pacientes</a></li>
        <li class="nav-item"><a class="nav-link" href="/doctores">Doctores</a></li>
        <li class="nav-item"><a class="nav-link active" href="/medicamentos">Medicamentos</a></li>
        <li class="nav-item"><a class="nav-link" href="/enfermedades">Enfermedades</a></li>
        <li class="nav-item"><a class="nav-link" href="/citas">Citas</a></li>
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
