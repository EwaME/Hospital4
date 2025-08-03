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
        body {
            background: linear-gradient(120deg, #e9f3ff 0%, #d5f3ea 100%);
            min-height: 100vh;
        }
        /* --------- SIDEBAR FIX --------- */
        .with-sidebar {
            padding-left: 220px; /* <-- ancho sidebar fijo, AJUSTA si tu sidebar es más ancho */
            transition: padding-left 0.25s;
        }
        @media (max-width: 991px) {
            .with-sidebar { padding-left: 0; }
        }

        /* El resto igual, pero... */
        .glass-bg {
            background: linear-gradient(135deg, rgba(248,252,255,0.97) 0%, rgba(48,107,165,0.09) 100%);
            border-radius: 1.7rem;
            border: 1.5px solid #b5d5fa;
            box-shadow: 0 10px 36px 0 rgba(0, 80, 158, 0.14), 0 2px 12px #00509e13;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 2.4rem 1.7rem 2rem 1.7rem;
            margin-top: 3.7rem;
            animation: fade-in-up 0.8s cubic-bezier(.4,2,.6,1) both;
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(60px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .title-meds {
            font-size: 2.2rem;
            font-weight: 900;
            color: #00509e;
            text-shadow: 0 2px 16px #00509e23;
            letter-spacing: 0.01em;
            margin-bottom: 2.1rem;
            text-align: center;
            display: flex;
            gap: .55em;
            justify-content: center;
            align-items: center;
        }
        .title-meds .fa-pills {
            color: #18B981;
            font-size: 1.25em;
            filter: drop-shadow(0 2px 9px #00509e21);
        }
        .table-glass {
            background: rgba(255,255,255,0.97);
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
            background: rgba(24,185,129,0.12) !important;
        }
        .fw-bold { font-weight: 700 !important; }
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
        .btn-ico.edit { color: #1976D2 !important; border-color: #bee1ff; background: #f6faff;}
        .btn-ico.edit:hover { background: #e2f3ff; color: #125fb7 !important;}
        .btn-ico.del { color: #e05c3c !important; border-color: #ffdad2; background: #fff7f6;}
        .btn-ico.del:hover { background: #ffebe6; color: #af2d08 !important;}
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
        label.form-label, .modal-title {
            font-weight: 700;
            color: #1976d2;
        }
        .modal-content.glass-bg {
            padding: 2rem 2.1rem 1.5rem 2.1rem !important;
            background: linear-gradient(135deg, rgba(248,252,255,0.97) 0%, rgba(48,107,165,0.12) 100%);
            border-radius: 1.3rem;
            border: 1.2px solid #b5d5fa;
        }
        .modal-header { border-bottom: none; background: transparent; padding-bottom: 0; }
        .modal-footer { border-top: none; background: transparent; padding-top: 0; }
        .error-message {
            color: #e05c3c;
            font-size: 0.97em;
            margin-top: 0.23em;
            display: none;
            font-weight: 500;
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
        @media (max-width: 575px) {
            .glass-bg { padding: 0.7rem 0.05rem; }
            .table-glass th, .table-glass td { font-size: .91rem;}
            .title-meds { font-size: 1.17rem;}
            .btn-glass, .btn-ico { font-size: 1em; padding: 0.37em 0.71em;}
            .modal-content.glass-bg { padding: 1.1rem 0.8rem 1.1rem 0.8rem !important;}
        }
    </style>
</head>
<body>
    @include('components.layouts.sidebar')
    <main class="with-sidebar py-3">
        <div class="glass-bg mx-auto" style="max-width: 1050px;">
            <h1 class="title-meds"><i class="fas fa-pills"></i> Consulta de Medicamentos</h1>
            <div class="d-flex justify-content-end">
                <button class="btn btn-glass mb-3" data-bs-toggle="modal" data-bs-target="#mCrearConsultaMedicamento">
                    <i class="fas fa-plus-circle"></i> Agregar Registro
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-glass align-middle w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Consulta</th>
                            <th>ID Medicamento</th>
                            <th>Cantidad</th>
                            <th class="text-center">Editar</th>
                            <th class="text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listaConsultaMedicamentos as $registro)
                        <tr>
                            <td class="fw-bold">{{ $registro->idCMedicamento }}</td>
                            <td>{{ $registro->idConsulta }}</td>
                            <td>{{ $registro->idMedicamento }}</td>
                            <td>{{ $registro->cantidad }}</td>
                            <td class="text-center">
                                <button class="btn btn-ico edit ejecutar" data-bs-toggle="modal" data-bs-target="#mEditarConsultaMedicamento"
                                    data-id="{{ $registro->idCMedicamento }}"
                                    data-consulta="{{ $registro->idConsulta }}"
                                    data-medicamento="{{ $registro->idMedicamento }}"
                                    data-cantidad="{{ $registro->cantidad }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-ico del eli" data-bs-toggle="modal" data-bs-target="#mEliminarConsultaMedicamento"
                                    data-ideli="{{ $registro->idCMedicamento }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Crear -->
        <div class="modal fade" id="mCrearConsultaMedicamento" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content glass-bg">
                    <div class="modal-header">
                        <h2 class="modal-title">Agregar Consulta Medicamento</h2>
                    </div>
                    <div class="modal-body">
                        <form action="/consultaMedicamentos" id="miForm" method="POST" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">ID Consulta</label>
                                <input type="number" id="idConsulta" name="idConsulta" class="form-control" required min="1" />
                                <div class="error-message" id="errorConsultaCrear">Debe ser un número válido</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ID Medicamento</label>
                                <input type="number" id="idMedicamento" name="idMedicamento" class="form-control" required min="1" />
                                <div class="error-message" id="errorMedicamentoCrear">Debe ser un número válido</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Cantidad</label>
                                <input type="number" id="cantidad" name="cantidad" class="form-control" required min="1" />
                                <div class="error-message" id="errorCantidadCrear">Debe ser un número válido</div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit" form="miForm">Guardar</button>
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Editar -->
        <div class="modal fade" id="mEditarConsultaMedicamento" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content glass-bg">
                    <div class="modal-header">
                        <h2 class="modal-title">Editar Consulta Medicamento</h2>
                    </div>
                    <div class="modal-body">
                        <form action="" id="miFormU" method="POST" novalidate>
                            @csrf @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">ID Registro</label>
                                <input type="text" id="idCMedicamentoU" name="idCMedicamentoU" class="form-control" readonly />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ID Consulta</label>
                                <input type="number" id="idConsultaU" name="idConsultaU" class="form-control" required min="1" />
                                <div class="error-message" id="errorConsultaEditar">Debe ser un número válido</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ID Medicamento</label>
                                <input type="number" id="idMedicamentoU" name="idMedicamentoU" class="form-control" required min="1" />
                                <div class="error-message" id="errorMedicamentoEditar">Debe ser un número válido</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Cantidad</label>
                                <input type="number" id="cantidadU" name="cantidadU" class="form-control" required min="1" />
                                <div class="error-message" id="errorCantidadEditar">Debe ser un número válido</div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit" form="miFormU">Editar</button>
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Eliminar -->
        <div class="modal fade" id="mEliminarConsultaMedicamento" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content glass-bg">
                    <div class="modal-header">
                        <h2 class="modal-title">Eliminar Consulta Medicamento</h2>
                    </div>
                    <div class="modal-body">
                        <form action="" id="miFormE" method="POST">
                            @csrf @method('DELETE')
                            <input type="hidden" id="idCMedicamentoE" name="idCMedicamentoE" />
                            <p>¿Seguro que deseas eliminar este registro?</p>
                            <div class="modal-footer">
                                <button class="btn btn-danger" type="submit" form="miFormE">Eliminar</button>
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
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
    // Llenar editar
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
      $('#errorConsultaEditar').hide();
      $('#errorMedicamentoEditar').hide();
      $('#errorCantidadEditar').hide();
    });
    // Llenar eliminar
    $('.eli').on('click', function () {
      let ideli = $(this).data('ideli');
      $('#idCMedicamentoE').val(ideli);
      $('#miFormE').attr('action', '/consultaMedicamentos/delete/' + ideli);
    });
    // Validaciones en tiempo real para Crear
    $('#idConsulta, #idMedicamento, #cantidad').on('input', function () {
      let val = $(this).val();
      let id = $(this).attr('id');
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
</body>
</html>
