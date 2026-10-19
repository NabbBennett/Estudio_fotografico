@extends('layouts.app')
@section('title', 'Contacto')

@section('content')
<div class="contact-page">
    <section class="contact-hero text-white">
        <div class="container">
            <span class="eyebrow">HAGAMOS ALGO INOLVIDABLE</span>
            <h1>Hablemos de<br><em>tu historia.</em></h1>
            <p>Cuéntanos qué momento quieres guardar y diseñaremos una sesión hecha para ti.</p>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-layout">
                <aside class="contact-info text-white">
                    <span class="eyebrow text-warning">ESTAMOS PARA ESCUCHARTE</span>
                    <h2>Tu idea empieza con una conversación.</h2>
                    <p>Respondemos tus preguntas, te ayudamos a elegir el paquete ideal y hacemos que reservar sea sencillo.</p>

                    <div class="contact-detail">
                        <i class="bi bi-envelope-heart"></i>
                        <div><small>Escríbenos</small><strong>Contáctanos por el formulario</strong></div>
                    </div>
                    <div class="contact-detail">
                        <i class="bi bi-clock-history"></i>
                        <div><small>Horario de atención</small><strong>Lunes a sábado · 9:00 - 18:00</strong></div>
                    </div>
                    <div class="contact-detail">
                        <i class="bi bi-camera"></i>
                        <div><small>También puedes</small><strong>Agendar una sesión directamente</strong></div>
                    </div>
                </aside>

                <div class="contact-form-wrap">
                    <div class="contact-form-heading">
                        <span class="eyebrow text-warning">CUÉNTANOS</span>
                        <h2>Envíanos un mensaje</h2>
                        <p>Completa el formulario y nos pondremos en contacto contigo pronto.</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success border-0">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('contacto.enviar') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre">Nombre</label>
                                <div class="contact-input">
                                    <i class="bi bi-person"></i>
                                    <input id="nombre" type="text" name="nombre" placeholder="Tu nombre"
                                           value="{{ old('nombre') }}" required>
                                </div>
                                @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <div class="contact-input">
                                    <i class="bi bi-envelope"></i>
                                    <input id="email" type="email" name="email" placeholder="tu@email.com"
                                           value="{{ old('email') }}" required>
                                </div>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-12">
                                <label for="mensaje">Mensaje</label>
                                <div class="contact-input contact-textarea">
                                    <i class="bi bi-chat-left-text"></i>
                                    <textarea id="mensaje" name="mensaje" rows="5" placeholder="Cuéntanos sobre tu evento..." required>{{ old('mensaje') }}</textarea>
                                </div>
                                @error('mensaje') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-warning btn-lg contact-submit">
                                    Enviar mensaje <i class="bi bi-arrow-up-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection