<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Reclamación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background-color:rgb(255, 255, 255);
            color: #111;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            height:100%;
            max-width: 720px;
            margin: 40px auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #d32f2f;
            border-left: 5px solid #d32f2f;
            padding-left: 1rem;
            margin-bottom: 1.5rem;
        }

        .field {
            margin-bottom: 1.2rem;
        }

        .field label {
            font-weight: 600;
            color: #000;
        }

        .field p {
            margin: 0.2rem 0 0;
            font-size: 1rem;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.9rem;
            color: #fff;
        }

        .badge.reclamo { background-color: #e53935; }
        .badge.queja { background-color: #ff7043; }

        .badge.pendiente { background-color: #fbc02d; }
        .badge.en_proceso { background-color: #29b6f6; }
        .badge.resuelto { background-color: #66bb6a; }
        .badge.cerrado { background-color: #9e9e9e; }

        .btn-back {
            display: inline-block;
            background-color: #d32f2f;
            color: white;
            padding: 0.6rem 1.2rem;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #b71c1c;
        }
    </style>
</head>
<body>
    <div>
        @include('components.side_bar')
    </div>
    <section class="Contenedor_general">
    <div class="container">
        <h1>Detalle de la Reclamación #{{ $reclamacion->id }}</h1>

        <div class="field">
            <label>Cliente:</label>
            <p>{{ $reclamacion->nombre_completo }}</p>
        </div>

        <div class="field">
            <label>Email:</label>
            <p>{{ $reclamacion->email }}</p>
        </div>

        <div class="field">
            <label>Documento:</label>
            <p>{{ strtoupper($reclamacion->tipo_documento) }} - {{ $reclamacion->numero_documento }}</p>
        </div>

        <div class="field">
            <label>Teléfono:</label>
            <p>{{ $reclamacion->telefono }}</p>
        </div>

        <div class="field">
            <label>Dirección:</label>
            <p>{{ $reclamacion->direccion }}</p>
        </div>

        <div class="field">
            <label>Producto(s):</label>
            <p>{{ $reclamacion->producto }}</p>
        </div>

        <div class="field">
            <label>Fecha de Compra:</label>
            <p>{{ $reclamacion->fecha_compra ?? 'No especificada' }}</p>
        </div>

        <div class="field">
            <label>Tipo de Reclamo:</label>
            <span class="badge {{ $reclamacion->tipo_reclamo }}">{{ ucfirst($reclamacion->tipo_reclamo) }}</span>
        </div>

        <div class="field">
            <label>Detalle del Reclamo:</label>
            <p>{{ $reclamacion->detalle_reclamo }}</p>
        </div>

        <div class="field">
            <label>Pedido del Cliente:</label>
            <p>{{ $reclamacion->pedido_cliente }}</p>
        </div>

        <div class="field">
            <label>Estado:</label>
            <span class="badge {{ $reclamacion->estado }}">{{ ucfirst($reclamacion->estado) }}</span>
        </div>

        @if($reclamacion->respuesta_empresa)
        <div class="field">
            <label>Respuesta de la Empresa:</label>
            <p>{{ $reclamacion->respuesta_empresa }}</p>
        </div>
        @endif

        <div class="field">
            <label>Fecha de Registro:</label>
            <p>{{ $reclamacion->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <a href="{{ route('reclamaciones.index') }}" class="btn-back">← Volver al listado</a>
    </div>
</section>
</body>
</html>
