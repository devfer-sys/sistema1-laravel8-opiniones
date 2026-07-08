@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h3>Opiniones Registradas</h3>

        @if(auth()->user()->rol === 'admin')
            <a href="{{ route('usuarios.index') }}" class="btn btn-primary">
                Gestionar usuarios
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <opiniones-list :opiniones='@json($opiniones)'></opiniones-list>

    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>Producto</th>
                <th>Persona</th>
                <th>Valoración</th>
                <th>Comentario</th>
                <th>Registrado por</th>
                <th>Fecha</th>

                @if(auth()->user()->rol === 'admin')
                    <th>Acción</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach($opiniones as $opinion)
                <tr>
                    <td>{{ $opinion->producto }}</td>
                    <td>{{ $opinion->nombre_persona }}</td>
                    <td>{{ $opinion->valoracion }} ⭐</td>
                    <td>{{ $opinion->comentario }}</td>
                    <td>{{ $opinion->usuario ? $opinion->usuario->name : 'Formulario público' }}</td>
                    <td>{{ $opinion->created_at->format('d/m/Y') }}</td>

                    @if(auth()->user()->rol === 'admin')
                        <td>
                            <form action="{{ route('opiniones.destroy', $opinion) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('opiniones.create') }}" class="btn btn-secondary">
        Volver al formulario
    </a>
</div>
@endsection