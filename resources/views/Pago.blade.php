
<div class="bg-white text-black p-6 max-w-7xl mx-auto mt-6 grid grid-cols-1 md:grid-cols-2 gap-8">
  <!-- Formulario -->
  <div>
    <h2 class="text-xl font-bold mb-4">Detalles de facturación</h2>
    <form class="space-y-4" action="{{ route('procesar.pago') }}" method="POST">
      @csrf
      {{-- Aquí los inputs de nombre, apellidos, dirección, etc. --}}
    </form>
  </div>

  <!-- Resumen del pedido -->
  <div>
    <h2 class="text-xl font-bold mb-4">Su pedido</h2>
    <div class="border p-4 space-y-4">
      @php $total = 0; @endphp
      @foreach($carrito as $id => $item)
        @php $subtotal = $item['precio'] * $item['cantidad']; $total += $subtotal; @endphp
        <div class="flex justify-between border-b pb-2">
          <span>{{ $item['nombre'] }} x{{ $item['cantidad'] }}</span>
          <span class="font-semibold">S/ {{ number_format($subtotal, 2) }}</span>
        </div>
      @endforeach
      <div class="flex justify-between border-t pt-2">
        <span class="font-bold text-lg">Total</span>
        <span class="text-red-600 font-bold text-lg">S/ {{ number_format($total, 2) }}</span>
      </div>
    </div>

    <!-- Botón de PayPal -->
    <div id="paypal-button-container" class="mt-4"></div>
  </div>
</div>

<!-- PayPal SDK con moneda -->
<script src="https://www.paypal.com/sdk/js?client-id=TU_CLIENT_ID&currency=PEN"></script>

<script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '{{ number_format($total, 2, ".", "") }}'
          },
          description: 'Compra de suplementos'
        }]
      });
    },
    onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
        alert('Gracias por tu compra, ' + details.payer.name.given_name + '!');
        window.location.href = '{{ route('gracias') }}';
      });
    }
  }).render('#paypal-button-container');
</script>


