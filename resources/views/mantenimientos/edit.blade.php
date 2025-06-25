@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1>Editar Mantenimiento</h1>

    <form action="{{ route('mantenimientos.update', $mantenimiento) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" name="tipo" class="form-control" value="{{ $mantenimiento->tipo }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_programada" class="form-label">Fecha Programada</label>
            <input type="date" name="fecha_programada" class="form-control" value="{{ $mantenimiento->fecha_programada }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" class="form-select" required>
                <option value="pendiente" {{ $mantenimiento->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="realizado" {{ $mantenimiento->estado == 'realizado' ? 'selected' : '' }}>Realizado</option>
                <option value="cancelado" {{ $mantenimiento->estado == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="responsable" class="form-label">Responsable</label>
            <input type="text" name="responsable" class="form-control" value="{{ $mantenimiento->responsable }}">
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="3">{{ $mantenimiento->observaciones }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

