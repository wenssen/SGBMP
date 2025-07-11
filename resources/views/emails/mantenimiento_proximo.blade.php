<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mantenimiento próximo</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2>⚠️ Mantenimiento próximo</h2>

    <p><strong>Bien:</strong> {{ $mantenimiento->bien->nombre ?? 'N/A' }}</p>
    <p><strong>Tipo:</strong> {{ $mantenimiento->tipo }}</p>
    <p><strong>Fecha programada:</strong> {{ \Carbon\Carbon::parse($mantenimiento->fecha_programada)->format('d-m-Y') }}</p>
    <p><strong>Responsable:</strong> {{ $mantenimiento->responsable ?? 'Sin asignar' }}</p>

    <p>Por favor, asegúrese de revisar y realizar este mantenimiento en el plazo correspondiente.</p>
</body>
</html>

