@extends('layouts.app')
@section('title', 'Mi Panel')

@section('content')
<div class="dashboard-page">
    <section class="dashboard-hero text-white">
        <div class="container">
            <div class="dashboard-hero-content">
                <span class="eyebrow text-warning">MI ESPACIO PERSONAL</span>
                <h1>Hola, <em>{{ Auth::user()->name }}</em></h1>
                <p>Aquí puedes seguir tus sesiones, consultar tus citas y descargar tus recuerdos.</p>
            </div>
            <div class="dashboard-camera"><i class="bi bi-camera"></i></div>
        </div>
    </section>

    <section class="dashboard-content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
            @endif

            <div class="dashboard-stats">
                <div class="dashboard-stat"><i class="bi bi-calendar-heart"></i><div><strong>{{ $citas->count() }}</strong><span>Citas registradas</span></div></div>
                <div class="dashboard-stat"><i class="bi bi-hourglass-split"></i><div><strong>{{ $citas->where('estado', 'pendiente')->count() }}</strong><span>Por confirmar</span></div></div>
                <div class="dashboard-stat"><i class="bi bi-images"></i><div><strong>{{ $productos->count() }}</strong><span>Entregas disponibles</span></div></div>
            </div>

            <div class="dashboard-section-heading">
                <div><span class="eyebrow text-warning">TUS RESERVACIONES</span><h2>Mis citas</h2></div>
                <a href="{{ route('citas.create') }}" class="dashboard-link">Agendar otra <i class="bi bi-arrow-up-right"></i></a>
            </div>

            @if($citas->isEmpty())
                <div class="dashboard-empty"><i class="bi bi-calendar-plus"></i><h3>Aún no tienes citas</h3><p>Tu próxima historia puede comenzar hoy.</p><a href="{{ route('citas.create') }}" class="btn btn-warning">Agendar mi primera cita</a></div>
            @else
                <div class="appointment-cards">
                    @foreach($citas as $cita)
                        <article class="appointment-card">
                            <div class="appointment-card-date"><strong>{{ \Carbon\Carbon::parse($cita->fecha)->format('d') }}</strong><span>{{ \Carbon\Carbon::parse($cita->fecha)->locale('es')->translatedFormat('M') }}</span></div>
                            <div class="appointment-card-main"><span class="eyebrow text-warning">CITA #{{ $cita->id }}</span><h3>{{ ucfirst($cita->servicio) }}</h3><p><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }} hrs</p></div>
                            <div class="appointment-card-status">
                                @switch($cita->estado)
                                    @case('pendiente')
                                        <span class="status-badge status-pending">Pendiente</span>
                                        @break
                                    @case('confirmada')
                                        <span class="status-badge status-confirmed">Confirmada</span>
                                        @break
                                    @case('cancelada')
                                        <span class="status-badge status-cancelled">Cancelada</span>
                                        @break
                                    @case('completada')
                                        <span class="status-badge status-completed">Completada</span>
                                        @break
                                @endswitch
                            </div>
                            <div class="appointment-card-action">
                                @if($cita->estado === 'pendiente' || $cita->estado === 'confirmada')
                                    <form action="{{ route('citas.cancelar', $cita->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Seguro que deseas cancelar esta cita?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dashboard-cancel"><i class="bi bi-x-circle"></i> Cancelar</button>
                                    </form>
                                @else
                                    <span class="text-muted small">Sin acciones</span>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

            <div class="dashboard-section-heading dashboard-photos-heading">
                <div><span class="eyebrow text-warning">TUS RECUERDOS</span><h2>Mis fotos</h2></div>
            </div>

            @if($productos->isEmpty())
                <div class="dashboard-empty dashboard-empty-small"><i class="bi bi-images"></i><p>Todavía no tienes fotos disponibles para descargar.</p></div>
            @else
                <div class="photo-delivery-grid">
                    @foreach($productos as $producto)
                        <article class="photo-delivery-card"><div class="photo-delivery-icon"><i class="bi bi-file-earmark-zip"></i></div><div><span class="eyebrow text-warning">CITA #{{ $producto->id }}</span><h3>{{ ucfirst($producto->servicio) }}</h3><p>{{ $producto->productos_nombre }}<br><small>Entregado {{ $producto->productos_subidos_at?->format('d/m/Y H:i') }}</small></p></div><a href="{{ route('usuario.descargarProductos', $producto) }}" class="btn btn-dark"><i class="bi bi-download"></i> Descargar</a></article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
@endsection