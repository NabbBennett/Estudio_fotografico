@extends('layouts.app')
@section('title', 'Panel de Administración')

@section('content')
<div class="admin-page">
    <section class="admin-hero text-white">
        <div class="container">
            <span class="eyebrow text-warning">CENTRO DE CONTROL</span>
            <h1>Panel de<br><em>administración.</em></h1>
            <p>Gestiona las citas, usuarios y entregas de tu estudio desde un solo lugar.</p>
        </div>
    </section>

    <section class="admin-content">
        <div class="container">
    <div class="admin-stats">
        <div class="admin-stat-item">
            <div class="admin-stat-card">
                <div class="admin-stat-body">
                    <div>
                        <h6>Total Citas</h6>
                        <h2>{{ $totalCitas }}</h2>
                    </div>
                    <i class="bi bi-calendar3"></i>
                </div>
            </div>
        </div>

        <div class="admin-stat-item">
            <div class="admin-stat-card admin-stat-warning">
                <div class="admin-stat-body">
                    <div>
                        <h6>Pendientes</h6>
                        <h2>{{ $citasPendientes }}</h2>
                    </div>
                    <i class="bi bi-hourglass-split"></i>
                </div>
            </div>
        </div>

        <div class="admin-stat-item">
            <div class="admin-stat-card admin-stat-success">
                <div class="admin-stat-body">
                    <div>
                        <h6>Usuarios</h6>
                        <h2>{{ $totalUsuarios }}</h2>
                    </div>
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-actions">
        <a href="{{ route('admin.citas') }}" class="admin-action-card">
            <i class="bi bi-calendar-check"></i> Gestionar Citas
        </a>
        <a href="{{ route('admin.usuarios') }}" class="admin-action-card">
            <i class="bi bi-people"></i> Ver Usuarios
        </a>
    </div>
        </div>
    </section>
</div>
@endsection