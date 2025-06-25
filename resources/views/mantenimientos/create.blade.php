@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Crear Mantenimiento</h1>

    <form action="{{ route('mantenimientos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="bien_id" class="form-label">Bien</label>
            <select name="bien_id" id="bien_id" class="form-select" required>
                <option value="">Selecciona un bien</option>
                @foreach ($bienes as $bien)
                    <option value="{{ $bien->id }}">{{ $bien->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" name="tipo" id="tipo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fecha_programada" class="form-label">Fecha Programada</label>
            <input type="date" name="fecha_programada" id="fecha_programada" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="pendiente">Pendiente</option>
                <option value="realizado">Realizado</option>
                <option value="cancelado">Cancelado</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="responsable" class="form-label">Responsable</label>
            <input type="text" name="responsable" id="responsable" class="form-control" placeholder="Opcional">
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="3" placeholder="Opcional"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

