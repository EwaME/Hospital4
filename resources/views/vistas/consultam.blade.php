<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Consulta Medicamentos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
      .error-message {
        color: red;
        font-size: 0.875em;
        margin-top: 0.25rem;
        display: none;
      }
      .alert-custom {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideIn 0.3s ease-out;
      }
      @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>Lista de Consulta Medicamentos</h1>

      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#mCrearConsultaMedicamento">
        Agregar Registro
      </button>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">ID Consulta</th>
            <th scope="col">ID Medicamento</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($listaConsultaMedicamentos as $registro)
          <tr>
            <th scope="row">{{ $registro->idCMedicamento }}</th>
            <td>{{ $registro->idConsulta }}</td>
            <td>{{ $registro->idMedicamento }}</td>
            <td>{{ $registro->cantidad }}</td>
            <td>
              <button class="btn btn-primary ejecutar" data-bs-toggle="modal" data-bs-target="#mEditarConsultaMedicamento"
                data-id="{{ $registro->idCMedicamento }}"
                data-consulta="{{ $registro->idConsulta }}"
                data-medicamento="{{ $registro->idMedicamento }}"
                data-cantidad="{{ $registro->cantidad }}">
                Editar
              </button>
            </td>
            <td>
              <button class="btn btn-danger eli" data-bs-toggle="modal" data-bs-target="#mEliminarConsultaMedicamento"
                data-ideli="{{ $registro->idCMedicamento }}">
                Eliminar
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Modal Crear -->
      <div class="modal" id="mCrearConsultaMedicamento">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Agregar Consulta Medicamento</h2>
            </div>
            <div class="modal-body">
              <form action="/consultaMedicamentos" id="miForm" method="POST" novalidate>
                @csrf
                <div class="form-floating mb-3">
                  <input type="number" id="idConsulta" name="idConsulta" class="form-control" required min="1" />
                  <label for="idConsulta">ID Consulta</label>
                  <div class="error-message" id="errorConsultaCrear">Debe ser un número válido</div>
                </div>
                <div class="form-floating mb-3">
                  <input type="number" id="idMedicamento" name="idMedicamento" class="form-control" required min="1" />
                  <label for="idMedicamento">ID Medicamento</label>
                  <div class="error-message" id="errorMedicamentoCrear">Debe ser un número válido</div>
                </div>
                <div class="form-floating mb-3">
                  <input type="number" id="cantidad" name="cantidad" class="form-control" required min="1" />
                  <label for="cantidad">Cantidad</label>
                  <div class="error-message" id="errorCantidadCrear">Debe ser un número válido</div>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit" form="miForm">Guardar</button>
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
              </form>
          </div>
        </div>
      </div>

      <!-- Modal Editar -->
      <div class="modal" id="mEditarConsultaMedicamento">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Editar Consulta Medicamento</h2>
            </div>
            <div class="modal-body">
              <form action="" id="miFormU" method="POST" novalidate>
                @csrf @method('PUT')
                <div class="form-floating mb-3">
                  <input type="text" id="idCMedicamentoU" name="idCMedicamentoU" class="form-control" readonly />
                  <label for="idCMedicamentoU">ID Registro</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="number" id="idConsultaU" name="idConsultaU" class="form-control" required min="1" />
                  <label for="idConsultaU">ID Consulta</label>
                  <div class="error-message" id="errorConsultaEditar">Debe ser un número válido</div>
                </div>
                <div class="form-floating mb-3">
                  <input type="number" id="idMedicamentoU" name="idMedicamentoU" class="form-control" required min="1" />
                  <label for="idMedicamentoU">ID Medicamento</label>
                  <div class="error-message" id="errorMedicamentoEditar">Debe ser un número válido</div>
                </div>
                <div class="form-floating mb-3">
                  <input type="number" id="cantidadU" name="cantidadU" class="form-control" required min="1" />
                  <label for="cantidadU">Cantidad</label>
                  <div class="error-message" id="errorCantidadEditar">Debe ser un número válido</div>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit" form="miFormU">Editar</button>
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
              </form>
          </div>
        </div>
      </div>

      <!-- Modal Eliminar -->
      <div class="modal" id="mEliminarConsultaMedicamento">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Eliminar Consulta Medicamento</h2>
            </div>
            <div class="modal-body">
              <form action="" id="miFormE" method="POST">
                @csrf @method('DELETE')
                <input type="hidden" id="idCMedicamentoE" name="idCMedicamentoE" />
                <p>¿Seguro que deseas eliminar este registro?</p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" type="submit" form="miFormE">Eliminar</button>
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            </div>
              </form>
          </div>
        </div>
      </div>
    </div>

<script>
  $(document).ready(function () {
    // Función para mostrar alertas bonitas
    function showAlert(message, type = 'warning') {
      const alertTypes = {
        'warning': 'alert-warning',
        'success': 'alert-success',
        'danger': 'alert-danger',
        'info': 'alert-info'
      };
      
      const icons = {
        'warning': 'fa-exclamation-triangle',
        'success': 'fa-check-circle',
        'danger': 'fa-times-circle',
        'info': 'fa-info-circle'
      };
      
      const alert = $(`
        <div class="alert ${alertTypes[type]} alert-dismissible fade show alert-custom" role="alert">
          <i class="fas ${icons[type]} me-2"></i>
          ${message}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      `);
      
      $('body').append(alert);
      
      setTimeout(() => {
        alert.alert('close');
      }, 4000);
    }

    // Cuando presionas "Editar", llena el modal con los datos de la fila
    $('.ejecutar').on('click', function () {
      let id = $(this).data('id');
      let consulta = $(this).data('consulta');
      let medicamento = $(this).data('medicamento');
      let cantidad = $(this).data('cantidad');
      $('#idCMedicamentoU').val(id);
      $('#idConsultaU').val(consulta);
      $('#idMedicamentoU').val(medicamento);
      $('#cantidadU').val(cantidad);
      $('#miFormU').attr('action', '/consultaMedicamentos/edit/' + id);

      // Ocultar errores
      $('#errorConsultaEditar').hide();
      $('#errorMedicamentoEditar').hide();
      $('#errorCantidadEditar').hide();
    });

    // Cuando presionas "Eliminar", llena el campo oculto con el id para eliminar
    $('.eli').on('click', function () {
      let ideli = $(this).data('ideli');
      $('#idCMedicamentoE').val(ideli);
      $('#miFormE').attr('action', '/consultaMedicamentos/delete/' + ideli);
    });

    // Validaciones en tiempo real para Crear
    $('#idConsulta, #idMedicamento, #cantidad').on('input', function () {
      let val = $(this).val();
      let id = $(this).attr('id');
      // Validar que sea número positivo
      let valid = /^[0-9]+$/.test(val) && parseInt(val) > 0;
      $('#error' + id.charAt(0).toUpperCase() + id.slice(1) + 'Crear').toggle(!valid);
    });

    // Validaciones en tiempo real para Editar
    $('#idConsultaU, #idMedicamentoU, #cantidadU').on('input', function () {
      let val = $(this).val();
      let id = $(this).attr('id');
      let base = id.replace('U', '');
      let valid = /^[0-9]+$/.test(val) && parseInt(val) > 0;
      $('#error' + base.charAt(0).toUpperCase() + base.slice(1) + 'Editar').toggle(!valid);
    });

    // Validación al enviar - Crear
    $('#miForm').on('submit', function (e) {
      let valid = /^[0-9]+$/.test($('#idConsulta').val()) && $('#idConsulta').val() > 0 &&
                  /^[0-9]+$/.test($('#idMedicamento').val()) && $('#idMedicamento').val() > 0 &&
                  /^[0-9]+$/.test($('#cantidad').val()) && $('#cantidad').val() > 0;
      if (!valid) {
        e.preventDefault();
        showAlert('⚠️ Por favor completa todos los campos con valores válidos antes de continuar.', 'warning');
      }
    });

    // Validación al enviar - Editar
    $('#miFormU').on('submit', function (e) {
      let valid = /^[0-9]+$/.test($('#idConsultaU').val()) && $('#idConsultaU').val() > 0 &&
                  /^[0-9]+$/.test($('#idMedicamentoU').val()) && $('#idMedicamentoU').val() > 0 &&
                  /^[0-9]+$/.test($('#cantidadU').val()) && $('#cantidadU').val() > 0;
      if (!valid) {
        e.preventDefault();
        showAlert('⚠️ Por favor completa todos los campos con valores válidos antes de continuar.', 'warning');
      }
    });

    // Confirmación al eliminar
    $('#miFormE').on('submit', function (e) {
      if (!confirm('¿Estás seguro de que deseas eliminar este registro?')) {
        e.preventDefault();
      }
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

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
            <li class="nav-item"><a class="nav-link" href="/consultas">Consultas</a></li>
            <li class="nav-item"><a class="nav-link active" href="/consultaMedicamentos">Consulta Medicamentos</a></li>
            <li class="nav-item"><a class="nav-link" href="/historialClinico">Historial Clínico</a></li>
            <li class="nav-item"><a class="nav-link" href="/bitacoras">Bitácoras</a></li>
        </ul>
        </div>
    </div>
</nav>

</body>
</html>