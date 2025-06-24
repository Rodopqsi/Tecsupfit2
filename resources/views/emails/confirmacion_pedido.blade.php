<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Pedido - TecsupFit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #333;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        h1 {
            color: #38bdf8;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .total {
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background-color: #f1f5f9;
        }

        .footer {
            margin-top: 30px;
            font-size: 13px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Gracias por tu compra, {{ $nombre }}!</h1>

        <p>Hemos recibido tu pedido correctamente. A continuación, te mostramos el resumen:</p>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant.</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto['nombre'] ?? 'Producto' }}</td>
                        <td>{{ $producto['cantidad'] }}</td>
                        <td>${{ number_format($producto['precio'], 2) }}</td>
                        <td>${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Total pagado: ${{ number_format($total, 2) }}</p>

        <p>Tu pedido está siendo procesado. Te notificaremos cuando se haya enviado.</p>

        <div class="footer">
            Si tienes dudas, contáctanos en soporte@tecsupfit.pe<br>
            TecsupFit © {{ date('Y') }}
        </div>
    </div>
</body>
</html>