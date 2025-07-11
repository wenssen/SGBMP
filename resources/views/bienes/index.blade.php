@extends('layouts.layout')

@section('content')
    <h2 class="mb-4">Listado de Bienes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if(esAdmin())
        <div class="mb-3 d-flex gap-2">
            <a href="{{ route('bienes.create') }}" class="btn btn-success">Agregar Bien</a>
            <a href="{{ route('bienes.import.form') }}" class="btn btn-secondary">📁 Importar desde Excel</a>
        </div>
    @endif

    {{-- Formulario de filtros --}}
    <form method="GET" action="{{ route('bienes.index') }}" class="row g-3 mb-3">
        <div class="col-md-3">
            <input type="text" name="nombre" value="{{ request('nombre') }}" class="form-control" placeholder="Buscar por nombre">
        </div>

        <div class="col-md-3">
            <select name="categoria" class="form-select">
                <option value="">-- Categoría --</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria }}" {{ request('categoria') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="ubicacion" class="form-select">
                <option value="">-- Ubicación --</option>
                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion }}" {{ request('ubicacion') == $ubicacion ? 'selected' : '' }}>{{ $ubicacion }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 d-flex">
            <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="form-control me-2" placeholder="Desde">
            <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="form-control" placeholder="Hasta">
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('bienes.index') }}" class="btn btn-secondary ms-2">Limpiar</a>
        </div>
    </form>

    @php
        function sortLink($column, $label, $sort, $direction) {
            $dir = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';
            $icon = '';
            if ($sort === $column) {
                $icon = $direction === 'asc' ? '↑' : '↓';
            }
            $query = array_merge(request()->except('page'), ['sort' => $column, 'direction' => $dir]);
            $url = route('bienes.index', $query);
            return "<a href=\"$url\" class=\"text-reset text-decoration-none\">$label $icon</a>";
        }
    @endphp

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{!! sortLink('nombre', 'Nombre', $sort, $direction) !!}</th>
                <th>{!! sortLink('categoria', 'Categoría', $sort, $direction) !!}</th>
                <th>{!! sortLink('ubicacion', 'Ubicación', $sort, $direction) !!}</th>
                <th>{!! sortLink('fecha_adquisicion', 'Adquisición', $sort, $direction) !!}</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bienes as $bien)
                <tr>
                    <td>{{ $bien->nombre }}</td>
                    <td>{{ $bien->categoria }}</td>
                    <td>{{ $bien->ubicacion }}</td>
                    <td>{{ $bien->fecha_adquisicion }}</td>
                    <td>
                        <a href="{{ route('bienes.show', $bien->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</a>

                        @if (esAdmin())
                            <a href="{{ route('bienes.edit', $bien->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Editar</a>
                            <form action="{{ route('bienes.destroy', $bien->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este bien?')"><i class="fa fa-trash"></i> Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay bienes registrados aún.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginación con filtros activos --}}
    {{ $bienes->links() }}
@endsection

