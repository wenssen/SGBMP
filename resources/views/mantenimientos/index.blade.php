@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Listado de Mantenimientos</h1>

    <a href="{{ route('mantenimientos.create') }}" class="btn btn-primary mb-3">? Nuevo Mantenimiento</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Bien</th>
                <th>Tipo</th>
                <th>Fecha Programada</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mantenimientos as $mantenimiento)
                @php
                    $fecha = \Carbon\Carbon::parse($mantenimiento->fecha_programada)->startOfDay();
                    $hoy = now()->startOfDay();
                    $diasRestantes = $hoy->diffInDays($fecha, false);
                @endphp
                <tr>
                    <td>{{ $mantenimiento->bien->nombre ?? 'N/A' }}</td>
                    <td>{{ $mantenimiento->tipo }}</td>
                    <td>
                        {{ $mantenimiento->fecha_programada }}
                        <br>
                        @if ($fecha->equalTo($hoy))
                            <span class="badge bg-warning text-dark">Hoy</span>
                        @elseif ($diasRestantes > 0)
                            <span class="badge bg-success">En {{ $diasRestantes }} días</span>
                        @else
                            <span class="badge bg-danger">Vencido hace {{ abs($diasRestantes) }} días</span>
                        @endif
                    </td>
                    <td>{{ $mantenimiento->estado }}</td>
                    <td>
                        <a href="{{ route('mantenimientos.show', $mantenimiento) }}" class="btn btn-info btn-sm">??</a>
                        <a href="{{ route('mantenimientos.edit', $mantenimiento) }}" class="btn btn-warning btn-sm">??</a>
                        <form action="{{ route('mantenimientos.destroy', $mantenimiento) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">???</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
