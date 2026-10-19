@extends('layouts.app')
@section('title', 'Inicio')

@section('content')
<div class="home-page">
    <section class="hero-section text-white">
        <div class="hero-content">
            <span class="eyebrow">ESTUDIO FOTOGRÁFICO • DESDE 2015</span>
            <h1>Historias que merecen<br><em>ser recordadas</em></h1>
            <p>Fotografía natural, emoción real y recuerdos que duran para siempre.</p>
            <a href="{{ route('citas.create') }}" class="btn btn-warning btn-lg mt-3">
            <i class="bi bi-calendar-plus"></i> Agendar Cita
            </a>
            <a href="{{ route('servicios') }}" class="btn btn-outline-light btn-lg mt-3 ms-2">Descubrir servicios</a>
        </div>
        <div class="hero-scroll"><i class="bi bi-arrow-down"></i> Explora nuestro trabajo</div>
    </section>

    <section class="container py-5">
        <div class="section-heading text-center">
            <span class="eyebrow text-warning">LO HACEMOS ESPECIAL</span>
            <h2>Momentos que se sienten</h2>
            <p>Desde una sonrisa espontánea hasta el “sí, acepto”. Estamos ahí para contar tu historia.</p>
        </div>
        <div class="row g-4 text-center mt-3">
        <div class="col-md-4 mb-3">
            <div class="feature-card h-100">
                <div class="card-body">
                    <i class="bi bi-camera fs-1 text-warning"></i>
                    <h5 class="card-title mt-3">Equipo Profesional</h5>
                    <p class="card-text text-muted">Cámaras de última generación y fotógrafos certificados.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="feature-card h-100">
                <div class="card-body">
                    <i class="bi bi-palette fs-1 text-warning"></i>
                    <h5 class="card-title mt-3">Edición de Calidad</h5>
                    <p class="card-text text-muted">Retoque profesional incluido en todos nuestros paquetes.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="feature-card h-100">
                <div class="card-body">
                    <i class="bi bi-clock-history fs-1 text-warning"></i>
                    <h5 class="card-title mt-3">Entrega Rápida</h5>
                    <p class="card-text text-muted">Tus fotos listas en menos de 7 días hábiles.</p>
                </div>
            </div>
        </div>
    </div>
    </section>

    <section class="home-cta text-white text-center">
        <div class="container">
            <span class="eyebrow">TU PRÓXIMO RECUERDO COMIENZA AQUÍ</span>
            <h2>¿Listos para crear algo inolvidable?</h2>
            <a href="{{ route('contacto') }}" class="btn btn-light btn-lg mt-3">Hablemos de tu idea</a>
        </div>
    </section>
</div>
@endsection