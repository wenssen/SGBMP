@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1 class="display-4 mb-4">Portal de Gestión de Bienes</h1>
        <p class="lead">Sistema de Gestión de Bienes y Mantenimiento Preventivo.</p>

        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Bienes</h5>
                        <p class="card-text">Registra, edita y visualiza los bienes de tu organización.</p>
                        <a href="{{ route('bienes.index') }}" class="btn btn-primary w-100">Ver Bienes</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-3 mt-md-0">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Mantenimientos</h5>
                        <p class="card-text">Planifica tareas de mantenimiento preventivo.</p>
                        <a href="{{ route('mantenimientos.index') }}" class="btn btn-primary w-100">Ver Mantenimientos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
