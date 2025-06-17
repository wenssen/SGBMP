@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Crear Mantenimiento</h1>

    <form action="{{ route('mantenimientos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="bien_id" class="form-label">Bien</label>
            <select name="bien_id" class="form-select" required>
                <option value="">Selecciona un bien</option>
                @foreach ($bienes as $bien)
                    <option value="{{ $bien->id }}">{{ $bien->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" name="tipo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fecha_programada" class="form-label">Fecha Programada</label>
            <input type="date" name="fecha_programada" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
