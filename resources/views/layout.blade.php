<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SGBMP - Sistema de Gestión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">SGBMP</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="/bienes" class="nav-link">Bienes</a></li>
                <li class="nav-item"><a href="#" class="nav-link disabled">Mantenimientos</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="container">
    @yield('content')
</main>

</body>
</html>
