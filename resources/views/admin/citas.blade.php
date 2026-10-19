@extends('layouts.app')
@section('title', 'Gestionar Citas')

@section('content')
<div class="admin-list-page">
    <section class="admin-list-header text-white">
        <div class="container d-flex justify-content-between align-items-end">
            <div><span class="eyebrow text-warning">AGENDA DEL ESTUDIO</span><h1>Gestionar<br><em>citas.</em></h1></div>
            </a>
        </div>
    </section>

    <section class="admin-list-content"><div class="container">
    <form action="{{ route('admin.citas') }}" method="GET" class="admin-search">
        <div class="col-md-10">
            <label for="buscar" class="visually-hidden">Buscar cliente</label>
            <input type="search" id="buscar" name="buscar" value="{{ $busqueda }}"
                   class="form-control"
                   placeholder="Buscar por nombre, correo o teléfono">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-warning">
                <i class="bi bi-search"></i> Buscar
            </button>
        </div>
    </form>

    @if($citas->isEmpty())
        <div class="dashboard-empty">
            <i class="bi bi-calendar-x"></i>
            {{ $busqueda ? 'No se encontraron citas con ese criterio de búsqueda.' : 'No hay citas registradas aún.' }}
        </div>
    @else
        <div class="table-responsive admin-table-wrap">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr data-cita-row="{{ $cita->id }}">
                            <td>{{ $cita->nombre }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge cita-status-badge
                                    @if($cita->estado === 'pendiente') status-pending
                                    @elseif($cita->estado === 'confirmada') status-confirmed
                                    @elseif($cita->estado === 'completada') status-completed
                                    @else status-cancelled
                                    @endif">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-dark"
                                        data-bs-toggle="modal"
                                        data-bs-target="#citaModal{{ $cita->id }}">
                                    <i class="bi bi-search"></i> Inspeccionar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @foreach($citas as $cita)
            <div class="modal fade" id="citaModal{{ $cita->id }}" tabindex="-1"
                 aria-labelledby="citaModalLabel{{ $cita->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content admin-modal">
                        <div class="modal-header admin-modal-header">
                            <h5 class="modal-title" id="citaModalLabel{{ $cita->id }}">
                                <span class="admin-modal-icon"><i class="bi bi-calendar-check"></i></span>
                                <span><small>GESTIÓN DE CITA #{{ $cita->id }}</small>Detalle de la cita</span>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body admin-modal-body">
                            <div class="admin-detail-grid">
                                <div class="admin-detail-item"><i class="bi bi-person"></i><div><small>CLIENTE</small><strong>{{ $cita->nombre }}</strong></div></div>
                                <div class="admin-detail-item"><i class="bi bi-envelope"></i><div><small>EMAIL</small><strong>{{ $cita->email }}</strong></div></div>
                                <div class="admin-detail-item"><i class="bi bi-telephone"></i><div><small>TELÉFONO</small><strong>{{ $cita->telefono }}</strong></div></div>
                                <div class="admin-detail-item"><i class="bi bi-camera"></i><div><small>SERVICIO</small><strong>{{ ucfirst($cita->servicio) }}</strong></div></div>
                                <div class="admin-detail-item"><i class="bi bi-calendar-event"></i><div><small>FECHA</small><strong>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</strong></div></div>
                                <div class="admin-detail-item"><i class="bi bi-clock"></i><div><small>HORA</small><strong>{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }} hrs</strong></div></div>
                                <div class="admin-detail-item admin-detail-status">
                                    <i class="bi bi-flag"></i><div><small>ESTADO</small>
                                    <form action="{{ route('admin.citas.update', $cita->id) }}" method="POST" class="mt-1 js-status-form">
                                        @csrf
                                        @method('PUT')
                                        <select name="estado" class="form-select form-select-sm cita-status-select"
                                                data-cita-id="{{ $cita->id }}"
                                                data-original-value="{{ $cita->estado }}">
                                            <option value="pendiente" {{ $cita->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="confirmada" {{ $cita->estado === 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                            <option value="cancelada" {{ $cita->estado === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                            <option value="completada" {{ $cita->estado === 'completada' ? 'selected' : '' }}>Completada</option>
                                        </select>
                                        <span class="status-update-message" role="status" aria-live="polite"></span>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <div class="admin-message-box"><small>MENSAJE DEL CLIENTE</small><p>{{ $cita->mensaje ?: 'Sin mensaje.' }}</p></div>
                            <div class="admin-products-box" data-products-box>
                            <h6><i class="bi bi-images"></i> Fotos del cliente</h6>
                            @if($cita->productos_path)
                                <p class="small text-success mb-2">
                                    <i class="bi bi-check-circle"></i> {{ $cita->productos_nombre }}
                                </p>
                            @endif
                                <form action="{{ route('admin.citas.productos', $cita) }}" method="POST"
                                      enctype="multipart/form-data" data-products-form
                                      @if($cita->estado !== 'completada') hidden @endif>
                                    @csrf
                                    <input type="file" name="productos" accept=".zip"
                                           class="form-control form-control-sm mb-2" required>
                                    <button class="btn btn-sm btn-warning">
                                        <i class="bi bi-upload"></i>
                                        {{ $cita->productos_path ? 'Reemplazar ZIP' : 'Subir ZIP' }}
                                    </button>
                                </form>
                                <span class="text-muted small" data-products-locked
                                      @if($cita->estado === 'completada') hidden @endif>
                                    <i class="bi bi-lock"></i> Disponible al completar la cita
                                </span>
                            </div>
                        </div>
                        <div class="modal-footer admin-modal-footer justify-content-between">
                            <form action="{{ route('admin.citas.delete', $cita->id) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar esta cita definitivamente?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Eliminar cita
                                </button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

@section('scripts')
    @vite('resources/js/admin-citas.js')
@endsection