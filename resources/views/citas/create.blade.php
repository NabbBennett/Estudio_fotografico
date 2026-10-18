@extends('layouts.app')
@section('title', 'Agendar Cita')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Agendar Cita</h2>

            <form action="{{ route('citas.store') }}" method="POST" class="card p-4 shadow-sm border-0">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre', auth()->user()->name ?? '') }}" required>
                        @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', auth()->user()->email ?? '') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                               value="{{ old('telefono') }}" required>
                        @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Servicio</label>
                        <select name="servicio" class="form-select @error('servicio') is-invalid @enderror" required>
                            <option value="">Seleccione...</option>
                            <option value="basico" {{ old('servicio') == 'basico' ? 'selected' : '' }}>Básico - $50</option>
                            <option value="premium" {{ old('servicio') == 'premium' ? 'selected' : '' }}>Premium - $100</option>
                            <option value="boda" {{ old('servicio') == 'boda' ? 'selected' : '' }}>Boda - $500</option>
                        </select>
                        @error('servicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror"
                               value="{{ old('fecha') }}" required>
                        @error('fecha') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Hora</label>
                        <input type="time" name="hora" class="form-control @error('hora') is-invalid @enderror"
                               value="{{ old('hora') }}" required>
                        @error('hora') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Mensaje (opcional)</label>
                        <textarea name="mensaje" rows="3" class="form-control">{{ old('mensaje') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-lg">
                    <i class="bi bi-calendar-check"></i> Confirmar Cita
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Validar que no se puedan elegir fechas pasadas
    document.addEventListener('DOMContentLoaded', function () {
        const fechaInput = document.getElementById('fecha');
        const hoy = new Date().toISOString().split('T')[0];
        fechaInput.setAttribute('min', hoy);
    });
</script>
@endsection