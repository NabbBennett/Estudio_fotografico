@extends('layouts.app')
@section('title', 'Galería')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-2">Nuestro Portafolio</h2>
    <p class="text-center text-muted mb-5">Una muestra de nuestro trabajo</p>

    <div class="row g-4">
        @for ($i = 1; $i <= 9; $i++)
        <div class="col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm galeria-item">
                <img src="https://picsum.photos/400/300?random={{ $i }}" 
                     class="card-img-top" alt="Foto {{ $i }}">
                <div class="card-body text-center py-2">
                    <small class="text-muted">Proyecto #{{ $i }}</small>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection