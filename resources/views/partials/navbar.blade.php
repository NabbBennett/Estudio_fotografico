<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <i class="bi bi-camera-fill text-warning"></i> FotoEstudio
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('galeria') }}">Galería</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('servicios') }}">Servicios</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contacto') }}">Contacto</a></li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.panel') }}"><i class="bi bi-speedometer2"></i> Panel Admin</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.citas') }}"><i class="bi bi-calendar-check"></i> Gestionar Citas</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.usuarios') }}"><i class="bi bi-people"></i> Usuarios</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('usuario.panel') }}"><i class="bi bi-person-badge"></i> Perfil</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="px-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger w-100">
                                        <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-outline-light btn-sm mt-3" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-warning btn-sm mt-3 mb-2" href="{{ route('register') }}">Agendar una cita</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>