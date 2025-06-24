<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Lista de Objetivos</h1>

    <div class="space-y-4">
        @foreach($objetivos as $objetivo)
        <div x-data="{ open: false }" class="border border-gray-300 rounded shadow">
            <button @click="open = !open" class="w-full text-left px-4 py-3 bg-gray-100 hover:bg-gray-200 focus:outline-none">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold">{{ $objetivo->nombre }}</span>
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                </div>
                <p class="text-sm text-gray-600">{{ $objetivo->descripcion }}</p>
            </button>
            <div x-show="open" x-collapse class="p-4 space-y-2 bg-white">
                @forelse($objetivo->productos as $producto)
                    <div class="border p-2 rounded shadow-sm">{{ $producto->nombre }}</div>
                @empty
                    <p class="text-gray-500">No hay productos asociados a este objetivo.</p>
                @endforelse
            </div>
        </div>
        @endforeach
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>