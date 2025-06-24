<body>
    

<header>@component('components.navtecsupfit')@endcomponent</header>

<div class=" mx-auto px-4 py-10 bg-white w-full">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Nuestras Marcas</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($marcas as $marca)
            <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition">
                <div class="p-4 flex flex-col items-center">
                    <img src="{{ asset('images/marcas/' . $marca->imagen) }}"
                            alt="{{ $marca->nombre }}"
                            class="w-40 h-24 object-contain mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">{{ $marca->nombre }}</h2>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div>
    @component('components.footer')
    @endcomponent
</div>

</body>