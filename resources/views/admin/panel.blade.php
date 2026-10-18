@extends('layouts.app')
@section('title', 'Panel de Administración')

@section('content')
<div class="container mt-5">
    <h2 class="text-danger mb-4"><i class="bi bi-speedometer2"></i> Panel de Administración</h2>

    <!-- Tarjetas de estadísticas -->
    <div class="row mb-5 g-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Total Citas</h6>
                        <h2 class="mb-0">{{ $totalCitas }}</h2>
                    </div>
                    <i class="bi bi-calendar3 fs-1 opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-warning text-dark shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Pendientes</h6>
                        <h2 class="mb-0">{{ $citasPendientes }}</h2>
                    </div>
                    <i class="bi bi-hourglass-split fs-1 opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Usuarios</h6>
                        <h2 class="mb-0">{{ $totalUsuarios }}</h2>
                    </div>
                    <i class="bi bi-people fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('admin.citas') }}" class="btn btn-outline-primary me-2">
            <i class="bi bi-calendar-check"></i> Gestionar Citas
        </a>
        <a href="{{ route('admin.usuarios') }}" class="btn btn-outline-success">
            <i class="bi bi-people"></i> Ver Usuarios
        </a>
    </div>
</div>
@endsection