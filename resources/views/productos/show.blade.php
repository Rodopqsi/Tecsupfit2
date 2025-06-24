<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<header>@component('components.navtecsupfit') @endcomponent</header>
<div style="background-color:white; width=100%; padding:5rem;">
    <div style="
            display: flex;
            align-items: center;
            justify-content: space-around; margin-bottom:10rem;
        ">
        <div style="
                display: flex; flex-direction: column; align-items: center; min-width: 800px;padding-top: 10px;">
            <div>
                @if($producto->imagen)
                <img src="{{ asset('images/productos/' . $producto->imagen) }}" class="w-64 h-64 object-contain"
                    alt="{{ $producto->nombre }}" />
                @else
                <div class="w-64 h-64 flex items-center justify-center bg-gray-100 text-gray-400 mb-4 rounded">
                    <span>Sin imagen</span>
                </div>
                @endif
            </div>
            <div style="align-self: start" x-data="{ open: false }" class="w-full">
                <div class="mb-4 pt-20 w-full">
                    <button @click="open = !open"
                        class="font-semibold text-sm mb-2 bg-white-600 text-black px-4 py-2 rounded hover:bg-white-700 transition w-full text-left">
                        Descripción
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 ml-2 float-right"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 ml-2 float-right"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="mt-2 bg-gray-100 p-3 rounded text-sm text-gray-700 " style="width:800px;">
                        {{ $producto->descripcion }}
                    </div>
                </div>
            </div>
            <div style="align-self: start" x-data="{ open: false }" class="w-full">
                <div class="mb-4 w-full">
                    <button @click="open = !open"
                        class="font-semibold text-sm mb-2 bg-white-600 text-black px-4 py-2 rounded hover:bg-white-700 transition w-full text-left">
                        Envíos y Cobertura
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 ml-2 float-right"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 ml-2 float-right"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition class="mt-2 bg-gray-100 p-3 rounded text-sm text-gray-700" style="width:800px;">
                        Realizamos envíos rápidos a <strong>Lima Metropolitana</strong> y <strong>provincias</strong>.  
                        Nuestra cobertura incluye toda la <strong>costa del Perú</strong>.  
                        Para zonas rurales o alejadas, consulta nuestras opciones personalizadas de entrega.
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6" style="width: 487px; height: auto">
            <div class="flex flex-col items-center">
                <div class="w-full">
                    <span class="uppercase tracking-widest" style="font-size: 20px; color: A70608">{{
                        $producto->marca->nombre }}</span>
                    <h2 class="font-semibold mt-2 mb-2" style="font-size: 15px">
                        {{ $producto->nombre }}
                    </h2>
                    <span class=" " style="font-size: 11px; padding-bottom: 20px">{{ $producto->categoria->nombre
                        }}</span>

                    <div class="flex gap-2 mb-2">
                        @if($producto->es_delmes)
                        <span class="bg-yellow-300 text-yellow-900 text-xs px-2 py-1 rounded"
                            style="margin-top: 10px; margin-bottom: 10px">Del Mes</span>
                        @endif
                    </div>

                    <div class="mb-2 flex items-center gap-2">
                        <span class="text-sky-600 text-xl font-bold">S/ {{ number_format($producto->precio_nuevo, 2)
                            }}</span>

                        @if($producto->precio_antes)
                        <del class="text-gray-400 text-base">S/ {{ number_format($producto->precio_antes, 2)
                            }}</del>

                        @php $porcentaje = 100 - (($producto->precio_nuevo /
                        $producto->precio_antes) * 100); @endphp

                        <div class="ml-2 bg-red-600 text-white text-xs px-2 py-1 rounded-full">
                            -{{ number_format($porcentaje, 0) }}%
                        </div>
                        @endif
                    </div>

                    <div class="mb-2">
                        <span class="text-gray-600 text-sm">Quedan {{ $producto->stock->cantidad }}
                            unidades</span>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1 mb-1">
                            <div class="bg-gray-800 h-2 rounded-full"
                                style="width: {{ $producto->stock->stock_percentage }}%"></div>
                        </div>
                        @if($producto->stock->cantidad <= $producto->stock->stock_minimo)
                            <span class="text-yellow-600 text-xs">¡Stock bajo!</span>
                            @endif
                    </div>

                    @if($producto->stock->cantidad > 0)
                    <form action="{{ route('productos.comprar', $producto) }}" method="POST" class="mb-3">
                        @csrf
                        <div class="flex">
                            <input type="number" name="cantidad"
                                class="w-16 border border-gray-300 rounded-l px-2 py-2 text-center focus:outline-none"
                                min="1" max="{{ $producto->stock->cantidad }}" value="1" required />
                            <button type="submit"
                                class="flex-1 bg-red-700 hover:bg-red-800 text-white font-semibold py-2 rounded-r transition-colors">
                                Agregar al carrito
                            </button>
                        </div>
                    </form>
                    @else
                    <div class="bg-yellow-100 text-yellow-800 px-3 py-2 rounded mb-3 text-center">
                        Producto agotado
                    </div>
                    @endif @if($producto->ventas_mes > 0)
                    <div class="mt-3">
                        <span class="text-gray-400 text-xs">Ventas este mes: {{ $producto->ventas_mes }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mt-10">
    {{-- Valoración promedio --}}
    @php $promedio = $producto->opiniones->avg('valoracion'); @endphp
    <h2 class="text-2xl font-bold mb-4">Valoraciones</h2>

    <div class="mb-6">
        <p class="text-lg font-semibold">{{ $producto->opiniones->count() }} reseñas</p>
        <div class="flex items-center mb-4 text-yellow-500 text-2xl">
            @for ($i = 1; $i <= 5; $i++)
                <i class="fa{{ $i <= round($promedio) ? 's' : 'r' }} fa-star mr-1"></i>
            @endfor
            @if($promedio)
                <span class="ml-2 text-base text-gray-700">({{ number_format($promedio, 1) }}/5)</span>
            @endif
        </div>

        {{-- Barra de estrellas por puntuación --}}
        @for($i = 5; $i >= 1; $i--)
            @php
                $total = $producto->opiniones->count();
                $cantidad = $producto->opiniones->where('valoracion', $i)->count();
                $porcentaje = $total > 0 ? ($cantidad / $total) * 100 : 0;
            @endphp
            <div class="flex items-center gap-2 text-sm text-gray-700 mb-1">
                <span class="w-10">{{ $i }} <i class="fas fa-star text-yellow-500"></i></span>
                <div class="w-full bg-gray-200 h-3 rounded">
                    <div class="h-3 bg-yellow-400 rounded" style="width: {{ $porcentaje }}%"></div>
                </div>
                <span class="w-6 text-right">{{ $cantidad }}</span>
            </div>
        @endfor
    </div>

    {{-- Opiniones listadas --}}
    @foreach ($producto->opiniones as $opinion)
        <div class="mb-6 border-t pt-4">
            <div class="font-bold text-gray-800">{{ $opinion->user->name }}</div>
            <div class="flex items-center text-yellow-500 mb-1">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fa{{ $i <= $opinion->valoracion ? 's' : 'r' }} fa-star mr-1"></i>
                @endfor
            </div>
            <p class="text-gray-700">{{ $opinion->comentario }}</p>
            <small class="text-gray-500">{{ $opinion->created_at->diffForHumans() }}</small>
        </div>
    @endforeach

    {{-- Formulario de opinión --}}
    @auth
        <form action="{{ route('opiniones.store', $producto) }}" method="POST" class="mt-6 border-t pt-6 space-y-4">
            @csrf
            <label class="block font-semibold text-gray-800">Tu puntuación:</label>
            <select name="valoracion" required class="border rounded p-2 w-32">
                <option value="5">⭐⭐⭐⭐⭐</option>
                <option value="4">⭐⭐⭐⭐</option>
                <option value="3">⭐⭐⭐</option>
                <option value="2">⭐⭐</option>
                <option value="1">⭐</option>
            </select>

            <textarea name="comentario" placeholder="Escribe tu opinión..." required class="w-full border rounded p-2 h-28"></textarea>

            <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800">
                Enviar opinión
            </button>
        </form>
    @else
        <p class="text-gray-600 italic">Debes iniciar sesión para dejar una reseña.</p>
    @endauth
    <div class="mt-20">
    <h2 class="text-2xl font-bold mb-4">Productos relacionados</h2>
    <div x-data="{ scroll: $refs.carousel }" class="relative">
        <div class="overflow-x-auto whitespace-nowrap scroll-smooth no-scrollbar"style="display:flex;justify-content:center;" x-ref="carousel">
            @foreach ($relacionados as $relacionado)
                <a href="{{ route('productos.show', $relacionado) }}"
                    class="inline-block bg-white shadow-md rounded-lg m-2 p-3 w-64 hover:shadow-xl transition">
                    <img src="{{ asset('images/productos/' . $relacionado->imagen) }}"
                        alt="{{ $relacionado->nombre }}"
                        class="w-full h-40 object-contain mb-2">
                    <div class="text-center">
                        <h3 class="text-sm font-semibold text-gray-700">{{ $relacionado->nombre }}</h3>
                        <p class="text-sky-600 font-bold">S/ {{ number_format($relacionado->precio_nuevo, 2) }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Botones opcionales -->
        <button @click="scroll.scrollLeft -= 300"
                class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white shadow p-2 rounded-full">
            ‹
        </button>
        <button @click="scroll.scrollLeft += 300"
                class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white shadow p-2 rounded-full">
            ›
        </button>
    </div>
</div>

</div>

</div>
@extends('components.footer')

<style>
    .no-scrollbar::-webkit-scrollbar {
    display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

</style>