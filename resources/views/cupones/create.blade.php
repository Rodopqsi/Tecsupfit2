<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex bg-white text-black min-h-screen">
  <div class="sidebar">
    @extends('components.side_bar')
  </div>

  <section class="Contenedor_general ml-12 px-6 w-full">
<div class="max-w-3xl mx-auto mt-10 bg-white p-8 shadow-md rounded-xl">
  <h2 class="text-2xl font-bold mb-6 text-gray-800">
    {{ isset($cupon) ? 'Editar Cupón' : 'Crear Cupón' }}
  </h2>

  <form method="POST" action="{{ isset($cupon) ? route('cupones.update', $cupon) : route('cupones.store') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if(isset($cupon)) @method('PUT') @endif

    <div>
      <label class="block text-gray-700 font-semibold mb-1">Código</label>
      <input name="codigo" value="{{ old('codigo', $cupon->codigo ?? '') }}"
             class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
             required>
    </div>

    <div>
      <label class="block text-gray-700 font-semibold mb-1">Tipo de Descuento</label>
      <select name="tipo_descuento"
              class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        <option value="fijo" {{ old('tipo_descuento', $cupon->tipo_descuento ?? '') === 'fijo' ? 'selected' : '' }}>Fijo</option>
        <option value="porcentaje" {{ old('tipo_descuento', $cupon->tipo_descuento ?? '') === 'porcentaje' ? 'selected' : '' }}>Porcentaje</option>
      </select>
    </div>

    <div>
      <label class="block text-gray-700 font-semibold mb-1">Descuento</label>
      <input type="number" step="0.01" name="descuento" value="{{ old('descuento', $cupon->descuento ?? '') }}"
             class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
             required>
    </div>

    <div>
      <label class="block text-gray-700 font-semibold mb-1">Stock</label>
      <input type="number" name="stock" value="{{ old('stock', $cupon->stock ?? '') }}"
             class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
             required>
    </div>

    <div>
      <label class="block text-gray-700 font-semibold mb-1">Precio mínimo</label>
      <input type="number" step="0.01" name="precio_minimo" value="{{ old('precio_minimo', $cupon->precio_minimo ?? '') }}"
             class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Fecha inicio</label>
        <input type="date" name="fecha_inicio"
               value="{{ old('fecha_inicio', isset($cupon) ? $cupon->fecha_inicio->format('Y-m-d') : '') }}"
               class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
               required>
      </div>

      <div>
        <label class="block text-gray-700 font-semibold mb-1">Fecha fin</label>
        <input type="date" name="fecha_fin"
               value="{{ old('fecha_fin', isset($cupon) ? $cupon->fecha_fin->format('Y-m-d') : '') }}"
               class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
               required>
      </div>
    </div>

    <div>
      <label class="block text-gray-700 font-semibold mb-1">Imagen</label>
      <input type="file" name="imagen" accept="image/*"
             class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <div class="flex justify-end">
      <button type="submit"
              class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
        {{ isset($cupon) ? 'Actualizar' : 'Crear' }}
      </button>
    </div>
  </form>
</div>
</section>
</body>
