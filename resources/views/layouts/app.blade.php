<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SGBMP') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
    {{-- Navegación --}}
    @include('layouts.navigation')

    {{-- Encabezado (si existe) --}}
    @isset($header)
        <header class="bg-light border-bottom py-3 mb-4">
            <div class="container">
                <h1 class="h4 mb-0">{{ $header }}</h1>
            </div>
        </header>
    @endisset

    {{-- Contenido principal --}}
    <main class="container py-4">
        @yield('content')
    </main>
</body>
</html>

