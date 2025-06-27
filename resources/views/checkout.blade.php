<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-black">

<header>
  @component('components.navtecsupfit') 
  @endcomponent
</header>

<!-- CONTENEDOR FLEX -->
<div style="display:flex; padding:5rem; justify-content:center; gap:5rem; flex-wrap:wrap;">

  <!-- FORMULARIO DE FACTURACIÓN -->
  <div>
    <h2 class="text-xl font-bold mb-4">Detalles de facturación</h2>

    <!-- Aplicar cupón -->
    <form action="{{ route('carrito.aplicar-cupon') }}" method="POST" class="mb-4">
      @csrf
      <label class="block mb-2 font-bold">¿Tienes un cupón?</label>
      <input type="text" name="cupon" class="border p-2 rounded w-1/2" placeholder="Ingresa tu cupón">
      <button type="submit" class="ml-2 bg-blue-600 text-white px-4 py-2 rounded">Aplicar cupón</button>
    </form>

    <!-- Formulario de datos del cliente (para PayPal) -->
    <form id="formulario-pago" class="space-y-4" method="POST">
      @csrf
      <section class="max-w-xl p-6 rounded shadow space-y-4 bg-gray-100">

        <script>
          const ubigeo = {
            "Lima": ["Lima", "Ate", "Callao", "San Isidro", "Miraflores", "Comas", "Los Olivos", "Surco", "San Borja", "Villa El Salvador", "Villa María del Triunfo", "San Juan de Lurigancho", "San Juan de Miraflores", "Chorrillos", "Barranco", "La Molina", "Jesús María", "Pueblo Libre"],
            "Arequipa": ["Arequipa", "Cayma", "Cerro Colorado", "Mariano Melgar", "Yanahuara", "José Luis Bustamante y Rivero", "Miraflores", "Paucarpata", "Hunter"],
            "Cusco": ["Cusco", "San Jerónimo", "Wanchaq", "Santiago", "San Sebastián", "Poroy", "Saylla"]
          };

          window.addEventListener('DOMContentLoaded', () => {
            const regionSelect = document.querySelector('select[name="region"]');
            const distritoSelect = document.querySelector('select[name="distrito"]');

            regionSelect.innerHTML = '<option value="">Selecciona una región</option>';
            for (const region in ubigeo) {
              const option = document.createElement('option');
              option.value = region;
              option.textContent = region;
              regionSelect.appendChild(option);
            }

            regionSelect.addEventListener('change', () => {
              const region = regionSelect.value;
              distritoSelect.innerHTML = '<option value="">Selecciona un distrito</option>';
              if (ubigeo[region]) {
                ubigeo[region].forEach(distrito => {
                  const option = document.createElement('option');
                  option.value = distrito;
                  option.textContent = distrito;
                  distritoSelect.appendChild(option);
                });
              }
            });
          });
        </script>

        <div class="flex gap-4">
          <input type="text" name="nombre" placeholder="Nombre" class="border w-1/2 p-2" required>
          <input type="text" name="apellidos" placeholder="Apellidos" class="border w-1/2 p-2" required>
        </div>
        <input type="text" name="dni" placeholder="DNI" class="border w-full p-2" required>
        <select name="region" class="border w-full p-2" required></select>
        <select name="distrito" class="border w-full p-2" required></select>
        <input type="text" name="direccion" placeholder="Dirección de la calle" class="border w-full p-2">
        <input type="text" name="departamento" placeholder="Departamento, habitación, etc." class="border w-full p-2">
        <input type="text" name="telefono" placeholder="Teléfono" class="border w-full p-2">
        <input type="email" name="email" placeholder="Correo electrónico" class="border w-full p-2">
        <textarea name="notas" class="border w-full p-2" placeholder="Notas del pedido (opcional)"></textarea>

      </section>
    </form>
  </div>

  <!-- RESUMEN DE PEDIDO -->
  <div>
    
    <h2 class="text-xl font-bold mb-4">Su pedido</h2>
    <div class="border p-4 space-y-4">
      @if(session('success'))
        <p>{{ session('success') }}</p>
      @endif

      @if(empty($carrito))
        <p>El carrito está vacío.</p>
      @else
        @foreach($carrito as $id => $item)
        <div style="display:flex; width:300px; justify-content:space-between;">
          <span>{{ $item['nombre'] }}</span>
          <span class="font-semibold">S/ {{ $item['precio'] }}</span>
        </div>
        @endforeach

        @if(session('cupon_codigo'))
        <p class="text-green-600">Cupón aplicado: {{ session('cupon_codigo') }} - Descuento: S/ {{ number_format($descuento, 2) }}</p>
        @endif

        <div class="flex justify-between">
          <span>Subtotal</span>
          <span>S/ {{ number_format($total, 2) }}</span>
        </div>

        <div class="mt-2">
          <p class="font-bold">Envío</p>
          <label><input type="radio" name="envio" checked> Olva (S/15.00)</label><br>
          <label><input type="radio" name="envio"> Shalom (Pago en destino)</label>
        </div>
          
        <div class="flex justify-between border-t pt-2 mt-2">
          <span class="font-bold text-lg">Total a pagar</span>
          <span class="text-red-600 font-bold text-lg">S/ {{ number_format($totalConDescuento, 2) }}</span>
        </div>
      @endif
    </div>

    <!-- PayPal Button -->
    <div class="mt-6" id="paypal-button-container"></div>

    <script src="https://www.paypal.com/sdk/js?client-id=AUBcJCnp5qlm26Nx4UMFg5b_iGTKLHRcOdYVyEf485Gs0r4p91bFecfuOWdNur02cXi2HHXaN4OAAHAL&currency=USD"></script>
    <script>
    paypal.Buttons({
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: "{{ number_format($totalConDescuento, 2, '.', '') }}"
            }
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          const form = document.getElementById('formulario-pago');
          const formData = new FormData(form);

          fetch("{{ route('procesar.pago') }}", {
            method: "POST",
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
          })
          .then(response => {
            if (response.redirected) {
              window.location.href = response.url;
            } else {
              return response.json();
            }
          })
          .then(data => {
            if (data?.success) {
              alert("Gracias por tu compra, " + details.payer.name.given_name + "!");
            }
          })
          .catch(error => {
            console.error("Error al procesar el pago:", error);
            alert("Ocurrió un error al guardar el pedido.");
          });
        });
      }
    }).render('#paypal-button-container');
    </script>
  </div>

</div> <!-- FIN CONTENEDOR -->

<!-- FOOTER -->
<footer class="mt-12">
  @include('components.footer')
</footer>

</body>
</html>