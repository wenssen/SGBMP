@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Importar Bienes desde Excel</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('bienes.import.excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="archivo" class="form-label">Archivo Excel (.xlsx)</label>
            <input type="file" name="archivo" id="archivo" class="form-control" required accept=".xlsx,.xls">
        </div>
        <button type="submit" class="btn btn-primary">Importar</button>
        <a href="{{ route('bienes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

