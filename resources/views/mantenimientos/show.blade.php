@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1>Detalle del Mantenimiento</h1>

    <ul class="list-group">
        <li class="list-group-item"><strong>Bien:</strong> {{ $mantenimiento->bien->nombre ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>Tipo:</strong> {{ $mantenimiento->tipo }}</li>
        <li class="list-group-item"><strong>Fecha:</strong> {{ $mantenimiento->fecha_programada }}</li>
        <li class="list-group-item"><strong>Estado:</strong> {{ $mantenimiento->estado }}</li>
        <li class="list-group-item"><strong>Responsable:</strong> {{ $mantenimiento->responsable ?? 'No asignado' }}</li>
        <li class="list-group-item"><strong>Observaciones:</strong> {{ $mantenimiento->observaciones ?? 'Sin observaciones' }}</li>
    </ul>

    <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
