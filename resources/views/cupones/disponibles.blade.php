<div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse($cupones as $cupon)
        <div class="p-4 border rounded shadow">
          <h3 class="text-lg font-semibold">Código: {{ $cupon->codigo }}</h3>
          <p>Descuento: {{ $cupon->descuento }} {{ $cupon->tipo_descuento === 'porcentaje' ? '%' : 'soles' }}</p>
          <p>Válido del {{ $cupon->fecha_inicio }} al {{ $cupon->fecha_fin }}</p>
          @if($cupon->imagen)
              <img src="{{ asset($cupon->imagen) }}" alt="Imagen del cupón" class="mb-3 w-full h-48 object-cover rounded">
          @endif
          <p>Stock restante: {{ $cupon->stock }}</p>
        </div>
        

      @empty
        <p>No hay cupones disponibles.</p>
      @endforelse
    </div>
  </div>