@extends('layout')

@section('content')
    <h2 class="mb-4">Configuración de Bienes</h2>

    <p>Aquí podrás registrar nuevas opciones que aparecerán luego en los formularios:</p>

    <div class="row">
        <div class="col-md-4">
            <h4>Agregar nuevo nombre</h4>
            <form>
                <input type="text" name="nuevo_nombre" class="form-control mb-2" placeholder="Ej: Computador portátil">
                <button class="btn btn-primary w-100" disabled>Añadir (en desarrollo)</button>
            </form>
        </div>

        <div class="col-md-4">
            <h4>Nueva categoría</h4>
            <form>
                <input type="text" name="nueva_categoria" class="form-control mb-2" placeholder="Ej: Electrónica">
                <button class="btn btn-primary w-100" disabled>Añadir (en desarrollo)</button>
            </form>
        </div>

        <div class="col-md-4">
            <h4>Nueva ubicación</h4>
            <form>
                <input type="text" name="nueva_ubicacion" class="form-control mb-2" placeholder="Ej: Almacén 3">
                <button class="btn btn-primary w-100" disabled>Añadir (en desarrollo)</button>
            </form>
        </div>
    </div>
@endsection