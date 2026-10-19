@extends('layouts.app')
@section('title', 'Agendar Cita')

@section('content')
<div class="appointment-page">
    <section class="appointment-hero text-white">
        <div class="container">
            <span class="eyebrow">EL PRIMER PASO HACIA TU RECUERDO</span>
            <h1>Reserva tu<br><em>momento.</em></h1>
            <p>Elige la fecha, cuéntanos tu idea y nosotros nos encargamos de hacerla realidad.</p>
        </div>
    </section>

    <section class="appointment-section">
        <div class="container">
            <div class="appointment-layout">
                <aside class="appointment-info text-white">
                    <span class="eyebrow text-warning">TU SESIÓN, A TU MANERA</span>
                    <h2>Todo comienza con una fecha.</h2>
                    <p>Completa tus datos y revisaremos la disponibilidad para confirmar tu sesión.</p>
                    <div class="appointment-step"><span>01</span><div><strong>Cuéntanos quién eres</strong><small>Usaremos tus datos para contactarte.</small></div></div>
                    <div class="appointment-step"><span>02</span><div><strong>Elige tu experiencia</strong><small>Selecciona el servicio ideal para ti.</small></div></div>
                    <div class="appointment-step"><span>03</span><div><strong>Nosotros hacemos el resto</strong><small>Te confirmaremos todos los detalles.</small></div></div>
                </aside>

                <div class="appointment-form-wrap">
                    <div class="contact-form-heading">
                        <span class="eyebrow text-warning">RESERVACIÓN</span>
                        <h2>Agendar cita</h2>
                        <p>Los campos marcados son necesarios para procesar tu solicitud.</p>
                    </div>

                    <form action="{{ route('citas.store') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre">Nombre completo</label>
                                <div class="contact-input"><i class="bi bi-person"></i><input id="nombre" type="text" name="nombre" placeholder="Tu nombre completo" value="{{ old('nombre', auth()->user()->name ?? '') }}" required></div>
                                @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <div class="contact-input"><i class="bi bi-envelope"></i><input id="email" type="email" name="email" placeholder="tu@email.com" value="{{ old('email', auth()->user()->email ?? '') }}" required></div>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="telefono">Teléfono</label>
                                <div class="contact-input"><i class="bi bi-telephone"></i><input id="telefono" type="tel" name="telefono" placeholder="Tu teléfono" value="{{ old('telefono') }}" required maxlength="10" inputmode="numeric" pattern="[0-9]{10}" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 10);"></div>
                                @error('telefono') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="servicio">Servicio</label>
                                <div class="contact-input"><i class="bi bi-camera"></i><select id="servicio" name="servicio" required><option value="">Selecciona un servicio</option><option value="fiesta infantil" {{ old('servicio') == 'fiesta infantil' ? 'selected' : '' }}>Fiesta infantil - $120</option><option value="graduacion" {{ old('servicio') == 'graduacion' ? 'selected' : '' }}>Graduación - $150</option><option value="boda" {{ old('servicio') == 'boda' ? 'selected' : '' }}>Boda - $500</option><option value="retrato" {{ old('servicio') == 'retrato' ? 'selected' : '' }}>Retrato - $20</option></select></div>
                                @error('servicio') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="fecha">Fecha preferida</label>
                                <div class="contact-input"><i class="bi bi-calendar-event"></i><input id="fecha" type="date" name="fecha" value="{{ old('fecha') }}" required></div>
                                @error('fecha') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="hora">Hora preferida</label>
                                <div class="contact-input"><i class="bi bi-clock"></i><input id="hora" type="time" name="hora" value="{{ old('hora') }}" required></div>
                                @error('hora') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-12">
                                <label for="mensaje">Detalles de tu sesión <span>(opcional)</span></label>
                                <div class="contact-input contact-textarea"><i class="bi bi-chat-left-text"></i><textarea id="mensaje" name="mensaje" rows="4" placeholder="Cuéntanos sobre tu evento o idea...">{{ old('mensaje') }}</textarea></div>
                            </div>
                            <div class="col-12"><button type="submit" class="btn btn-warning btn-lg contact-submit">Solicitar reservación <i class="bi bi-arrow-up-right"></i></button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    // Validar que no se puedan elegir fechas pasadas
    document.addEventListener('DOMContentLoaded', function () {
        const fechaInput = document.getElementById('fecha');
        const hoy = new Date().toISOString().split('T')[0];
        fechaInput.setAttribute('min', hoy);

        const telefonoInput = document.getElementById('telefono');
        telefonoInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });
    });
</script>
@endsection