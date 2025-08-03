<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lista de Enfermedades</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(120deg, #e9f3ff 0%, #d5f3ea 100%);
      min-height: 100vh;
      overflow-x: hidden;
    }
    .sidebar-custom {
      min-width: 220px;
      max-width: 230px;
      height: 100vh;
      position: fixed;
      top: 0; left: 0;
      z-index: 1040;
      background: linear-gradient(125deg,#00509e 85%,#18B981 100%);
      color: #fff;
      box-shadow: 2px 0 28px #00509e13;
      padding-top: 68px;
      font-weight: 500;
    }
    @media (max-width: 991px) {
      .sidebar-custom { position: static; width: 100vw; max-width: 100vw; min-width: 0; height: auto; padding-top: 0;}
    }
    .main-content {
      margin-left: 230px;
      margin-top: 0px;
      transition: margin 0.24s;
    }
    @media (max-width: 991px) {
      .main-content { margin-left: 0; }
    }
    .glass-bg {
      background: linear-gradient(135deg, rgba(248,252,255,0.97) 0%, rgba(48,107,165,0.09) 100%);
      border-radius: 1.7rem;
      border: 1.5px solid #b5d5fa;
      box-shadow: 0 10px 36px 0 rgba(0, 80, 158, 0.14), 0 2px 12px #00509e13;
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      padding: 2.5rem 2rem 2rem 2rem;
      margin-top: 2.7rem;
      animation: fade-in-up 0.8s cubic-bezier(.4,2,.6,1) both;
    }
    @keyframes fade-in-up {
      from { opacity: 0; transform: translateY(60px);}
      to { opacity: 1; transform: translateY(0);}
    }
    .enfermedades-header {
      font-size: 2.3rem;
      font-weight: 900;
      color: #00509e;
      letter-spacing: 0.01em;
      margin-bottom: 2.1rem;
      text-align: center;
      display: flex;
      gap: .5em;
      justify-content: center;
      align-items: center;
      text-shadow: 0 2px 16px #00509e19;
    }
    .enfermedades-header .fa-virus {
      color: #18B981;
      font-size: 1.25em;
      filter: drop-shadow(0 2px 9px #00509e13);
    }
    .table-glass {
      background: rgba(255,255,255,0.96);
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 2px 16px #00509e10;
      border: 1.3px solid #e3f1ff;
      transition: box-shadow 0.2s;
    }
    .table-glass th, .table-glass td {
      vertical-align: middle !important;
      padding: 0.9em 1em;
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
    .table-glass tr {
      transition: background 0.14s;
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
    .btn-glass {
      background: linear-gradient(92deg, #14996b 40%, #18B981 100%);
      color: #fff !important;
      font-weight: 500;
      border: none;
      border-radius: 0.9em;
      box-shadow: 0 2px 12px #00509e18;
      transition: background 0.2s, transform 0.17s, box-shadow 0.2s;
    }
    .btn-glass:hover, .btn-glass:focus {
      background: linear-gradient(92deg, #0eab78 30%, #16e59d 100%);
      box-shadow: 0 8px 18px #00509e2c;
      transform: scale(1.04);
      color: #fff;
    }
    .btn-ico {
      padding: 0.53em 0.68em;
      border-radius: 50%;
      font-size: 1.09em;
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
    }
    .error-message {
      color: #e05c3c;
      font-size: 0.98em;
      margin-top: 0.23em;
      display: none;
      font-weight: 500;
    }
    @media (max-width: 575px) {
      .glass-bg { padding: 0.7rem 0.05rem; }
      .table-glass th, .table-glass td { font-size: .91rem;}
      .enfermedades-header { font-size: 1.17rem;}
      .btn-glass, .btn-ico { font-size: 1em; padding: 0.37em 0.71em;}
      .modal-content.glass-bg { padding: 1.1rem 0.8rem 1.1rem 0.8rem !important;}
      .main-content { margin-left: 0; }
    }
  </style>
</head>
<body>
<div class="d-flex">
  {{-- SIDEBAR IMPORTADO --}}
  @include('components.layouts.sidebar')

  <main class="main-content flex-grow-1 p-3">
    <div class="glass-bg mx-auto" style="max-width: 1050px;">
      <h1 class="enfermedades-header">
        <i class="fa-solid fa-virus"></i> Lista de Enfermedades
      </h1>
      <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-glass" data-bs-toggle="modal" data-bs-target="#mCrearEnfermedad">
          <i class="fas fa-plus-circle"></i> Crear enfermedad
        </button>
      </div>
      <div class="table-responsive">
        <table class="table table-glass align-middle w-100 mt-2">
          <thead>
            <tr>
              <th>ID Enfermedad</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th class="text-center">Editar</th>
              <th class="text-center">Eliminar</th>
            </tr>
          </thead>
          <tbody>
            @foreach($enfermedades as $enfermedad)
            <tr>
              <td class="fw-bold">{{ $enfermedad->idEnfermedad }}</td>
             <td>
  
    <p><strong></strong> {{ ucwords(strtolower($enfermedad->nombre)) }}</p>

</td>

<td>
   
    <p><strong></strong> {{ ucfirst(strtolower($enfermedad->descripcion)) }}</p>

</td>

              <td class="text-center">
                <button class="btn btn-ico edit ejecutar" data-bs-toggle="modal" data-bs-target="#mEditarEnfermedad"
                  data-id="{{ $enfermedad->idEnfermedad }}" data-nombre="{{ $enfermedad->nombre }}"
                  data-descripcion="{{ $enfermedad->descripcion }}" title="Editar">
                  <i class="fas fa-edit"></i>
                </button>
              </td>
              <td class="text-center">
                <form action="/enfermedades/delete/{{ $enfermedad->idEnfermedad }}" method="POST" style="display:inline;">
                  @csrf @method('DELETE')
                  <button class="btn btn-ico del" title="Eliminar">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- MODAL CREAR -->
    <div class="modal fade" id="mCrearEnfermedad" tabindex="-1">
      <div class="modal-dialog">
        <form id="formCrear" action="/enfermedades" method="POST">
          @csrf
          <div class="modal-content glass-bg">
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

    <!-- MODAL EDITAR -->
    <div class="modal fade" id="mEditarEnfermedad" tabindex="-1">
      <div class="modal-dialog">
        <form id="formEditar" method="POST">
          @csrf @method('PUT')
          <div class="modal-content glass-bg">
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
  </main>
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
    soloLetras('#nombre', '#errorNombreCrear');
    soloLetras('#descripcion', '#errorDescripcionCrear');
    soloLetras('#nombreEditar', '#errorNombreEditar');
    soloLetras('#descripcionEditar', '#errorDescripcionEditar');
    $('.ejecutar').on('click', function () {
      let id = $(this).data('id');
      let nombre = $(this).data('nombre');
      let descripcion = $(this).data('descripcion');
      $('#idEnfermedadEditar').val(id);
      $('#nombreEditar').val(nombre);
      $('#descripcionEditar').val(descripcion);
      $('#formEditar').attr('action', '/enfermedades/edit/' + id);
    });
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
    $('#mCrearEnfermedad, #mEditarEnfermedad').on('hidden.bs.modal', function () {
      $(this).find('form')[0].reset();
      $(this).find('.error-message').hide();
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>