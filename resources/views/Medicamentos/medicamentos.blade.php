<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Medicamentos</title>
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
      <h1>Lista de Medicamentos</h1>

      <button
        class="btn btn-success"
        data-bs-toggle="modal"
        data-bs-target="#mCrearMedicamento"
      >
        Crear medicamento
      </button>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID Medicamento</th>
            <th scope="col">Nombre</th>
            <th scope="col">Stock</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($listaMedicamentos as $medicamento)
          <tr>
            <th scope="row">{{ $medicamento->idMedicamento }}</th>
            <td>{{ $medicamento->nombre }}</td>
            <td>{{ $medicamento->stock }}</td>

            <td>
              <button
                class="btn btn-primary ejecutar"
                data-bs-toggle="modal"
                data-bs-target="#mEditarMedicamento"
                data-id="{{ $medicamento->idMedicamento }}"
                data-nombre="{{ $medicamento->nombre }}"
                data-stock="{{ $medicamento->stock }}"
              >
                Editar
              </button>
            </td>

            <td>
              <button
                class="btn btn-danger eli"
                data-bs-toggle="modal"
                data-bs-target="#mEliminarMedicamento"
                data-ideli="{{ $medicamento->idMedicamento }}"
                data-nombreeli="{{ $medicamento->nombre }}"
              >
                Eliminar
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

     
      <div class="modal" id="mCrearMedicamento">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Crear Medicamento</h2>
            </div>
            <div class="modal-body">
              <form action="/medicamentos" id="miForm" method="POST" novalidate>
                @csrf
                <div class="form-floating mb-3">
                  <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    class="form-control"
                    required
                    pattern="[A-Za-z\s]+"
                    title="Solo letras, Gracias mi bro :=)"
                  />
                  <label for="nombre">Nombre</label>
                  <div class="error-message" id="errorNombreCrear">
                    Solo se permiten letras y espacios Gracias mi bro :=)
                  </div>
                  <div class="error-message" id="warnNombreCrear">
                    No se permiten números en el nombre.
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <input
                    type="number"
                    id="stock"
                    name="stock"
                    class="form-control"
                    required
                    min="0"
                  />
                  <label for="stock">Stock</label>
                  <div class="error-message" id="errorStockCrear">
                    Solo se permiten números
                  </div>
                  <div class="error-message" id="warnStockCrear">
                    No se permiten letras en el stock.
                  </div>
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

    
      <div class="modal" id="mEditarMedicamento">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Editar Medicamento</h2>
            </div>
            <div class="modal-body">
              <form action="" id="miFormU" method="POST" novalidate>
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                  <input
                    type="text"
                    id="idMedicamentoU"
                    name="idMedicamentoU"
                    class="form-control"
                    readonly
                  />
                  <label for="idMedicamentoU">ID Medicamento</label>
                </div>
                <div class="form-floating mb-3">
                  <input
                    type="text"
                    id="nombreU"
                    name="nombreU"
                    class="form-control"
                    required
                    pattern="[A-Za-z\s]+"
                    title="Solo letras, Gracias mi bro :=)"
                  />
                  <label for="nombreU">Nombre</label>
                  <div class="error-message" id="errorNombreEditar">
                    Solo se permiten letras y espacios Gracias mi bro :=)
                  </div>
                  <div class="error-message" id="warnNombreEditar">
                    No se permiten números en el nombre.
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <input
                    type="number"
                    id="stockU"
                    name="stockU"
                    class="form-control"
                    required
                    min="0"
                  />
                  <label for="stockU">Stock</label>
                  <div class="error-message" id="errorStockEditar">
                    Solo se permiten números Gracias mi bro :=)
                  </div>
                  <div class="error-message" id="warnStockEditar">
                    No se permiten letras en el stock.
                  </div>
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
                  <input
                    type="text"
                    id="idMedicamentoE"
                    name="idMedicamentoE"
                    class="form-control"
                    readonly
                  />
                  <label for="idMedicamentoE">ID Medicamento</label>
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
      let stock = $(this).data('stock');
      $('#idMedicamentoU').val(id);
      $('#nombreU').val(nombre);
      $('#stockU').val(stock);
      $('#miFormU').attr('action', '/medicamentos/edit/' + id);
      $('#errorNombreEditar').hide();
      $('#errorStockEditar').hide();
      $('#warnNombreEditar').hide();
      $('#warnStockEditar').hide();
    });

    $('.eli').on('click', function () {
      let ideli = $(this).data('ideli');
      let nombreeli = $(this).data('nombreeli');
      $('#idMedicamentoE').val(ideli);
      $('#nombreE').val(nombreeli);
      $('#miFormE').attr('action', '/medicamentos/delete/' + ideli);
    });

    // Bloquear números en nombre (crear)
    $('#nombre').on('keydown', function (e) {
      const tecla = e.key;
      if (
        tecla === "Backspace" ||
        tecla === "Delete" ||
        tecla === "ArrowLeft" ||
        tecla === "ArrowRight" ||
        tecla === "Tab"
      ) {
        $('#warnNombreCrear').fadeOut(200);
        return;
      }
      if (/\d/.test(tecla)) {
        e.preventDefault();
        $('#warnNombreCrear').fadeIn(200);
      } else {
        $('#warnNombreCrear').fadeOut(200);
      }
    });

    // Bloquear letras en stock (crear)
    $('#stock').on('keydown', function (e) {
      const tecla = e.key;
      if (
        tecla === "Backspace" ||
        tecla === "Delete" ||
        tecla === "ArrowLeft" ||
        tecla === "ArrowRight" ||
        tecla === "Tab"
      ) {
        $('#warnStockCrear').fadeOut(200);
        return;
      }
      if (/[a-zA-Z]/.test(tecla)) {
        e.preventDefault();
        $('#warnStockCrear').fadeIn(200);
      } else {
        $('#warnStockCrear').fadeOut(200);
      }
    });

    // Bloquear números en nombre (editar)
    $('#nombreU').on('keydown', function (e) {
      const tecla = e.key;
      if (
        tecla === "Backspace" ||
        tecla === "Delete" ||
        tecla === "ArrowLeft" ||
        tecla === "ArrowRight" ||
        tecla === "Tab"
      ) {
        $('#warnNombreEditar').fadeOut(200);
        return;
      }
      if (/\d/.test(tecla)) {
        e.preventDefault();
        $('#warnNombreEditar').fadeIn(200);
      } else {
        $('#warnNombreEditar').fadeOut(200);
      }
    });

    // Bloquear letras en stock (editar)
    $('#stockU').on('keydown', function (e) {
      const tecla = e.key;
      if (
        tecla === "Backspace" ||
        tecla === "Delete" ||
        tecla === "ArrowLeft" ||
        tecla === "ArrowRight" ||
        tecla === "Tab"
      ) {
        $('#warnStockEditar').fadeOut(200);
        return;
      }
      if (/[a-zA-Z]/.test(tecla)) {
        e.preventDefault();
        $('#warnStockEditar').fadeIn(200);
      } else {
        $('#warnStockEditar').fadeOut(200);
      }
    });

    // Validación tiempo real crear
    $('#nombre').on('input', function () {
      const val = $(this).val();
      const regex = /^[A-Za-z\s]+$/;
      $('#errorNombreCrear').toggle(!regex.test(val));
    });
    $('#stock').on('input', function () {
      const val = $(this).val();
      const regex = /^[0-9]+$/;
      $('#errorStockCrear').toggle(!regex.test(val));
    });

    // Validación tiempo real editar
    $('#nombreU').on('input', function () {
      const val = $(this).val();
      const regex = /^[A-Za-z\s]+$/;
      $('#errorNombreEditar').toggle(!regex.test(val));
    });
    $('#stockU').on('input', function () {
      const val = $(this).val();
      const regex = /^[0-9]+$/;
      $('#errorStockEditar').toggle(!regex.test(val));
    });

    // Validación submit crear
    $('#miForm').on('submit', function (e) {
      let nombreOk = /^[A-Za-z\s]+$/.test($('#nombre').val());
      let stockOk = /^[0-9]+$/.test($('#stock').val());
      if (!nombreOk || !stockOk) {
        e.preventDefault();
        alert('Por favor ingresa solo letras en Nombre y solo números en Stock. Gracias mi bro :=)');
      }
    });

    // Validación submit editar
    $('#miFormU').on('submit', function (e) {
      let nombreOk = /^[A-Za-z\s]+$/.test($('#nombreU').val());
      let stockOk = /^[0-9]+$/.test($('#stockU').val());
      if (!nombreOk || !stockOk) {
        e.preventDefault();
        alert('Por favor ingresa solo letras en Nombre y solo números en Stock. Gracias mi bro :=)');
      }
    });

    // Confirmación eliminar
    $('#miFormE').on('submit', function(e) {
      if (!confirm('¿Estás seguro de que deseas eliminar este medicamento, bro?')) {
        e.preventDefault();
      }
    });
  });
</script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
