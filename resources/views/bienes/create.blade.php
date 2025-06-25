@extends('layouts.layout')

@section('content')
    <h2 class="mb-4">Registrar nuevo Bien</h2>

    {{-- Mostrar errores si los hay --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bienes.store') }}" method="POST">
        @csrf

        {{-- NOMBRE DEL BIEN --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del bien</label>
            <select name="nombre" class="form-select" onchange="toggleInput(this, 'nuevo_nombre')">
                <option disabled selected>Selecciona un nombre</option>
                <option value="Escritorio">Escritorio</option>
                <option value="Silla">Silla</option>
                <option value="Computador">Computador</option>
                <option value="otro">Otro...</option>
            </select>
            <input type="text" name="nuevo_nombre" class="form-control mt-2 d-none" placeholder="Escribe un nuevo nombre">
        </div>

        {{-- CATEGORÍA --}}
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <select name="categoria" class="form-select" onchange="toggleInput(this, 'nueva_categoria')">
                <option disabled selected>Selecciona una categoría</option>
                <option value="Mobiliario">Mobiliario</option>
                <option value="Tecnología">Tecnología</option>
                <option value="Herramientas">Herramientas</option>
                <option value="otro">Otra...</option>
            </select>
            <input type="text" name="nueva_categoria" class="form-control mt-2 d-none" placeholder="Escribe una nueva categoría">
        </div>

        {{-- UBICACIÓN --}}
        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <select name="ubicacion" class="form-select" onchange="toggleInput(this, 'nueva_ubicacion')">
                <option disabled selected>Selecciona una ubicación</option>
                <option value="Bodega">Bodega</option>
                <option value="Oficina Central">Oficina Central</option>
                <option value="Sala de Servidores">Sala de Servidores</option>
                <option value="otro">Otra...</option>
            </select>
            <input type="text" name="nueva_ubicacion" class="form-control mt-2 d-none" placeholder="Escribe una nueva ubicación">
        </div>

        {{-- CANTIDAD --}}
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" min="1" required>
        </div>

        {{-- FECHA --}}
        <div class="mb-3">
            <label for="fecha_adquisicion" class="form-label">Fecha de adquisición</label>
            <input type="date" name="fecha_adquisicion" class="form-control">
        </div>

        {{-- DESCRIPCIÓN --}}
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"></textarea>
        </div>

        {{-- REQUIERE MANTENIMIENTO --}}
        <div class="mb-3">
            <label class="form-label">¿Requiere mantenimiento?</label><br>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="requiere_mantenimiento" id="requiere_si" value="1">
                <label class="form-check-label" for="requiere_si">Sí</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="requiere_mantenimiento" id="requiere_no" value="0" checked>
                <label class="form-check-label" for="requiere_no">No</label>
            </div>
        </div>

        {{-- BOTONES --}}
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('bienes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    {{-- SCRIPT PARA MOSTRAR INPUTS --}}
    <script>
        function toggleInput(select, inputName) {
            const input = document.querySelector(`[name="${inputName}"]`);
            if (select.value === 'otro') {
                input.classList.remove('d-none');
                input.required = true;
            } else {
                input.classList.add('d-none');
                input.required = false;
            }
        }
    </script>
@endsection

