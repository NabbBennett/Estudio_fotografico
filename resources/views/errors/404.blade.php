@extends('layouts.app')
@section('title', 'Página no encontrada')

@section('content')
<div class="container text-center mt-5 py-5">
    <h1 class="display-1 fw-bold text-danger">404</h1>
    <i class="bi bi-camera fs-1 text-muted"></i>
    <p class="fs-3 mt-3"><span class="text-danger">¡Oops!</span> Página no encontrada.</p>
    <p class="lead text-muted">La página que buscas no existe o fue movida.</p>
    <a href="{{ route('home') }}" class="btn btn-primary btn-lg mt-3">
        <i class="bi bi-house-door"></i> Volver al Inicio
    </a>
</div>
@endsection