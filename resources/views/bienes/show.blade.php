@extends('layouts.layout')

@section('content')
    <h2 class="mb-4">Detalle del Bien</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $bien->nombre }}</h5>
            <p><strong>Categoría:</strong> {{ $bien->categoria }}</p>
            <p><strong>Ubicación:</strong> {{ $bien->ubicacion }}</p>
            <p><strong>Cantidad:</strong> {{ $bien->cantidad }}</p>

            <p>
                <strong>¿Requiere mantenimiento?:</strong>
                @if ($bien->requiere_mantenimiento)
                    <span class="badge bg-warning text-dark">Sí</span>
                @else
                    <span class="badge bg-success">No</span>
                @endif
            </p>

            <p><strong>Fecha de adquisición:</strong> {{ $bien->fecha_adquisicion ?? 'No registrada' }}</p>
            <p><strong>Descripción:</strong><br>{{ $bien->descripcion ?? 'Sin descripción' }}</p>

            <p><strong>Registrado el:</strong> {{ $bien->created_at->format('d-m-Y H:i') }}</p>
        </div>
    </div>

    {{-- Historial de Mantenimientos --}}
    <h4 class="mt-5">Historial de Mantenimientos</h4>

    @if($bien->mantenimientos->isEmpty())
        <p class="text-muted">Este bien no tiene mantenimientos registrados.</p>
    @else
        <table class="table table-striped table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Tipo</th>
                    <th>Fecha Programada</th>
                    <th>Estado</th>
                    <th>Responsable</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bien->mantenimientos as $mantenimiento)
                    @php
                        $fecha = \Carbon\Carbon::parse($mantenimiento->fecha_programada);
                        $hoy = \Carbon\Carbon::today();
                        $diff = $hoy->diffInDays($fecha, false);
                    @endphp

                    <tr>
                        <td>{{ $mantenimiento->tipo }}</td>
                        <td>
                            {{ $fecha->format('d-m-Y') }}<br>
                            @if ($diff === 0)
                                <span class="badge bg-info text-dark">Es hoy</span>
                            @elseif ($diff > 0)
                                <span class="badge bg-warning text-dark">Faltan {{ $diff }} día(s)</span>
                            @else
                                <span class="badge bg-danger">Vencido hace {{ abs($diff) }} día(s)</span>
                            @endif
                        </td>
                        <td>
                            @if ($mantenimiento->estado === 'pendiente')
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            @elseif ($mantenimiento->estado === 'realizado')
                                <span class="badge bg-success">Realizado</span>
                            @else
                                <span class="badge bg-secondary">Cancelado</span>
                            @endif
                        </td>
                        <td>{{ $mantenimiento->responsable ?? '—' }}</td>
                        <td>{{ $mantenimiento->observaciones ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('bienes.index') }}" class="btn btn-secondary mt-3">Volver al listado</a>
@endsection

