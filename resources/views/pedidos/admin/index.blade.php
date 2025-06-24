<body class="display:flex;">
    <div class="sidebar">
        @extends('components.side_bar')
    </div>

<!-- Search Container -->
<section class="Contenedor_general" style="margin-left:40px;">
<div class="max-w-7xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Todos los Pedidos</h2>

    <table class="w-full border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Cliente</th>
                <th class="p-2">Email</th>
                <th class="p-2">Total</th>
                <th class="p-2">Estado</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ordenes as $orden)
            <tr class="border-t">
                <td class="p-2">{{ $pedido->id }}</td>
                <td class="p-2">{{ $pedido->nombre }} {{ $pedido->apellidos }}</td>
                <td class="p-2">{{ $pedido->email }}</td>
                <td class="p-2">S/ {{ number_format($pedido->total, 2) }}</td>
                <td class="p-2">
                    <form action="{{ route('pedidos.cambiarEstado', $pedido->id) }}" method="POST">
                        @csrf
                        <select name="estado" onchange="this.form.submit()" class="border rounded">
                            <option value="En proceso" {{ $pedido->estado == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                            <option value="Enviado" {{ $pedido->estado == 'Enviado' ? 'selected' : '' }}>Enviado</option>
                            <option value="Entregado" {{ $pedido->estado == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                        </select>
                    </form>
                </td>
                <td class="p-2">
                    <button onclick="document.getElementById('detalle-{{ $pedido->id }}').classList.toggle('hidden')" class="text-blue-600">Ver detalles</button>
                </td>
            </tr>
            <tr id="detalle-{{ $pedido->id }}" class="hidden">
                <td colspan="6" class="p-4 bg-gray-50">
                    <ul>
                        @foreach ($pedido->productos as $prod)
                        <li>- {{ $prod->producto->nombre }} x {{ $prod->cantidad }} (S/ {{ $prod->precio_unitario }})</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</section>