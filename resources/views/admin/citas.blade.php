@extends('layouts.app')
@section('title', 'Gestionar Citas')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-calendar-check"></i> Gestión de Citas</h2>
        <a href="{{ route('admin.panel') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al Panel
        </a>
    </div>

    <form action="{{ route('admin.citas') }}" method="GET" class="row g-2 mb-4">
        <div class="col-md-10">
            <label for="buscar" class="visually-hidden">Buscar cliente</label>
            <input type="search" id="buscar" name="buscar" value="{{ $busqueda }}"
                   class="form-control"
                   placeholder="Buscar por nombre, correo o teléfono">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i> Buscar
            </button>
        </div>
    </form>

    @if($citas->isEmpty())
        <div class="alert alert-info text-center">
            {{ $busqueda ? 'No se encontraron citas con ese criterio de búsqueda.' : 'No hay citas registradas aún.' }}
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr>
                            <td>{{ $cita->nombre }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge
                                    @if($cita->estado === 'pendiente') bg-warning text-dark
                                    @elseif($cita->estado === 'confirmada') bg-success
                                    @elseif($cita->estado === 'completada') bg-info text-dark
                                    @else bg-danger
                                    @endif">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-primary"
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
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="citaModalLabel{{ $cita->id }}">
                                <i class="bi bi-calendar-check"></i> Detalle de la cita
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6"><strong>Cliente:</strong> {{ $cita->nombre }}</div>
                                <div class="col-md-6"><strong>Email:</strong> {{ $cita->email }}</div>
                                <div class="col-md-6"><strong>Teléfono:</strong> {{ $cita->telefono }}</div>
                                <div class="col-md-6"><strong>Servicio:</strong> {{ ucfirst($cita->servicio) }}</div>
                                <div class="col-md-6"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</div>
                                <div class="col-md-6"><strong>Hora:</strong> {{ $cita->hora }}</div>
                                <div class="col-md-6">
                                    <strong>Estado:</strong>
                                    <form action="{{ route('admin.citas.update', $cita->id) }}" method="POST" class="mt-1">
                                        @csrf
                                        @method('PUT')
                                        <select name="estado" class="form-select form-select-sm"
                                                onchange="this.form.submit()">
                                            <option value="pendiente" {{ $cita->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="confirmada" {{ $cita->estado === 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                            <option value="cancelada" {{ $cita->estado === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                            <option value="completada" {{ $cita->estado === 'completada' ? 'selected' : '' }}>Completada</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="col-12">
                                    <strong>Mensaje:</strong>
                                    <p class="mb-0">{{ $cita->mensaje ?: 'Sin mensaje.' }}</p>
                                </div>
                            </div>

                            <hr>
                            <h6><i class="bi bi-images"></i> Fotos del cliente</h6>
                            @if($cita->productos_path)
                                <p class="small text-success mb-2">
                                    <i class="bi bi-check-circle"></i> {{ $cita->productos_nombre }}
                                </p>
                            @endif
                            @if($cita->estado === 'completada')
                                <form action="{{ route('admin.citas.productos', $cita) }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="productos" accept=".zip"
                                           class="form-control form-control-sm mb-2" required>
                                    <button class="btn btn-sm btn-primary">
                                        <i class="bi bi-upload"></i>
                                        {{ $cita->productos_path ? 'Reemplazar ZIP' : 'Subir ZIP' }}
                                    </button>
                                </form>
                            @else
                                <span class="text-muted small">
                                    <i class="bi bi-lock"></i> Disponible al completar la cita
                                </span>
                            @endif
                        </div>
                        <div class="modal-footer justify-content-between">
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