@extends('layouts.layout')

@section('content')
    <h2 class="mb-4">Editar Bien</h2>

    <form action="{{ route('bienes.update', $bien->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del bien</label>
            <input type="text" name="nombre" class="form-control" value="{{ $bien->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <input type="text" name="categoria" class="form-control" value="{{ $bien->categoria }}" required>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" value="{{ $bien->ubicacion }}" required>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" value="{{ $bien->cantidad }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_adquisicion" class="form-label">Fecha de adquisición</label>
            <input type="date" name="fecha_adquisicion" class="form-control" value="{{ $bien->fecha_adquisicion }}">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3">{{ $bien->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">¿Requiere mantenimiento?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="requiere_mantenimiento" id="mantenimiento_si" value="1" {{ $bien->requiere_mantenimiento ? 'checked' : '' }}>
                <label class="form-check-label" for="mantenimiento_si">Sí</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="requiere_mantenimiento" id="mantenimiento_no" value="0" {{ !$bien->requiere_mantenimiento ? 'checked' : '' }}>
                <label class="form-check-label" for="mantenimiento_no">No</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('bienes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection

