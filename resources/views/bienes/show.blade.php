@extends('layout')

@section('content')
    <h2 class="mb-4">Detalle del Bien</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $bien->nombre }}</h5>
            <p><strong>Categoría:</strong> {{ $bien->categoria }}</p>
            <p><strong>Ubicación:</strong> {{ $bien->ubicacion }}</p>
            <p><strong>Cantidad:</strong> {{ $bien->cantidad }}</p>
            <p><strong>Fecha de adquisición:</strong> {{ $bien->fecha_adquisicion ?? 'No registrada' }}</p>
            <p><strong>Descripción:</strong><br>{{ $bien->descripcion ?? 'Sin descripción' }}</p>
        </div>
    </div>

    <a href="{{ route('bienes.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
@endsection
