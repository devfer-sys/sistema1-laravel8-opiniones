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
                    Revisa los datos ingresados.
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
</div>
@endsection