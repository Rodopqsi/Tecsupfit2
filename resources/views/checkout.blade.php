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

<div style="display:flex; padding:5rem; justify-content:center; gap:5rem; flex-wrap:wrap;">
  <!-- FORMULARIO DE FACTURACIÓN -->
  <div>
    <h2 class="text-xl font-bold mb-4">Detalles de facturación</h2>

    <!-- Aplicar cupón -->
    <form action="{{ route('carrito.aplicar-cupon') }}" method="POST" class="mb-6">
  @csrf
  <label class="block mb-2 font-semibold text-gray-700">¿Tienes un cupón?</label>
  
  <div class="flex items-center gap-2">
    <input type="text" name="cupon"
            value="{{ old('cupon') }}"
            class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Ingresa tu cupón" required>
    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
      Aplicar
    </button>
  </div>

  @if(session('success'))
    <p class="mt-2 text-green-600">{{ session('success') }}</p>
  @endif

  @if(session('error'))
    <p class="mt-2 text-red-600">{{ session('error') }}</p>
  @endif

  @error('cupon')
    <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
  @enderror
</form>

    <!-- Formulario de datos del cliente -->
    <form id="formulario-pago" class="space-y-4" method="POST">
      @csrf
      <section class="max-w-xl p-6 rounded shadow space-y-4 bg-gray-100">

        <script>
      const ubigeo = {
    
      "Lima": ["Lima", "Ate", "Callao", "San Isidro", "Miraflores", "Comas", "Los Olivos", "Surco", "San Borja", "Villa El Salvador", "Villa María del Triunfo", "San Juan de Lurigancho", "San Juan de Miraflores", "Chorrillos", "Barranco", "La Molina", "Jesús María", "Pueblo Libre"],
    "Arequipa": ["Arequipa", "Cayma", "Cerro Colorado", "Mariano Melgar", "Yanahuara", "José Luis Bustamante y Rivero", "Miraflores", "Paucarpata", "Hunter"],
    "Cusco": ["Cusco", "San Jerónimo", "Wanchaq", "Santiago", "San Sebastián", "Poroy", "Saylla"],
    "La Libertad": ["Trujillo", "Florencia de Mora", "El Porvenir", "La Esperanza", "Víctor  Larco", "Huanchaco", "Moche", "Salaverry"],
    "Piura": ["Piura", "Sullana", "Talara", "Paita", "Catacaos", "Sechura", "La Unión", "Tambogrande"],
    "Junín": ["Huancayo", "El Tambo", "Chilca", "Huayucachi", "Sicaya", "Pilcomayo", "Chongos  Bajo"],
    "Lambayeque": ["Chiclayo", "José Leonardo Ortiz", "La Victoria", "Lambayeque", "Ferreñafe", "Pimentel"],
    "Tacna": ["Tacna", "Alto de la Alianza", "Ciudad Nueva", "Gregorio Albarracín"],
    "Puno": ["Puno", "Juliaca", "Azángaro", "Ilave", "Ayaviri"],
    "Ancash": ["Chimbote", "Huaraz", "Nuevo Chimbote", "Casma", "Caraz"],
    "Ica": ["Ica", "Chincha Alta", "Pisco", "Nazca", "Palpa"],
    "Callao": ["Callao", "Bellavista", "La Perla", "Carmen de La Legua", "Ventanilla", "Mi Perú"],
    "San Martín": ["Tarapoto", "Moyobamba", "Lamas", "Bellavista", "Juanjuí"],
    "Loreto": ["Iquitos", "Punchana", "Belén", "San Juan Bautista", "Nauta"],
    "Ucayali": ["Pucallpa", "Yarinacocha", "Manantay"],
    "Madre de Dios": ["Puerto Maldonado", "Tambopata", "Inambari"],

        "Huánuco": ["Huánuco", "Tingo María", "La Unión", "Ambo", "Panao"],
        "Apurímac": ["Abancay", "Andahuaylas", "Aymaraes", "Antabamba"],
        "Ayacucho": ["Ayacucho", "Huamanga", "Cangallo", "Huanta"],
        "Cajamarca": ["Cajamarca", "Jaén", "San Ignacio", "Celendín"],
        "Pasco": ["Pasco", "Oxapampa", "Villa Rica"],
        "Tumbes": ["Tumbes", "Zarumilla", "Contralmirante Villar"]
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

        <input type="hidden" name="monto_total" value="{{ $totalConDescuento }}">
        <input type="hidden" name="estado_pago" value="Pagado">
      </section>
    </form>
  </div>

  <!-- RESUMEN DE PEDIDO -->
  <div style="width:auto;">
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

        @if(session('cupones'))
          <div class="space-y-2">
            @foreach(session('cupones') as $codigo => $cupon)
              <div class="flex justify-between items-center bg-green-100 border border-green-300 p-2 rounded">
                <span>
                  Cupón: <strong>{{ $codigo }}</strong> - Descuento: S/ {{ number_format($cupon['descuento'], 2) }}
                </span>
                <form method="POST" action="{{ route('carrito.remover-cupon') }}">
                  @csrf
                  <input type="hidden" name="codigo" value="{{ $codigo }}">
                  <button type="submit" class="ml-4 text-red-600 hover:underline text-sm">Quitar</button>
                </form>
              </div>
            @endforeach
          </div>
        @endif

        <div class="flex justify-between">
          <span>Subtotal</span>
          <span>S/ {{ number_format($total, 2) }}</span>
        </div>

        <!-- Radios de envío con valores numéricos -->
        <div class="mt-2">
          <p class="font-bold">Envío</p>
          <label><input type="radio" name="envio" value="15" checked> Olva (S/15.00)</label><br>
          <label><input type="radio" name="envio" value="0"> Retiro en tienda</label>
        </div>

        <!-- Total a pagar visual y oculto -->
        <div class="flex justify-between border-t pt-2 mt-2">
          <span class="font-bold text-lg">Total a pagar</span>
          <span id="total-a-pagar" class="text-red-600 font-bold text-lg">
            S/ {{ number_format($totalConDescuento + 15, 2) }}
          </span>
        </div>

        <!-- Input oculto con total base -->
        <input type="hidden" id="total-base" value="{{ $totalConDescuento }}">

      @endif


    <!-- PayPal Button -->
   <!-- PayPal Button -->
<div class="mt-6" id="paypal-button-container"></div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="envio"]');
    const totalSpan = document.getElementById('total-a-pagar');
    const totalBase = parseFloat(document.getElementById('total-base').value);

    function actualizarTotal() {
      const envio = parseFloat(document.querySelector('input[name="envio"]:checked').value);
      const total = totalBase + envio;
      totalSpan.textContent = S/ ${total.toFixed(2)};
    }

    radios.forEach(radio => {
      radio.addEventListener('change', actualizarTotal);
    });

    actualizarTotal(); // Ejecutar al cargar
  });
</script>

<script src="https://www.paypal.com/sdk/js?client-id=AUBcJCnp5qlm26Nx4UMFg5b_iGTKLHRcOdYVyEf485Gs0r4p91bFecfuOWdNur02cXi2HHXaN4OAAHAL&currency=USD&components=buttons,funding-eligibility"></script>

<script>
paypal.Buttons({
  
  funding: {
    allowed: [paypal.FUNDING.PAYPAL, paypal.FUNDING.CARD]
  },
  createOrder: function(data, actions) {
  const totalBase = parseFloat(document.getElementById('total-base').value);
  const envio = parseFloat(document.querySelector('input[name="envio"]:checked').value);
  const total = (totalBase + envio).toFixed(2);

  return actions.order.create({
    purchase_units: [{
      amount: {
        value: total
      }
    }]
  });
},

  onApprove: function(data, actions) {
    return actions.order.capture().then(function(details) {
      const form = document.getElementById('formulario-pago');
      const formData = new FormData(form);

      // Adjunta el ID de la orden de PayPal al formData
      formData.append('paypal_order_id', details.id);

      fetch("{{ route('procesar.pago') }}", {
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        },
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success && data.redirect_url) {
          window.location.href = data.redirect_url;
        } else {
          alert(data.message || "Ocurrió un error al procesar el pedido.");
        }
      })
      .catch(error => {
        alert("Ocurrió un error al guardar el pedido.");
      });
    });
  }
}).render('#paypal-button-container');
</script>


  </div>
</div>

<footer class="mt-12">
@extends('components.footer')
</footer>

</body>
</html>