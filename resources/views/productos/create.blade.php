<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <section class="Contenedor_general">
@extends('components.side_bar')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Crear Producto</h1>
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" id="nombre" name="nombre" required>
                </div>
                <div>
                    <label for="precio_nuevo" class="block text-sm font-medium text-gray-700">Precio Nuevo</label>
                    <input type="number" step="0.01" class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" id="precio_nuevo" name="precio_nuevo" required>
                </div>
                <div>
                    <label for="precio_antes" class="block text-sm font-medium text-gray-700">Precio Anterior (opcional)</label>
                    <input type="number" step="0.01" class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" id="precio_antes" name="precio_antes">
                </div>
                <div>
                    <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
                    <input type="file" class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" id="imagen" name="imagen" accept="image/*" onchange="previewImage(event)">
                    <img id="imagen-preview" class="mt-2 max-h-40 rounded shadow hidden" alt="Previsualización de imagen">
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
            </div>
            <div class="space-y-4">
                <div>
                    <label for="categoria_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                    <select class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" id="categoria_id" name="categoria_id" required>
                        <option value="">Seleccionar categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="marca_id" class="block text-sm font-medium text-gray-700">Marca</label>
                    <select class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" id="marca_id" name="marca_id" required>
                        <option value="">Seleccionar marca</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
            <label for="tamano_id">Tamaño:</label>
            <select id="tamano_id" name="tamano_id">
                <option value="">Seleccionar tamaño</option>
                @foreach($tamanos as $tamano)
                    <option value="{{ $tamano->id }}" {{ old('tamano_id') == $tamano->id ? 'selected' : '' }}>
                        {{ $tamano->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="sabor_id">Sabor:</label>
            <select id="sabor_id" name="sabor_id">
                <option value="">Seleccionar sabor</option>
                @foreach($sabores as $sabor)
                    <option value="{{ $sabor->id }}" {{ old('sabor_id') == $sabor->id ? 'selected' : '' }}>
                        {{ $sabor->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
                <div>
            <label for="objetivo_id">Objetivo:</label>
            <select id="objetivo_id" name="objetivo_id">
                <option value="">Seleccionar objetivo</option>
                @foreach($objetivos as $objetivo)
                    <option value="{{ $objetivo->id }}" {{ old('objetivo_id') == $objetivo->id ? 'selected' : '' }}>
                        {{ $objetivo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
                <div>
                    <label for="stock_cantidad" class="block text-sm font-medium text-gray-700">Stock Cantidad</label>
                    <input type="number" class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" id="stock_cantidad" name="stock_cantidad" required>
                </div>
                <div>
                    <label for="stock_minimo" class="block text-sm font-medium text-gray-700">Stock Mínimo</label>
                    <input type="number" class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" id="stock_minimo" name="stock_minimo" required>
                </div>
            </div>
        </div>
        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-700 ">Descripción</label>
            <textarea class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" id="descripcion" name="descripcion" rows="4" required style="border: 1px solid black;"></textarea>
        </div>
        
        <div class="flex space-x-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Crear Producto</button>
            <a href="{{ route('productos.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancelar</a>
        </div>
    </form>
</div>
</section>
</body>