<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SGBMP - Sistema de Gestión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4" id="mainNavbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><i class="fa fa-home" aria-hidden="true"></i></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbarCollapse">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fa fa-bell"></i>
                        @if(isset($alertas_mantenimiento) && count($alertas_mantenimiento) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ count($alertas_mantenimiento) }}
                            </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="min-width: 300px;">
                        @forelse ($alertas_mantenimiento as $alerta)
                            <li>
                                <a href="{{ route('mantenimientos.show', $alerta) }}" class="dropdown-item small text-dark">
                                    🔧 {{ $alerta->bien->nombre ?? 'Bien' }} – {{ $alerta->tipo }}
                                    <br><small class="text-muted">📅 {{ \Carbon\Carbon::parse($alerta->fecha_programada)->format('d-m-Y') }}</small>
                                </a>
                            </li>
                        @empty
                            <li class="dropdown-item text-muted small">Sin notificaciones</li>
                        @endforelse
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-primary small" href="{{ route('mantenimientos.index') }}">📋 Ver todos los mantenimientos</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-cog"></i> Configuración</a></li>

                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarUser" role="button" data-bs-toggle="dropdown">
                        <i class="fa fa-user-circle"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUser">
                        <li class="dropdown-item text-muted small">{{ Auth::user()->email }}</li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth

                <li class="nav-item">
                    <button id="themeToggle" class="btn btn-outline-light btn-sm ms-2" title="Cambiar tema">
                        <i class="fa fa-moon" id="themeIcon"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

@if(isset($alertas_mantenimiento) && count($alertas_mantenimiento) > 0)
<div id="alertaToast" class="toast position-fixed bottom-0 end-0 m-4" role="alert" data-bs-delay="15000" style="z-index: 1055; background-color: #ffc107; color: #000;">
    <div class="toast-header" style="background-color: #343a40; color: #fff;">
        <strong class="me-auto">⚠️ Mantenimiento</strong>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close" onclick="dismissAlertaToast()"></button>
    </div>
    <div class="toast-body" style="font-size: 0.9rem;">
        Hay {{ count($alertas_mantenimiento) }} mantenimiento(s) programado(s):
        <ul class="mb-0">
            @foreach ($alertas_mantenimiento as $alerta)
                <li>
                    <a href="{{ route('mantenimientos.show', $alerta) }}" class="text-dark text-decoration-underline">
                        {{ $alerta->bien->nombre ?? 'Bien' }} – {{ $alerta->tipo }}
                    </a>
                    ({{ \Carbon\Carbon::parse($alerta->fecha_programada)->format('d-m-Y') }})
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<main class="container">
    @yield('content')
</main>

<script src="{{ asset('js/theme.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@if(isset($alertas_mantenimiento) && count($alertas_mantenimiento) > 0)
<script>
    const alertaToast = document.getElementById('alertaToast');
    const toastKey = 'alertasCerradas';
    const alertasActuales = @json($alertas_mantenimiento->pluck('id'));
    const alertasCerradas = JSON.parse(localStorage.getItem(toastKey) || '[]');

    const hayAlertaNueva = alertasActuales.some(id => !alertasCerradas.includes(id));

    let originalTitle = document.title;
    let blinkInterval = null;

    function startBlinkingTitle(message) {
        if (blinkInterval || !document.hidden) return;
        let visible = true;
        blinkInterval = setInterval(() => {
            document.title = visible ? `🔔 ${message}` : originalTitle;
            visible = !visible;
        }, 1500);
    }

    function stopBlinkingTitle() {
        clearInterval(blinkInterval);
        document.title = originalTitle;
    }

    function dismissAlertaToast() {
        localStorage.setItem(toastKey, JSON.stringify(alertasActuales));
        if (alertaToast) alertaToast.remove();
        stopBlinkingTitle();
    }

    document.addEventListener('visibilitychange', () => {
        if (!document.hidden) stopBlinkingTitle();
    });

    document.addEventListener('DOMContentLoaded', () => {
        if (hayAlertaNueva && alertaToast) {
            alertaToast.classList.remove('d-none');
            const toast = new bootstrap.Toast(alertaToast, { delay: 15000 });
            toast.show();
            startBlinkingTitle('¡Tienes alertas de mantenimiento!');
        }
    });
</script>
@endif

</body>
</html>

