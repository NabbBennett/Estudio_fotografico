@extends('layouts.app')
@section('title', 'Mi Panel')

@section('content')
<div class="container mt-5">
    <div class="alert alert-info shadow-sm border-0">
        <h4 class="mb-1"><i class="bi bi-person-circle"></i> ¡Hola, {{ Auth::user()->name }}!</h4>
        <p class="mb-0">Bienvenido a tu panel personal. Aquí puedes ver y gestionar tus citas.</p>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="bi bi-calendar-check"></i> Mis Citas</h3>
        <a href="{{ route('citas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nueva Cita
        </a>
    </div>

    @if($citas->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="bi bi-info-circle fs-3"></i>
            <p class="mb-0 mt-2">Aún no tienes citas agendadas.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover bg-white shadow-sm rounded">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Servicio</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr>
                            <td>{{ $cita->id }}</td>
                            <td class="text-capitalize">{{ $cita->servicio }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                            <td>{{ $cita->hora }}</td>
                            <td>
                                @switch($cita->estado)
                                    @case('pendiente')
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                        @break
                                    @case('confirmada')
                                        <span class="badge bg-success">Confirmada</span>
                                        @break
                                    @case('cancelada')
                                        <span class="badge bg-danger">Cancelada</span>
                                        @break
                                    @case('completada')
                                        <span class="badge bg-info text-dark">Completada</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @if($cita->estado === 'pendiente' || $cita->estado === 'confirmada')
                                    <form action="{{ route('citas.cancelar', $cita->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Seguro que deseas cancelar esta cita?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-x-circle"></i> Cancelar
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
        <h3><i class="bi bi-images"></i> Mis Fotos</h3>
    </div>

    @if($productos->isEmpty())
        <div class="alert alert-secondary text-center">
            <i class="bi bi-images fs-3"></i>
            <p class="mb-0 mt-2">Todavía no tienes fotos disponibles para descargar.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover bg-white shadow-sm rounded">
                <thead class="table-dark">
                    <tr>
                        <th>Cita</th>
                        <th>Archivo</th>
                        <th>Entregado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td>#{{ $producto->id }} - {{ ucfirst($producto->servicio) }}</td>
                            <td>{{ $producto->productos_nombre }}</td>
                            <td>{{ $producto->productos_subidos_at?->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('usuario.descargarProductos', $producto) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="bi bi-download"></i> Descargar ZIP
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection