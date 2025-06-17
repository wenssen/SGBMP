@extends('layout')

@section('content')
    <h2 class="mb-4">Listado de Bienes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('bienes.create') }}" class="btn btn-success mb-3">Agregar Bien</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Ubicación</th>
                <th>Adquisición</th>
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
                        <a href="{{ route('bienes.show', $bien->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</a>
                        <a href="{{ route('bienes.edit', $bien->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                        <form action="{{ route('bienes.destroy', $bien->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
			<button class="btn btn-danger btn-sm" onclick="return confirm('�Eliminar este bien?')"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay bienes registrados aún.</td>
                </tr>
            @endforelse

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </tbody>
    </table>
@endsection
