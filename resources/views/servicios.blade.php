@extends('layouts.app')
@section('title', 'Servicios')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-2">Nuestros Paquetes</h2>
    <p class="text-center text-muted mb-5">Elige el servicio que mejor se adapte a ti</p>

    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0">Básico</h4>
                </div>
                <div class="card-body">
                    <h2 class="text-primary">$50</h2>
                    <ul class="list-unstyled mt-3">
                        <li><i class="bi bi-check-circle text-success"></i> Sesión de 1 hora</li>
                        <li><i class="bi bi-check-circle text-success"></i> 10 fotos editadas</li>
                        <li><i class="bi bi-check-circle text-success"></i> Entrega digital</li>
                    </ul>
                    <a href="{{ route('citas.create') }}" class="btn btn-primary w-100 mt-3">Reservar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow h-100 border-0 border-2 border-success">
                <div class="card-header bg-success text-white py-3">
                    <h4 class="mb-0">Premium <span class="badge bg-warning text-dark">Popular</span></h4>
                </div>
                <div class="card-body">
                    <h2 class="text-success">$100</h2>
                    <ul class="list-unstyled mt-3">
                        <li><i class="bi bi-check-circle text-success"></i> Sesión de 3 horas</li>
                        <li><i class="bi bi-check-circle text-success"></i> 30 fotos editadas</li>
                        <li><i class="bi bi-check-circle text-success"></i> Álbum digital</li>
                        <li><i class="bi bi-check-circle text-success"></i> 2 locaciones</li>
                    </ul>
                    <a href="{{ route('citas.create') }}" class="btn btn-success w-100 mt-3">Reservar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-dark text-white py-3">
                    <h4 class="mb-0">Bodas</h4>
                </div>
                <div class="card-body">
                    <h2 class="text-dark">$500</h2>
                    <ul class="list-unstyled mt-3">
                        <li><i class="bi bi-check-circle text-success"></i> Cobertura completa</li>
                        <li><i class="bi bi-check-circle text-success"></i> Fotógrafo + asistente</li>
                        <li><i class="bi bi-check-circle text-success"></i> 200+ fotos editadas</li>
                        <li><i class="bi bi-check-circle text-success"></i> Álbum impreso</li>
                    </ul>
                    <a href="{{ route('citas.create') }}" class="btn btn-dark w-100 mt-3">Reservar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection