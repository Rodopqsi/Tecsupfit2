<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmación de Reclamo</title>
</head>
<body>
    <h2>Hola {{ $reclamacion->nombres }},</h2>

    <p>Hemos recibido tu reclamo con los siguientes detalles:</p>

    <ul>
        <li><strong>Número de documento:</strong> {{ $reclamacion->numero_documento }}</li>
        <li><strong>Producto:</strong> {{ $reclamacion->producto }}</li>
        <li><strong>Detalle:</strong> {{ $reclamacion->detalle_reclamo }}</li>
    </ul>

    <p>Nos comunicaremos contigo dentro de los próximos 15 días hábiles.</p>

    <p>Gracias por contactarnos.<br>
    <strong>Equipo TecsupFit</strong></p>
</body>
</html>
