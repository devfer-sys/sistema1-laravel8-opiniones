@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Registrar Opinión del Producto</h4>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Revisa los datos ingresados:</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('opiniones.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label>Nombre del producto</label>
                    <input type="text" name="producto" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Nombre de la persona</label>
                    <input type="text" name="nombre_persona" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Valoración</label>
                    <select name="valoracion" class="form-control" required>
                        <option value="">Seleccione</option>
                        <option value="1">1 estrella</option>
                        <option value="2">2 estrellas</option>
                        <option value="3">3 estrellas</option>
                        <option value="4">4 estrellas</option>
                        <option value="5">5 estrellas</option>
                        <option value="6">6 estrellas</option>
                        <option value="7">7 estrellas</option>
                        <option value="8">8 estrellas</option>
                        <option value="9">9 estrellas</option>
                        <option value="10">10 estrellas</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Comentario</label>
                    <textarea name="comentario" class="form-control" rows="4" required></textarea>
                </div>

                <button class="btn btn-primary">
                    Guardar opinión
                </button>

                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                        Iniciar sesión
                    </a>
                @endguest

                @auth
                    <a href="{{ route('opiniones.index') }}" class="btn btn-outline-success">
                        Ver opiniones
                    </a>
                @endauth
            </form>
        </div>
    </div>

    {{-- MODIFICACIÓN PRINCIPAL: Sección de Opiniones Destacadas (5-10 estrellas) --}}
    <div class="card shadow mt-5">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Opiniones Destacadas de Clientes ⭐ (5 a 10 Estrellas)</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>Persona</th>
                            <th>Valoración</th>
                            <th>Comentario</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($opinionesDestacadas as $opinion)
                            <tr>
                                <td class="align-middle"><strong>{{ $opinion->producto }}</strong></td>
                                <td class="align-middle">{{ $opinion->nombre_persona }}</td>
                                <td class="align-middle text-warning">
                                    <strong>{{ $opinion->valoracion }} / 10 ⭐</strong>
                                </td>
                                <td class="align-middle">{{ $opinion->comentario }}</td>
                                <td class="align-middle text-muted small">
                                    {{ $opinion->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    No hay opiniones destacadas registradas todavía.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection