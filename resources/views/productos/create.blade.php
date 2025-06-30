<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<section class="Contenedor_general">
@extends('components.side_bar')

<div class="max-w-5xl mx-auto mt-10 bg-white p-8 shadow-md rounded-xl">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Crear Producto</h1>

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label for="nombre" class="block text-gray-700 font-semibold mb-1">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required
                           class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="precio_nuevo" class="block text-gray-700 font-semibold mb-1">Precio Nuevo</label>
                    <input type="number" step="0.01" id="precio_nuevo" name="precio_nuevo" required
                           class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="precio_antes" class="block text-gray-700 font-semibold mb-1">Precio Anterior (opcional)</label>
                    <input type="number" step="0.01" id="precio_antes" name="precio_antes"
                           class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="imagen" class="block text-gray-700 font-semibold mb-1">Imagen</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*"
                           class="w-full border border-gray-300 p-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                           onchange="previewImage(event)">
                    <img id="imagen-preview" class="mt-2 max-h-40 rounded shadow hidden" alt="Previsualización de imagen">
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label for="categoria_id" class="block text-gray-700 font-semibold mb-1">Categoría</label>
                    <select id="categoria_id" name="categoria_id" required
                            class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">Seleccionar categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="marca_id" class="block text-gray-700 font-semibold mb-1">Marca</label>
                    <select id="marca_id" name="marca_id" required
                            class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">Seleccionar marca</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tamano_id" class="block text-gray-700 font-semibold mb-1">Tamaño</label>
                    <select id="tamano_id" name="tamano_id"
                            class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">Seleccionar tamaño</option>
                        @foreach($tamanos as $tamano)
                            <option value="{{ $tamano->id }}" {{ old('tamano_id') == $tamano->id ? 'selected' : '' }}>
                                {{ $tamano->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="sabor_id" class="block text-gray-700 font-semibold mb-1">Sabor</label>
                    <select id="sabor_id" name="sabor_id"
                            class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">Seleccionar sabor</option>
                        @foreach($sabores as $sabor)
                            <option value="{{ $sabor->id }}" {{ old('sabor_id') == $sabor->id ? 'selected' : '' }}>
                                {{ $sabor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="objetivo_id" class="block text-gray-700 font-semibold mb-1">Objetivo</label>
                    <select id="objetivo_id" name="objetivo_id"
                            class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">Seleccionar objetivo</option>
                        @foreach($objetivos as $objetivo)
                            <option value="{{ $objetivo->id }}" {{ old('objetivo_id') == $objetivo->id ? 'selected' : '' }}>
                                {{ $objetivo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="stock_cantidad" class="block text-gray-700 font-semibold mb-1">Stock Cantidad</label>
                    <input type="number" id="stock_cantidad" name="stock_cantidad" required
                           class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="stock_minimo" class="block text-gray-700 font-semibold mb-1">Stock Mínimo</label>
                    <input type="number" id="stock_minimo" name="stock_minimo" required
                           class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>
        </div>

        <div>
            <label for="descripcion" class="block text-gray-700 font-semibold mb-1">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="4" required
                      class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
        </div>

        <div class="flex flex-col sm:flex-row sm:space-x-4 gap-4 mt-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                Crear Producto
            </button>
            <a href="{{ route('productos.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-lg transition duration-300 text-center">
                Cancelar
            </a>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagen-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            preview.classList.add('hidden');
        }
    }
</script>
</section>
</body>
