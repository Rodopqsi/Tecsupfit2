<header>@component('components.navtecsupfit') @endcomponent</header>
<div class="max-w-7xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Mis Pedidos</h2>

    @if ($pedidos->count())
        @foreach ($ordenes as $orden)
            <div class="border rounded p-4 mb-4 bg-white">
                <h3 class="font-semibold">Pedido #{{ $pedido->id }} - Estado: {{ $pedido->estado }}</h3>
                <p>Total: S/ {{ number_format($pedido->total, 2) }}</p>
                <ul class="mt-2">
                    @foreach ($pedido->productos as $prod)
                        <li>- {{ $prod->producto->nombre }} x {{ $prod->cantidad }} (S/ {{ $prod->precio_unitario }})</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    @else
        <p>No tienes pedidos aún.</p>
    @endif
</div>
<div>
    @component('components.footer')
    @endcomponent
</div>