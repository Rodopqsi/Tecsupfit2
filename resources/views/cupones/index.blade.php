<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Administrar Cupones</h2>
  </x-slot>

  <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <a href="{{ route('cupones.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded">Crear Cupón</a>

    <table class="w-full border text-left">
      <thead>
        <tr class="bg-gray-200">
          <th class="p-2">Código</th>
          <th>Descuento</th>
          <th>Tipo</th>
          <th>Stock</th>
          <th>Validez</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cupones as $cupon)
          <tr class="border-t">
            <td class="p-2">{{ $cupon->codigo }}</td>
            <td>{{ $cupon->descuento }}</td>
            <td>{{ ucfirst($cupon->tipo_descuento) }}</td>
            <td>{{ $cupon->stock }}</td>
            <td>{{ $cupon->fecha_inicio }} - {{ $cupon->fecha_fin }}</td>
            <td>
              <a href="{{ route('cupones.edit', $cupon->id) }}" class="text-blue-600">Editar</a>
              <form method="POST" action="{{ route('cupones.destroy', $cupon->id) }}" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600 ml-2">Eliminar</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</x-app-layout>