@extends('layouts.app')
@section('title', 'Inicio')

@section('content')
<div class="container mt-5">
    <!-- Hero -->
    <div class="p-5 mb-5 rounded-3 shadow hero-section text-center text-white">
        <h1 class="display-4 fw-bold">Capturamos tus mejores momentos</h1>
        <p class="lead">Bienvenido a nuestro estudio fotográfico profesional. Agenda tu sesión hoy mismo.</p>
        <a href="{{ route('citas.create') }}" class="btn btn-warning btn-lg mt-3">
            <i class="bi bi-calendar-plus"></i> Agendar Cita
        </a>
    </div>

    <!-- Servicios destacados -->
    <div class="row text-center mb-5">
        <h2 class="mb-4">¿Por qué elegirnos?</h2>
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-camera fs-1 text-warning"></i>
                    <h5 class="card-title mt-3">Equipo Profesional</h5>
                    <p class="card-text text-muted">Cámaras de última generación y fotógrafos certificados.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-palette fs-1 text-warning"></i>
                    <h5 class="card-title mt-3">Edición de Calidad</h5>
                    <p class="card-text text-muted">Retoque profesional incluido en todos nuestros paquetes.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-clock-history fs-1 text-warning"></i>
                    <h5 class="card-title mt-3">Entrega Rápida</h5>
                    <p class="card-text text-muted">Tus fotos listas en menos de 7 días hábiles.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection