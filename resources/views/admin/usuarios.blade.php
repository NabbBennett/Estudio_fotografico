@extends('layouts.app')
@section('title', 'Usuarios Registrados')

@section('content')
<div class="admin-list-page">
    <section class="admin-list-header text-white">
        <div class="container d-flex justify-content-between align-items-end">
            <div><span class="eyebrow text-warning">COMUNIDAD DEL ESTUDIO</span><h1>Usuarios<br><em>registrados.</em></h1></div>
        </div>
    </section>

    <section class="admin-list-content">
        <div class="container">
            <div class="admin-list-heading"><span class="eyebrow text-warning">DIRECTORIO</span><h2>Clientes del estudio <span>{{ $usuarios->count() }}</span></h2></div>
            @if($usuarios->isEmpty())
                <div class="dashboard-empty"><i class="bi bi-people"></i><p>No hay usuarios registrados.</p></div>
            @else
                <div class="table-responsive admin-table-wrap">
                    <table class="table align-middle mb-0">
                <thead>
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
                            <td><span class="status-badge status-confirmed">{{ $user->role }}</span></td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection