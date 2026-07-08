@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-4">
        Editar opinión
    </h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>
        </div>
    @endif

    <form action="{{ route('opiniones.update',$opinion) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Producto</label>

            <input
                type="text"
                name="producto"
                class="form-control"
                value="{{ old('producto',$opinion->producto) }}">

        </div>

        <div class="mb-3">

            <label>Nombre Persona</label>

            <input
                type="text"
                name="nombre_persona"
                class="form-control"
                value="{{ old('nombre_persona',$opinion->nombre_persona) }}">

        </div>

        <div class="mb-3">

            <label>Valoración</label>

            <input
                type="number"
                min="1"
                max="10"
                name="valoracion"
                class="form-control"
                value="{{ old('valoracion',$opinion->valoracion) }}">

        </div>

        <div class="mb-3">

            <label>Comentario</label>

            <textarea
                name="comentario"
                rows="5"
                class="form-control">{{ old('comentario',$opinion->comentario) }}</textarea>

        </div>

        <button class="btn btn-success">

            Actualizar

        </button>

        <a href="{{ route('opiniones.index') }}"
           class="btn btn-secondary">

            Cancelar

        </a>

    </form>

</div>

@endsection