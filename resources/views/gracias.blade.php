<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gracias por tu compra</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .checkmark {
      stroke-dasharray: 48;
      stroke-dashoffset: 48;
      animation: dash 1s ease forwards;
    }

    @keyframes dash {
      to {
        stroke-dashoffset: 0;
      }
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="max-w-2xl mx-auto mt-20 bg-white p-8 rounded shadow text-center">

    <!-- Check animado -->
    <svg class="mx-auto mb-6" width="80" height="80" viewBox="0 0 52 52">
      <circle cx="26" cy="26" r="25" fill="none" stroke="#22c55e" stroke-width="2"/>
      <path class="checkmark" fill="none" stroke="#22c55e" stroke-width="3" d="M14 27l7 7 17-17"/>
    </svg>

    <h1 class="text-3xl font-bold mb-2">¡Gracias por tu compra!</h1>
    <p class="text-gray-600 mb-2">Tu pedido ha sido registrado correctamente.</p>
    <p class="text-gray-600 mb-6">Hemos enviado un correo de confirmación a tu email.</p>

    <!-- Resumen del pedido -->
    @if(session('resumen_pedido'))
      <div class="text-left mt-6">
        <p class="mb-2"><strong>Número de orden:</strong> #{{ session('resumen_pedido.numero_orden') }}</p>
        <p class="mb-4"><strong>Fecha de compra:</strong> {{ session('resumen_pedido.fecha') }}</p>

        <h2 class="text-xl font-bold mb-3">Resumen del pedido</h2>
        <table class="w-full text-left border border-gray-300">
          <thead>
            <tr class="bg-gray-100">
              <th class="px-4 py-2 border">Producto</th>
              <th class="px-4 py-2 border">Cantidad</th>
              <th class="px-4 py-2 border">Precio</th>
            </tr>
          </thead>
          <tbody>
            @foreach(session('resumen_pedido.productos') as $producto)
              <tr>
                <td class="px-4 py-2 border">{{ $producto['nombre'] }}</td>
                <td class="px-4 py-2 border">{{ $producto['cantidad'] }}</td>
                <td class="px-4 py-2 border">S/ {{ number_format($producto['precio'] * $producto['cantidad'], 2) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="text-right mt-4 font-bold text-lg">
          Total pagado: S/ {{ number_format(session('resumen_pedido.total'), 2) }}
        </div>
      </div>
    @endif

    <a href="{{ route('home') }}" class="btn btn-primary">Volver al inicio</a>



  </div>

</body>
</html>