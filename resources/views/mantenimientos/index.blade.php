@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Listado de Mantenimientos</h1>

    <a href="{{ route('mantenimientos.create') }}" class="btn btn-primary mb-3">Nuevo Mantenimiento</a>

    {{-- Filtros --}}
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select">
                <option value="">Todos</option>
                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="realizado" {{ request('estado') == 'realizado' ? 'selected' : '' }}>Realizado</option>
                <option value="cancelado" {{ request('estado') == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="responsable" class="form-label">Responsable</label>
            <input type="text" name="responsable" id="responsable" class="form-control"
                   value="{{ request('responsable') }}" placeholder="Nombre responsable">
        </div>

        <div class="col-md-3">
            <label for="fecha" class="form-label">Fecha programada</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ request('fecha') }}">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Filtrar</button>
            <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Bien</th>
                <th>Tipo</th>
                <th>Fecha Programada</th>
                <th>Responsable</th>
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
                    <td>{{ $mantenimiento->responsable ?? '—' }}</td>
                    <td>{{ ucfirst($mantenimiento->estado) }}</td>
                    <td>
                        <a href="{{ route('mantenimientos.show', $mantenimiento) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</a>
                        <a href="{{ route('mantenimientos.edit', $mantenimiento) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Editar</a>
                        <form action="{{ route('mantenimientos.destroy', $mantenimiento) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')"><i class="fa fa-trash-o"></i> Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

