<!-- SIDEBAR NAV - Hospital EKO -->
<style>
    body {
        background: linear-gradient(120deg, #e9f3ff 0%, #d5f3ea 100%);
        min-height: 100vh;
    }
    .sidebar-fixed {
        width: 260px;
        min-width: 260px;
        max-width: 100vw;
        height: 100vh;
        border-right: 2px solid #e3f1ff;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 10;
        background: linear-gradient(120deg, rgba(248,252,255,0.97) 0%, rgba(48,107,165,0.09) 100%);
        box-shadow: 0 10px 36px 0 rgba(0, 80, 158, 0.14), 0 2px 12px #00509e13;
        transition: width 0.25s;
        backdrop-filter: blur(18px);
        display: flex;
        flex-direction: column;
        padding: 0 !important;
        overflow: hidden;
    }
    .sidebar-scrollable {
        flex: 1 1 auto;
        overflow-y: auto;
        overflow-x: hidden;
        padding: 1.6rem 1.5rem 1.2rem 1.5rem;
        display: flex;
        flex-direction: column;
        height: 100%;
        scrollbar-width: thin;
        scrollbar-color: #b3c8ef #f6faff;
    }
    .sidebar-scrollable::-webkit-scrollbar {
        width: 7px;
    }
    .sidebar-scrollable::-webkit-scrollbar-thumb {
        background: #d2e3fa;
        border-radius: 9px;
    }
    .sidebar-scrollable::-webkit-scrollbar-track {
        background: #f6faff;
    }
    .sidebar-collapsed {
        width: 70px !important;
        min-width: 70px !important;
    }
    .sidebar-collapsed .sidebar-text,
    .sidebar-collapsed .btn span {
        display: none !important;
    }
    .sidebar-collapsed .nav-link {
        justify-content: center;
        padding-left: 0.8rem !important;
        padding-right: 0.8rem !important;
    }
    .sidebar-collapsed .fs-4,
    .sidebar-collapsed .fs-2 {
        margin: 0 auto;
    }
    .sidebar-collapsed .sidebar-toggle {
        justify-content: center !important;
        margin: 0 auto;
    }
    .sidebar-collapsed .nav-link[title]:hover::after {
        content: attr(title);
        position: absolute;
        left: 90%;
        top: 50%;
        transform: translateY(-50%);
        background: #6155a6;
        color: #fff;
        font-size: 0.91rem;
        font-weight: 500;
        white-space: nowrap;
        border-radius: 0.5rem;
        padding: 0.3rem 0.8rem;
        z-index: 20;
        box-shadow: 0 4px 18px #6351ac39;
        opacity: 0;
        pointer-events: none;
        animation: tooltipIn 0.32s cubic-bezier(.21,1.14,.75,1.07) forwards;
    }
    .sidebar-collapsed .nav-link[title]:hover::after {
        opacity: 1;
        pointer-events: auto;
    }
    @keyframes tooltipIn {
        0% {
            opacity: 0;
            transform: translateY(-50%) translateX(-10px) scale(0.95);
        }
        60% {
            opacity: 0.72;
            transform: translateY(-50%) translateX(2px) scale(1.05);
        }
        100% {
            opacity: 1;
            transform: translateY(-50%) translateX(0) scale(1);
        }
    }
    /* --------- ICONOS ANIMADOS --------- */
    .sidebar-collapsed .nav-link i,
    .sidebar-collapsed .sidebar-toggle i {
        transition: transform 0.23s cubic-bezier(.22,.98,.55,1.13);
    }
    .sidebar-collapsed .nav-link:hover i,
    .sidebar-collapsed .nav-link:focus i,
    .sidebar-collapsed .sidebar-toggle:hover i,
    .sidebar-collapsed .sidebar-toggle:focus i {
        transform: scale(1.15) rotate(-8deg);
        animation: iconBounce 0.32s;
    }
    @keyframes iconBounce {
        0% { transform: scale(1) rotate(0deg);}
        45% { transform: scale(1.18) rotate(-9deg);}
        60% { transform: scale(0.94) rotate(-5deg);}
        85% { transform: scale(1.10) rotate(-8deg);}
        100% { transform: scale(1.15) rotate(-8deg);}
    }
    .glass-title {
        color: #00509e;
        font-weight: 900;
        letter-spacing: 0.01em;
        text-shadow: 0 2px 12px #00509e19;
    }
    .nav-pills .nav-link {
        color: #375e8d !important;
        font-weight: 600;
        border-radius: 2rem !important;
        padding: 0.68rem 1.15rem;
        display: flex;
        align-items: center;
        gap: 0.7rem;
        margin-bottom: 0.2rem;
        transition: background 0.13s, color 0.15s, box-shadow 0.15s;
        position: relative;
    }
    .nav-pills .nav-link:hover, .nav-pills .nav-link:focus {
        background: linear-gradient(90deg, #e6e3fc 50%, #f3eafe 100%);
        color: #6c40ba !important;
        box-shadow: 0 1px 10px #bda8fc24;
    }
    .nav-pills .nav-link.active,
    .nav-pills .nav-link[aria-current="page"] {
        background: linear-gradient(90deg,#d1e5fa 0%,#d9cafd 100%);
        color: #004488 !important;
        font-weight: 700;
        box-shadow: 0 2px 14px 0 #c6b1f426;
    }
    .sidebar-toggle {
        align-items: center;
        display: flex;
        gap: 0.6rem;
        border-radius: 1.8rem !important;
        margin-bottom: 0.7rem;
        margin-top: 0.7rem;
        width: 100%;
        color: #495057 !important;
        background: none !important;
        border: none !important;
        transition: background 0.14s;
    }
    .sidebar-toggle span {
        color: #495057 !important;
        font-weight: 600;
    }
    .sidebar-toggle:focus,
    .sidebar-toggle:hover {
        background: linear-gradient(90deg, #e6e3fc 50%, #f3eafe 100%) !important;
        color: #495057 !important;
    }
    .sidebar-toggle:focus span,
    .sidebar-toggle:hover span {
        color: #495057 !important;
    }
    .btn-outline-danger {
        border: none !important;
        box-shadow: none !important;
        background: none !important;
    }
    .btn-outline-danger:focus,
    .btn-outline-danger:hover {
        box-shadow: 0 2px 12px #6351ac2b;
        color: #dc3545 !important;
        background: linear-gradient(90deg, #f8d7da 50%, #fbe9ec 100%) !important;
    }
    .btn-outline-danger {
        border-radius: 2rem;
        font-weight: 600;
        padding-left: 1rem;
        padding-right: 1rem;
    }
    .sidebar-footer {
        margin-top: auto;
        padding-top: 0.5rem;
        padding-bottom: 1.2rem;
        background: transparent;
    }
    @media (max-width: 991.98px) {
        .sidebar-fixed {
            display: none !important;
        }
    }
    /* Sidebar - Animación de ancho y aparición suave */
    .sidebar-fixed {
        transition:
            width 0.28s cubic-bezier(.77,0,.18,1.01),
            min-width 0.28s cubic-bezier(.77,0,.18,1.01),
            box-shadow 0.22s,
            opacity 0.24s;
        opacity: 1;
    }
    .sidebar-hide {
        opacity: 0;
        pointer-events: none;
        transform: translateX(-25%);
        transition:
            opacity 0.22s cubic-bezier(.38,1.17,.42,.99),
            transform 0.31s cubic-bezier(.68,0,.38,1.08);
    }
    .sidebar-show {
        opacity: 1;
        pointer-events: auto;
        transform: translateX(0);
    }
    body.sidebar-animating #sidebar {
        will-change: opacity, transform;
    }
    @media (max-width: 991.98px) {
        .sidebar-fixed {
            position: fixed !important;
            left: 0;
            top: 0;
            z-index: 1010;
            min-width: 0;
            width: 0;
            opacity: 0;
            pointer-events: none;
            transition:
                width 0.22s cubic-bezier(.7,0,.3,1),
                opacity 0.22s,
                transform 0.29s;
        }
        .sidebar-fixed.sidebar-show {
            width: 220px !important;
            min-width: 220px !important;
            opacity: 1 !important;
            pointer-events: auto !important;
            transform: translateX(0) !important;
            box-shadow: 0 6px 40px #0041881a, 0 1.5px 9px #00509e17;
        }
        .sidebar-fixed.sidebar-hide {
            width: 0 !important;
            min-width: 0 !important;
            opacity: 0 !important;
            pointer-events: none !important;
            transform: translateX(-20%);
        }
    }
    #sidebarMobileToggle {
    
</style>

<nav id="sidebar" class="sidebar-fixed d-none d-md-flex flex-column flex-shrink-0">
    <div class="sidebar-scrollable">
        <div>
            <div class="d-flex align-items-center mb-4 gap-2">
                <span class="fs-2">🏥</span>
                <span class="fs-4 fw-bold glass-title sidebar-text">Hospital EKO</span>
            </div>
            <div class="mb-3 ps-1">
                <div class="fw-bold">
                    <i class="@if(Auth::user()->rol->name == 'Admin') fa-solid fa-user-shield text-primary
                            @elseif(Auth::user()->rol->name == 'Doctor') fa-solid fa-user-md text-success
                            @elseif(Auth::user()->rol->name == 'Paciente') fa-solid fa-user-tie text-warning
                            @endif"></i>
                    <span class="sidebar-text">{{ Auth::user()->nombre }}</span>
                </div>
                <div class="small text-muted sidebar-text">{{ Auth::user()->rol->name }}</div>
            </div>
            <button id="sidebarToggle" class="btn sidebar-toggle btn-sm d-flex align-items-center gap-2" type="button">
                <i class="fas fa-bars"></i> <span>Colapsar</span>
            </button>
            <ul class="nav nav-pills flex-column mb-auto" id="sidebarMenu">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center gap-2 @if(request()->routeIs('dashboard')) active @endif" title="Inicio">
                        <i class="fa-solid fa-house-chimney-medical text-primary"></i>
                        <span class="sidebar-text">Inicio</span>
                    </a>
                </li>
                @can('Ver Roles')
                <li>
                    <a href="{{ route('roles.index') }}" class="nav-link d-flex align-items-center gap-2 @if(request()->routeIs('roles.index')) active @endif" title="Roles">
                        <i class="fa-solid fa-users-gear text-success"></i>
                        <span class="sidebar-text">Roles</span>
                    </a>
                </li>
                @endcan
                @can('Ver Pacientes')
                <li>
                    <a href="{{ route('pacientes.index') }}" class="nav-link d-flex align-items-center gap-2 @if(request()->routeIs('pacientes.index')) active @endif" title="Pacientes">
                        <i class="fa-solid fa-bed-pulse text-info"></i>
                        <span class="sidebar-text">Pacientes</span>
                    </a>
                </li>
                @endcan
                @can('Ver Doctores')
                <li>
                    <a href="{{ route('doctores.index') }}" class="nav-link d-flex align-items-center gap-2 @if(request()->routeIs('doctores.index')) active @endif" title="Doctores">
                        <i class="fa-solid fa-user-doctor text-warning"></i>
                        <span class="sidebar-text">Doctores</span>
                    </a>
                </li>
                @endcan
                @can('Ver Usuarios')
                <li>
                    <a href="{{ route('usuarios.index') }}" class="nav-link d-flex align-items-center gap-2 @if(request()->routeIs('usuarios.index')) active @endif" title="Usuarios">
                        <i class="fa-solid fa-users text-danger"></i>
                        <span class="sidebar-text">Usuarios</span>
                    </a>
                </li>
                @endcan
                @can('Ver Medicamentos')
                <li>
                    <a href="{{ route('medicamentos.index') }}" class="nav-link d-flex align-items-center gap-2 @if(request()->routeIs('medicamentos.index')) active @endif" title="Medicamentos">
                        <i class="fa-solid fa-capsules" style="color: #9b59b6"></i>
                        <span class="sidebar-text">Medicamentos</span>
                    </a>
                </li>
                @endcan
                @can('Ver Enfermedades')
                <li>
                    <a href="{{ route('enfermedades.index') }}" class="nav-link d-flex align-items-center gap-2 @if(request()->routeIs('enfermedades.index')) active @endif" title="Enfermedades">
                        <i class="fa-solid fa-virus-covid" style="color: #e67e22"></i>
                        <span class="sidebar-text">Enfermedades</span>
                    </a>
                </li>
                @endcan
                @can('Ver Citas')
                <li>
                    <a href="{{ route('citas.index') }}" class="nav-link d-flex align-items-center gap-2 @if(request()->routeIs('citas.index')) active @endif" title="Citas">
                        <i class="fa-solid fa-calendar-check text-info"></i>
                        <span class="sidebar-text">Citas</span>
                    </a>
                </li>
                @endcan
                @can('Ver Consultas')
                <li>
                    <a href="{{ route('consultas.index') }}" class="nav-link d-flex align-items-center gap-2 @if(request()->routeIs('consultas.index')) active @endif" title="Consultas">
                        <i class="fa-solid fa-stethoscope text-success"></i>
                        <span class="sidebar-text">Consultas</span>
                    </a>
                </li>
                @endcan
                @can('Ver ConsultaMedicamentos')
                <li>
                    <a href="{{ route('consultaMedicamentos.index') }}" class="nav-link d-flex align-items-center gap-2 @if(request()->routeIs('consultaMedicamentos.index')) active @endif" title="Consulta Medicamentos">
                        <i class="fa-solid fa-vials text-primary"></i>
                        <span class="sidebar-text">Consulta Medicamentos</span>
                    </a>
                </li>
                @endcan
                @can('Ver Historiales')
                    @if(Auth::user()->rol->name == 'Paciente' && Auth::user()->paciente)
                        <li>
                            <a href="{{ route('historialClinico.paciente', ['idPaciente' => Auth::user()->paciente->idPaciente]) }}"
                            class="nav-link d-flex align-items-center gap-2
                            @if(request()->routeIs('historialClinico.paciente')) active @endif"
                            title="Historial Clínico">
                                <i class="fa-solid fa-folder text-success"></i>
                                <span class="sidebar-text">Historial Clínico</span>
                            </a>
                        </li>
                    @endif
                @endcan
                @can('Ver Bitacoras')
                <li>
                    <a href="{{ route('bitacoras.index') }}"
                    class="nav-link d-flex align-items-center gap-2
                        {{ request()->routeIs('bitacoras.index') ? 'active' : '' }}"
                    title="Bitácoras">
                        <i class="fa-solid fa-clipboard-list text-danger"></i>
                        <span class="sidebar-text">Bitácoras</span>
                    </a>
                </li>
                @endcan
            </ul>
            <div class="sidebar-footer mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center gap-2" title="Cerrar sesión">
                        <i class="fa-solid fa-sign-out-alt"></i>
                        <span class="sidebar-text">Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main-content');
    const toggleBtn = document.getElementById('sidebarToggle');
    const mobileToggleBtn = document.getElementById('sidebarMobileToggle');
    let collapsed = localStorage.getItem('sidebar-collapsed') === '1';

    // --- Desktop collapse/expand ---
    function setSidebarState(state) {
        if(state === 'collapsed') {
            sidebar.classList.add('sidebar-collapsed');
            if(main) main.classList.add('main-collapsed');
            localStorage.setItem('sidebar-collapsed', '1');
        } else {
            sidebar.classList.remove('sidebar-collapsed');
            if(main) main.classList.remove('main-collapsed');
            localStorage.setItem('sidebar-collapsed', '0');
        }
    }
    if(collapsed) setSidebarState('collapsed');

    if(toggleBtn) {
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            collapsed = !sidebar.classList.contains('sidebar-collapsed');
            setSidebarState(collapsed ? 'collapsed' : 'expanded');
        });
    }

    // --- MOBILE open/close animation ---
    function showSidebarMobile() {
        sidebar.classList.add('sidebar-show');
        sidebar.classList.remove('sidebar-hide');
        document.body.style.overflow = 'hidden'; // Prevent scroll under sidebar
    }
    function hideSidebarMobile() {
        sidebar.classList.add('sidebar-hide');
        sidebar.classList.remove('sidebar-show');
        document.body.style.overflow = '';
    }

    if(mobileToggleBtn) {
        mobileToggleBtn.addEventListener('click', function(e){
            e.stopPropagation();
            showSidebarMobile();
        });
    }
    // Close on click outside
    document.addEventListener('click', function(e){
        if(window.innerWidth <= 991) {
            if(sidebar.classList.contains('sidebar-show')) {
                // click outside sidebar
                if(!sidebar.contains(e.target) && e.target !== mobileToggleBtn) {
                    hideSidebarMobile();
                }
            }
        }
    });
    // Optionally close on esc key
    document.addEventListener('keydown', function(e){
        if(e.key === 'Escape' && sidebar.classList.contains('sidebar-show')){
            hideSidebarMobile();
        }
    });

    // Responsive: hide sidebar at start in mobile
    function checkSidebarMobile() {
        if(window.innerWidth <= 991) {
            sidebar.classList.add('sidebar-hide');
            sidebar.classList.remove('sidebar-show');
        } else {
            sidebar.classList.remove('sidebar-hide','sidebar-show');
            document.body.style.overflow = '';
        }
    }
    window.addEventListener('resize', checkSidebarMobile);
    checkSidebarMobile();
});
</script>

