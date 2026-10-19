@extends('layouts.app')
@section('title', 'Servicios')

@section('content')
<div class="services-page">
    <section class="services-intro text-white">
        <div class="container">
            <span class="eyebrow">FOTOGRAFÍA PARA CADA HISTORIA</span>
            <h1>Tu momento.<br><em>Nuestra mirada.</em></h1>
            <p>Diseñamos sesiones con alma para celebrar lo que te hace único.</p>
        </div>
    </section>

    <section class="services-grid-section">
        <div class="container">
            <div class="section-heading text-center mb-5">
                <span class="eyebrow text-warning">ELIGE TU AVENTURA</span>
                <h2>Servicios para celebrar la vida</h2>
                <p>Cuéntanos qué estás imaginando y crearemos una experiencia a tu medida.</p>
            </div>
            <div class="service-grid">
                <article class="service-card service-party">
                    <div class="service-card-inner">
                        <div class="service-card-face service-card-front">
                        <span class="service-number">01</span>
                        <i class="bi bi-balloon-heart service-icon"></i>
                        <h3>Fiesta infantil</h3>
                        <p>Colores, juegos y esa sonrisa que ilumina toda la fiesta.</p>
                        <button type="button" class="service-flip-button">Ver opciones <i class="bi bi-arrow-up-right"></i></button>
                        </div>
                        <div class="service-card-face service-card-back">
                            <span class="service-number">01 / FIESTA</span>
                            <h3>Fiesta infantil</h3>
                            <strong class="service-price">Desde $120</strong>
                            <ul><li>2 horas de cobertura</li><li>80 fotos editadas</li><li>Galería digital privada</li></ul>
                            @include('partials.servicio-cta')
                        </div>
                    </div>
                </article>
                <article class="service-card service-graduation">
                    <div class="service-card-inner">
                        <div class="service-card-face service-card-front">
                        <span class="service-number">02</span>
                        <i class="bi bi-mortarboard service-icon"></i>
                        <h3>Graduaciones</h3>
                        <p>El orgullo de una meta cumplida, congelado para siempre.</p>
                        <button type="button" class="service-flip-button">Ver opciones <i class="bi bi-arrow-up-right"></i></button>
                        </div>
                        <div class="service-card-face service-card-back">
                            <span class="service-number">02 / GRADUACIÓN</span>
                            <h3>Graduaciones</h3>
                            <strong class="service-price">Desde $150</strong>
                            <ul><li>Sesión individual y grupal</li><li>50 fotos editadas</li><li>2 cambios de vestuario</li></ul>
                            @include('partials.servicio-cta')
                        </div>
                    </div>
                </article>
                <article class="service-card service-wedding">
                    <div class="service-card-inner">
                        <div class="service-card-face service-card-front">
                        <span class="service-number">03</span>
                        <i class="bi bi-heart service-icon"></i>
                        <h3>Bodas</h3>
                        <p>La emoción, las miradas y todos los detalles de tu gran día.</p>
                        <button type="button" class="service-flip-button">Ver opciones <i class="bi bi-arrow-up-right"></i></button>
                        </div>
                        <div class="service-card-face service-card-back">
                            <span class="service-number">03 / BODA</span>
                            <h3>Bodas</h3>
                            <strong class="service-price">Desde $500</strong>
                            <ul><li>8 horas de cobertura</li><li>Fotógrafo y asistente</li><li>Álbum digital premium</li></ul>
                            @include('partials.servicio-cta')
                        </div>
                    </div>
                </article>
                <article class="service-card service-portrait">
                    <div class="service-card-inner">
                        <div class="service-card-face service-card-front">
                        <span class="service-number">04</span>
                        <i class="bi bi-person-bounding-box service-icon"></i>
                        <h3>Retratos</h3>
                        <p>Una sesión que capture tu esencia, tu estilo y tu momento.</p>
                        <button type="button" class="service-flip-button">Ver opciones <i class="bi bi-arrow-up-right"></i></button>
                        </div>
                        <div class="service-card-face service-card-back">
                            <span class="service-number">04 / RETRATO</span>
                            <h3>Retratos</h3>
                            <strong class="service-price">Desde $80</strong>
                            <ul><li>1 hora de sesión</li><li>20 fotos editadas</li><li>Estudio o locación exterior</li></ul>
                            @include('partials.servicio-cta')
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="services-footer text-center text-white">
        <div class="container">
            <h2>¿Tienes una idea diferente?</h2>
            <p>Nos encantan los retos. Hagamos realidad esa sesión que imaginas.</p>
            <a href="{{ route('contacto') }}" class="btn btn-warning btn-lg">Cuéntanos tu idea</a>
        </div>
    </section>
</div>
@endsection

@section('scripts')
    @vite('resources/js/servicios.js')
@endsection