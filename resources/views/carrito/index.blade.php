<header> 
    @component('components.navtecsupfit')
    @endcomponent
</header>
<div class=" mx-auto px-4  bg-white w-full" style="padding:5rem; min-height:800px;"  >
    <h2 class="text-2xl font-bold mb-6">Mi Carrito</h2>

    @if($carrito->isEmpty())
        <p class="text-gray-600">Tu carrito está vacío.</p>
    @else
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Tabla de productos -->
        <div class="w-full lg:w-3/4">

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 text-left">
                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                        <tr>
                            <th class="p-3">Producto</th>
                            <th class="p-3 text-center">Precio</th>
                            <th class="p-3 text-center">Cantidad</th>
                            <th class="p-3 text-center">Subtotal</th>
                            <th class="p-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carrito as $item)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3 text-gray-800">{{ $item->producto->nombre }}</td>
                            <td class="p-3 text-center">S/ {{ number_format($item->producto->precio_nuevo, 2) }}</td>
                            <td class="p-3 text-center">
                                <form action="{{ route('carrito.actualizar') }}" method="POST" class="inline-flex items-center justify-center">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $item->producto->id }}">
                                    <input type="number" name="cantidad" min="1" value="{{ $item->cantidad }}" class="w-16 border border-gray-300 rounded px-2 py-1 text-center">
                                    <button type="submit" class="ml-2 text-sm text-blue-600 hover:underline">Actualizar</button>
                                </form>
                            </td>
                            <td class="p-3 text-center">S/ {{ number_format($item->producto->precio_nuevo * $item->cantidad, 2) }}</td>
                            <td class="p-3 text-center">
                                <form action="{{ route('carrito.eliminar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $item->producto->id }}">
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">← Volver a productos</a>
    </div>
        </div>

        <!-- Resumen -->
        <div class="w-full lg:w-1/4 bg-gray-50 border border-gray-200 p-6 rounded shadow-sm">
            <h2 class="text-lg font-semibold mb-4">Resumen</h2>
            <div class="mb-2 flex justify-between">
                <span>Subtotal:</span>
                <span class="font-medium">S/ {{ number_format($total, 2) }}</span>
            </div>
            <div class="mb-6 flex justify-between font-bold text-lg">
                <span>Total:</span>
                <span>S/ {{ number_format($total, 2) }}</span>
            </div>
            <a href="{{ route('checkout') }}" class="block text-center bg-black text-white py-2 rounded hover:bg-gray-800">
                Finalizar compra
            </a>
        </div>
    </div>
    @endif
    <div>
        <a href="mis-pedidos" style="background-color:red;">Ver Pedidos</a>
    </div>
</div>



@extends('components.footer')
