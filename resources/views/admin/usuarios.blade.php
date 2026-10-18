@extends('layouts.app')
@section('title', 'Usuarios Registrados')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-people"></i> Usuarios Registrados</h2>
        <a href="{{ route('admin.panel') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al Panel
        </a>
    </div>

    @if($usuarios->isEmpty())
        <div class="alert alert-info text-center">No hay usuarios registrados.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover bg-white shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Registrado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge bg-primary">{{ $user->role }}</span></td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection