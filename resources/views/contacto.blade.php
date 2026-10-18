@extends('layouts.app')
@section('title', 'Contacto')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Contáctanos</h2>
            <p class="text-center text-muted mb-4">¿Tienes alguna pregunta? Escríbenos y te responderemos pronto.</p>

            <form action="{{ route('contacto.enviar') }}" method="POST" class="card p-4 shadow-sm border-0">
                @csrf
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-person"></i> Nombre</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                           value="{{ old('nombre') }}" required>
                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-envelope"></i> Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-chat-left-text"></i> Mensaje</label>
                    <textarea name="mensaje" rows="5" class="form-control @error('mensaje') is-invalid @enderror" required>{{ old('mensaje') }}</textarea>
                    @error('mensaje') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send"></i> Enviar Mensaje
                </button>
            </form>
        </div>
    </div>
</div>
@endsection