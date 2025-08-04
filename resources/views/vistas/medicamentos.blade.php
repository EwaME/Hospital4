<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Medicamentos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
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
            .main-content { margin-left: 0; }
        }
        .glass-bg {
            background: linear-gradient(135deg, rgba(248,252,255,0.97) 0%, rgba(48,107,165,0.09) 100%);
            border-radius: 1.7rem;
            border: 1.5px solid #b5d5fa;
            box-shadow: 0 10px 36px 0 rgba(0, 80, 158, 0.14), 0 2px 12px #00509e13;
            backdrop-filter: blur(20px);
            padding: 2.7rem 2.1rem 2rem 2.1rem;
            margin-top: 3.7rem;
            animation: fade-in-up 0.8s cubic-bezier(.4,2,.6,1) both;
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(60px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .medicamentos-header {
            font-size: 2.2rem;
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
        .medicamentos-header .fa-capsules {
            color: #18B981;
            font-size: 1.2em;
            filter: drop-shadow(0 2px 9px #00509e21);
        }
        .table-glass {
            background: rgba(255,255,255,0.96);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 2px 16px #00509e10;
            border: 1.3px solid #e3f1ff;
            transition: box-shadow 0.2s;
        }
        .table-glass th, .table-glass td {
            vertical-align: middle !important;
            padding: 0.78em 1em;
        }
        .table-glass th {
            background: rgba(11, 112, 187, 0.13);
            color: #00509e;
            font-size: 1.08rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            position: sticky;
            top: 0;
            z-index: 3;
            box-shadow: 0 2px 7px #00509e11;
        }
        .table-glass tbody tr:hover {
            background: rgba(24,185,129,0.12) !important;
        }
        .table-glass td {
            font-size: 1.01rem;
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
            font-size: 1.07em;
            margin: 0 .13em;
            background: linear-gradient(88deg, #e1f6f0 40%, #d1f6ff 100%);
            color: #14996b !important;
            border: 1.4px solid #e0ebf5;
            box-shadow: 0 1px 8px #14996b17;
        }
        .btn-ico.edit { color: #1976D2 !important; border-color: #bee1ff; background: #f6faff;}
        .btn-ico.edit:hover { background: #e2f3ff; color: #125fb7 !important;}
        .btn-ico.del { color: #e05c3c !important; border-color: #ffdad2; background: #fff7f6;}
        .btn-ico.del:hover { background: #ffebe6; color: #af2d08 !important;}
        .btn-glass i, .btn-ico i { margin-right: 0; }
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
        label.form-label, label {
            font-weight: 600;
            color: #1976d2;
            margin-bottom: .5em;
        }
        .modal-content.glass-bg {
            padding: 2rem 2.1rem 1.5rem 2.1rem !important;
            border-radius: 1.3rem;
        }
        .modal-header {
            border-bottom: none;
            background: transparent;
            padding-bottom: 0;
        }
        .modal-title {
            color: #00509e;
            font-weight: bold;
            font-size: 1.22rem;
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
        .error-message {
            color: #e05c3c;
            font-size: 0.97em;
            margin-top: 0.25rem;
            display: none;
            font-weight: 500;
        }
        @media (max-width: 575px) {
            .glass-bg { padding: 0.7rem 0.05rem; }
            .table-glass th, .table-glass td { font-size: .91rem;}
            .medicamentos-header { font-size: 1.12rem;}
            .btn-glass, .btn-ico { font-size: 1em; padding: 0.37em 0.71em;}
            .modal-content.glass-bg { padding: 1.1rem 0.8rem 1.1rem 0.8rem !important;}
        }
    </style>
</head>
<body>
<div class="d-flex">
    @include('components.layouts.sidebar')

    <main id="main-content" class="main-content flex-fill p-4">
        <div class="glass-bg mx-auto" style="max-width: 800px;">
            <h1 class="medicamentos-header">
                <i class="fas fa-capsules"></i>
                Lista de Medicamentos
            </h1>
            
            <!-- SOLO ADMIN: Botón Agregar medicamento -->
            @if(auth()->user()->hasRole('Admin'))
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-glass" data-bs-toggle="modal" data-bs-target="#mCrearMedicamento">
                    <i class="fa fa-plus"></i> Agregar medicamento
                </button>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-glass align-middle w-100">
                    <thead>
                        <tr>
                            <th>ID Medicamento</th>
                            <th>Nombre</th>
                            <th>Stock</th>
                            @if(auth()->user()->hasRole('Admin'))
                                <th>Editar</th>
                                <th>Eliminar</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listaMedicamentos as $medicamento)
                        <tr>
                            <td class="fw-bold">{{ $medicamento->idMedicamento }}</td>
                            <td>{{ ucwords(strtolower($medicamento->nombre)) }}</td>
                            <td>{{ $medicamento->stock }}</td>
                            @if(auth()->user()->hasRole('Admin'))
                            <td>
                                <button class="btn btn-ico edit ejecutar"
                                    data-bs-toggle="modal" data-bs-target="#mEditarMedicamento"
                                    data-id="{{ $medicamento->idMedicamento }}"
                                    data-nombre="{{ $medicamento->nombre }}"
                                    data-stock="{{ $medicamento->stock }}"
                                    title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-ico del eli"
                                    data-bs-toggle="modal" data-bs-target="#mEliminarMedicamento"
                                    data-ideli="{{ $medicamento->idMedicamento }}"
                                    data-nombreeli="{{ $medicamento->nombre }}"
                                    title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- SOLO ADMIN: Modales Crear/Editar/Eliminar -->
@if(auth()->user()->hasRole('Admin'))
<!-- Modal Crear -->
<div class="modal" id="mCrearMedicamento" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content glass-bg">
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
<div class="modal" id="mEditarMedicamento" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content glass-bg">
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
<div class="modal" id="mEliminarMedicamento" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content glass-bg">
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
@endif

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
</body>
</html>