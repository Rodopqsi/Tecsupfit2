<head>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex bg-white text-black min-h-screen">

    @include('components.side_bar')


  <section class="Contenedor_general ml-12 px-6 w-full">
    <h2 class="text-2xl font-bold text-black mb-6 mt-8" >Administrar Cupones</h2>

    <div class="py-6 max-w-7xl mx-auto">
      <a href="{{ route('cupones.create') }}"
          class="inline-block mb-6 bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg shadow transition transform hover:scale-105">
          Crear Cupón
      </a>

      <div class="overflow-x-auto bg-white border border-gray-300 shadow-lg rounded-lg">
        <table class="min-w-full text-sm text-left">
          <thead class="bg-black text-white">
            <tr>
              <th class="p-3 font-semibold">Imagen</th>
              <th class="p-3 font-semibold">Código</th>
              <th class="p-3 font-semibold">Descuento</th>
              <th class="p-3 font-semibold">Tipo</th>
              <th class="p-3 font-semibold">Stock</th>
              <th class="p-3 font-semibold">Validez</th>
              <th class="p-3 font-semibold text-center">Acciones</th>
            </tr>
          </thead>
          <tbody class="text-gray-800">
            @foreach($cupones as $cupon)
              <tr class="border-t hover:bg-gray-100 transition">
                <td class="p-3">
                @if($cupon->imagen)
                    <img src="{{ asset($cupon->imagen) }}" alt="Imagen del cupón" class="mb-3 w-full h-48 object-cover rounded">
                @endif
                </td>
                <td class="p-3">{{ $cupon->codigo }}</td>
                <td class="p-3">S/ {{ number_format($cupon->descuento, 2) }}</td>
                <td class="p-3 capitalize">{{ $cupon->tipo_descuento }}</td>
                <td class="p-3">{{ $cupon->stock }}</td>
                <td class="p-3">{{ $cupon->fecha_inicio }}<br>{{ $cupon->fecha_fin }}</td>
                <td class="p-3 text-center space-x-2">
                  <a href="{{ route('cupones.edit', $cupon->id) }}"
                      class="inline-block px-3 py-1 bg-black hover:bg-gray-800 text-white rounded text-sm transition">
                    Editar
                  </a>
                  <form method="POST" action="{{ route('cupones.destroy', $cupon->id) }}" class="inline-block"
                        onsubmit="return confirm('¿Estás seguro de eliminar este cupón?');">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm transition">
                      Eliminar
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
</body>
