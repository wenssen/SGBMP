@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Perfil</h1>

    <div class="card p-4 mb-4">
        <p><strong>Bienvenido:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Correo:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Rol actual:</strong> {{ Auth::user()->rol }}</p>
    </div>

    {{-- Sección para editar información del perfil --}}
    <div class="card p-4 mb-4">
        <h5 class="mb-3">Editar información del perfil</h5>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required autofocus>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>

    {{-- Sección para cambiar la contraseña --}}
    <div class="card p-4 mb-4">
        <h5 class="mb-3">Cambiar contraseña</h5>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="current_password" class="form-label">Contraseña actual</label>
                <input id="current_password" name="current_password" type="password" class="form-control" required autocomplete="current-password">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Nueva contraseña</label>
                <input id="password" name="password" type="password" class="form-control" required autocomplete="new-password">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-warning">Actualizar contraseña</button>
        </form>
    </div>

    {{-- Sección para eliminar cuenta --}}
    <div class="card p-4 mb-4">
        <h5 class="mb-3 text-danger">Eliminar cuenta</h5>
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div class="mb-3">
                <label for="password" class="form-label">Confirma tu contraseña</label>
                <input id="password" name="password" type="password" class="form-control" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn btn-danger">Eliminar cuenta</button>
        </form>
    </div>
</div>
@endsection

