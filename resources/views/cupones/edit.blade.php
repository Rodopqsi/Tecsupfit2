
<div class="max-w-4xl mx-auto mt-10 bg-white p-8 shadow-md rounded-xl">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Cupón</h2>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 text-red-700 p-4 rounded-md">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cupones.update', $cupon) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="codigo">Código</label>
            <input type="text" name="codigo" id="codigo" value="{{ old('codigo', $cupon->codigo) }}" required
                   class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="descuento">Descuento</label>
            <input type="number" name="descuento" id="descuento" value="{{ old('descuento', $cupon->descuento) }}" step="0.01" required
                   class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="tipo_descuento">Tipo de Descuento</label>
            <select name="tipo_descuento" id="tipo_descuento" required
                    class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="fijo" {{ old('tipo_descuento', $cupon->tipo_descuento) == 'fijo' ? 'selected' : '' }}>Fijo</option>
                <option value="porcentaje" {{ old('tipo_descuento', $cupon->tipo_descuento) == 'porcentaje' ? 'selected' : '' }}>Porcentaje</option>
            </select>
        </div>
        <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Imagen</label>
        <input type="file" name="imagen" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
    </div>
    <div class="mb-4">
        <label>Precio mínimo</label>
        <input type="number" step="0.01" name="precio_minimo" value="{{ old('precio_minimo', $cupon->precio_minimo ?? '') }}" class="w-full border p-2 rounded">
      </div>
    <div class="mb-4">
        <label>Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $cupon->stock ?? '') }}" class="w-full border p-2 rounded" required>
      </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio', $cupon->fecha_inicio->format('Y-m-d')) }}" required
                       class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="fecha_fin">Fecha de Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin', $cupon->fecha_fin->format('Y-m-d')) }}" required
                       class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('cupones.index') }}" class="text-gray-600 hover:text-blue-500">← Cancelar</a>
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Actualizar Cupón
            </button>
        </div>
    </form>
</div>

