<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex bg-white text-black min-h-screen">
  <div class="sidebar">
    @extends('components.side_bar')
  </div>

  <section class="Contenedor_general ml-12 px-6 w-full">
<div class="max-w-3xl mx-auto mt-10 p-6 sm:p-10 bg-gradient-to-br from-blue-100 to-white shadow-xl rounded-2xl">
    <h2 class="text-3xl font-extrabold text-white-800 mb-8 text-center">Editar Cupón</h2>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 text-red-700 p-4 rounded-lg border border-red-300">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cupones.update', $cupon) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Código -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="codigo">Código</label>
            <input type="text" name="codigo" id="codigo" value="{{ old('codigo', $cupon->codigo) }}" required
                class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
        </div>

        <!-- Descuento -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="descuento">Descuento</label>
            <input type="number" name="descuento" id="descuento" value="{{ old('descuento', $cupon->descuento) }}" step="0.01" required
                class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
        </div>

        <!-- Tipo de descuento -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="tipo_descuento">Tipo de Descuento</label>
            <select name="tipo_descuento" id="tipo_descuento" required
                class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
                <option value="fijo" {{ old('tipo_descuento', $cupon->tipo_descuento) == 'fijo' ? 'selected' : '' }}>Fijo</option>
                <option value="porcentaje" {{ old('tipo_descuento', $cupon->tipo_descuento) == 'porcentaje' ? 'selected' : '' }}>Porcentaje</option>
            </select>
        </div>

        <!-- Imagen -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Imagen</label>
            <input type="file" name="imagen" accept="image/*"
                class="mt-1 w-full border border-gray-300 p-2 rounded-xl shadow-sm bg-white focus:outline-none">
        </div>

        <!-- Precio mínimo -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Precio mínimo</label>
            <input type="number" step="0.01" name="precio_minimo" value="{{ old('precio_minimo', $cupon->precio_minimo ?? '') }}"
                class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
        </div>

        <!-- Stock -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $cupon->stock ?? '') }}" required
                class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
        </div>

        <!-- Fechas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio', $cupon->fecha_inicio->format('Y-m-d')) }}" required
                    class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="fecha_fin">Fecha de Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin', $cupon->fecha_fin->format('Y-m-d')) }}" required
                    class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
            </div>
        </div>

        <!-- Botones -->
        <div class="flex justify-between items-center pt-6">
            <a href="{{ route('cupones.index') }}" class="text-blue-600 font-medium hover:underline">← Cancelar</a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl transition duration-300 shadow-md">
                Actualizar Cupón
            </button>
        </div>
    </form>
</div>
</section>
</body>
