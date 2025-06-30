
  <div class="py-6 max-w-2xl mx-auto sm:px-6 lg:px-8">
    <form method="POST" action="{{ isset($cupon) ? route('cupones.update', $cupon) : route('cupones.store') }}" enctype="multipart/form-data">
      @csrf
      @if(isset($cupon)) @method('PUT') @endif

      <div class="mb-4">
        <label>Código</label>
        <input name="codigo" value="{{ old('codigo', $cupon->codigo ?? '') }}" class="w-full border p-2 rounded" required>
      </div>
      
      <div class="mb-4">
        <label>Tipo de Descuento</label>
        <select name="tipo_descuento" class="w-full border p-2 rounded">
          <option value="fijo" {{ old('tipo_descuento', $cupon->tipo_descuento ?? '') === 'fijo' ? 'selected' : '' }}>Fijo</option>
          <option value="porcentaje" {{ old('tipo_descuento', $cupon->tipo_descuento ?? '') === 'porcentaje' ? 'selected' : '' }}>Porcentaje</option>
        </select>
      </div>
      <div class="mb-4">
        <label>Descuento</label>
        <input type="number" step="0.01" name="descuento" value="{{ old('descuento', $cupon->descuento ?? '') }}" class="w-full border p-2 rounded" required>
      </div>


      <div class="mb-4">
        <label>Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $cupon->stock ?? '') }}" class="w-full border p-2 rounded" required>
      </div>

      <div class="mb-4">
        <label>Precio mínimo</label>
        <input type="number" step="0.01" name="precio_minimo" value="{{ old('precio_minimo', $cupon->precio_minimo ?? '') }}" class="w-full border p-2 rounded">
      </div>

      <div class="mb-4">
        <label>Fecha inicio</label>
        <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', isset($cupon) ? $cupon->fecha_inicio->format('Y-m-d') : '') }}" class="w-full border p-2 rounded" required>
      </div>

      <div class="mb-4">
        <label>Fecha fin</label>
        <input type="date" name="fecha_fin" value="{{ old('fecha_fin', isset($cupon) ? $cupon->fecha_fin->format('Y-m-d') : '') }}" class="w-full border p-2 rounded" required>
      </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Imagen</label>
            <input type="file" name="imagen" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
        </div>

      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
        {{ isset($cupon) ? 'Actualizar' : 'Crear' }}
      </button>
    </form>
  </div>
