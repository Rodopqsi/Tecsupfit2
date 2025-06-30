<body class="display:flex;">
    <div class="sidebar">
        @extends('components.side_bar')
    </div>

<!-- Search Container -->
<section class="Contenedor_general" style="background: blue; ">
    <div class="search-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <form method="GET" action="{{ route('productos.index') }}" id="filterForm" style="flex: 1;">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" placeholder="Buscar productos..." value="{{ request('search') }}">
            </div>
        </form>
        
        <div class="view-toggle">
            <a href="/" class="text-primary" style="text-decoration:none; ">
                <i class="fas fa-eye"></i> Ver Tienda
            </a>
        </div>
    </div>
    
    <!-- Category Filters -->
    <div class="category-filters">
        <button type="button" class="category-btn">
            <i class="fas fa-filter"></i> Filtrar
        </button>
        <button type="button" class="category-btn">
            <i class="fas fa-file-export"></i> Exportar
        </button>
        <button type="button" class="category-btn top-month" onclick="window.location.href='/'">
            <i class="fas fa-star" ></i> Top del mes
        </button>
        <!-- Botón para abrir el modal de editar categorías -->
        <button type="button" class="category-btn edit-categories" data-bs-toggle="modal" data-bs-target="#editarCategoriasModal">
            <i class="fas fa-edit"></i> Editar Categorías
        </button>
        
        <button type="button" class="category-btn marcas-categories" data-bs-toggle="modal" data-bs-target="#editarMarcasModal">
            <i class="fas fa-edit"></i> Editar Marcas
        </button>
        
        <!-- Modal de Editar Marcas -->
        <div class="modal fade" id="editarMarcasModal" tabindex="-1" aria-labelledby="editarMarcasLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 1200px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarMarcasLabel">Editar Marcas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body p-4 bg-gray-50">
                                <form action="{{ route('marcas.store') }}" method="POST" class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:gap-4">
                                    @csrf
                                    <div class="flex-1">
                                        <input type="text" name="nombre" placeholder="Nombre de la Marca" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" name="imagen" placeholder="Imagen de la Marca" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 " />
                                    </div>
                                    <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full md:w-auto">Agregar Marca</button>
                                </form>
                                <div class="space-y-3">
                                    @foreach($marcas as $marca)
                                    <div class="flex flex-col md:flex-row md:items-center gap-2 bg-white p-3 rounded shadow-sm">
                                        <form action="{{ route('marcas.update', $marca) }}" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row md:items-center gap-2 flex-1">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="nombre" value="{{ $marca->nombre }}" required
                                                    class="px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 w-full md:w-40" />
                                                <input type="file" name="imagen"
                                                    class="px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 w-full md:w-64" />
                                                @if($marca->imagen)
                                                    <img src="{{ asset('images/marcas/' . $marca->imagen) }}" alt="Imagen actual" class="w-20 h-20 object-contain">
                                                @endif
                                                <button type="submit"
                                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition w-full md:w-auto" >Actualizar</button>
                                            </form>
                                            <form action="{{ route('marcas.destroy', $marca) }}" method="POST" class="flex-shrink-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition w-full md:w-auto"
                                                onclick="return confirm('¿Estás seguro de eliminar esta marca?')">Eliminar</button>
                                            </form>
                                        </div>
                                        @endforeach
                                </div>
                            </div>
                            <div class="modal-footer flex justify-end gap-2">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal de Editar Categorías -->
                <div class="modal fade" id="editarCategoriasModal" tabindex="-1" aria-labelledby="editarCategoriasLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 700px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarCategoriasLabel">Editar Categorías</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body p-4 bg-gray-50">
                                <form action="{{ route('categorias.store') }}" method="POST" class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:gap-4">
                                    @csrf
                                    <div class="flex-1">
                                        <input type="text" name="nombre" placeholder="Nombre de la Categoría" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" name="descripcion" placeholder="Descripción de la Categoría" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                                    </div>
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full md:w-auto">Agregar Categoría</button>
                                    </form>
                                    <div class="space-y-3">
                                        @foreach($categorias as $categoria)
                                        <div class="flex flex-col md:flex-row md:items-center gap-2 bg-white p-3 rounded shadow-sm">
                                            <form action="{{ route('categorias.update', $categoria) }}" method="POST" class="flex flex-col md:flex-row md:items-center gap-2 flex-1">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="nombre" value="{{ $categoria->nombre }}" required
                                                class="px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 w-full md:w-40" />
                                                <input type="text" name="descripcion" value="{{ $categoria->descripcion }}" required
                                                    class="px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 w-full md:w-64" />
                                                    <button type="submit"
                                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition w-full md:w-auto">Actualizar</button>
                                            </form>
                                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="flex-shrink-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition w-full md:w-auto"
                                                    onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</button>
                                            </form>
                                        </div>
                                        @endforeach
                                    </div>
                            </div>
                            <div class="modal-footer flex justify-end gap-2">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Botón para abrir modal de Sabores -->
<button class="category-btn marcas-categories" data-bs-toggle="modal" data-bs-target="#editarSaboresModal">
    <i class="fas fa-edit"></i> Gestionar Sabores
</button>

<!-- Modal de Editar Sabores -->
<div class="modal fade" id="editarSaboresModal" tabindex="-1" aria-labelledby="editarSaboresLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarSaboresLabel">Editar Sabores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-4 bg-gray-50">
                <form action="{{ route('sabores.store') }}" method="POST" class="mb-6 flex flex-col md:flex-row md:items-end gap-3">
                    @csrf
                    <input type="text" name="nombre" placeholder="Nombre del Sabor" required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full md:w-auto">Agregar Sabor</button>
                </form>
                <div class="space-y-3">
                    @foreach($sabores as $sabor)
                    <div class="flex flex-col md:flex-row md:items-center gap-2 bg-white p-3 rounded shadow-sm">
                        <form action="{{ route('sabores.update', $sabor) }}" method="POST" class="flex flex-col md:flex-row md:items-center gap-2 flex-1">
                            @csrf
                            @method('PUT')
                            <input type="text" name="nombre" value="{{ $sabor->nombre }}" required
                                class="px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 w-full md:w-64" />
                            <button type="submit"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition w-full md:w-auto">Actualizar</button>
                        </form>
                        <form action="{{ route('sabores.destroy', $sabor) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition w-full md:w-auto"
                                onclick="return confirm('¿Estás seguro de eliminar este sabor?')">Eliminar</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Botón para abrir modal de Tamaños -->
<button class="category-btn marcas-categories" data-bs-toggle="modal" data-bs-target="#editarTamanosModal">
    <i class="fas fa-edit"></i> Gestionar Tamaños
</button>

<!-- Modal de Editar Tamaños -->
<div class="modal fade" id="editarTamanosModal" tabindex="-1" aria-labelledby="editarTamanosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarTamanosLabel">Editar Tamaños</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-4 bg-gray-50">
                <form action="{{ route('tamanos.store') }}" method="POST" class="mb-6 flex flex-col md:flex-row md:items-end gap-3">
                    @csrf
                    <input type="text" name="nombre" placeholder="Nombre del Tamaño" required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    <input type="text" name="descripcion" placeholder="Descripción" required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full md:w-auto">Agregar Tamaño</button>
                </form>
                <div class="space-y-3">
                    @foreach($tamanos as $tamano)
                    <div class="flex flex-col md:flex-row md:items-center gap-2 bg-white p-3 rounded shadow-sm">
                        <form action="{{ route('tamanos.update', $tamano) }}" method="POST" class="flex flex-col md:flex-row md:items-center gap-2 flex-1">
                            @csrf
                            @method('PUT')
                            <input type="text" name="nombre" value="{{ $tamano->nombre }}" required
                                class="px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 w-full md:w-40" />
                            <input type="text" name="descripcion" value="{{ $tamano->descripcion }}" required
                                class="px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 w-full md:w-64" />
                            <button type="submit"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition w-full md:w-auto">Actualizar</button>
                        </form>
                        <form action="{{ route('tamanos.destroy', $tamano) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition w-full md:w-auto"
                                onclick="return confirm('¿Estás seguro de eliminar este tamaño?')">Eliminar</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<button class="category-btn marcas-categories" data-bs-toggle="modal" data-bs-target="#editarObjetivosModal">
    <i class="fas fa-edit"></i> Gestionar Objetivos
</button>

<!-- Modal de Editar Objetivos -->
<div class="modal fade" id="editarObjetivosModal" tabindex="-1" aria-labelledby="editarObjetivosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarObjetivosLabel">Editar Objetivos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-4 bg-gray-50">
                <form action="{{ route('objetivos.store') }}" method="POST" class="mb-6 flex flex-col md:flex-row md:items-end gap-3">
                    @csrf
                    <input type="text" name="nombre" placeholder="Nombre del Objetivo" required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    <input type="text" name="descripcion" placeholder="Descripción" required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full md:w-auto">Agregar Objetivo</button>
                </form>
                <div class="space-y-3">
                    @foreach($objetivos as $objetivo)
                    <div class="flex flex-col md:flex-row md:items-center gap-2 bg-white p-3 rounded shadow-sm">
                        <form action="{{ route('objetivos.update', $objetivo) }}" method="POST" class="flex flex-col md:flex-row md:items-center gap-2 flex-1">
                            @csrf
                            @method('PUT')
                            <input type="text" name="nombre" value="{{ $objetivo->nombre }}" required
                                class="px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 w-full md:w-64" />
                            <input type="text" name="descripcion" value="{{ $objetivo->descripcion }}" required
                                class="px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 w-full md:w-64" />
                            <button type="submit"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition w-full md:w-auto">Actualizar</button>
                        </form>
                        <form action="{{ route('objetivos.destroy', $objetivo) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition w-full md:w-auto"
                                onclick="return confirm('¿Estás seguro de eliminar este objetivo?')">Eliminar</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

                <a href="{{ route('productos.index') }}" 
                class="category-btn {{ !request('categoria') ? 'active' : '' }}">
                TODOS
            </a>
            
            @foreach($categorias as $categoria)
            <a href="{{ route('productos.index', ['categoria' => $categoria->id]) }}" 
            class="category-btn {{ request('categoria') == $categoria->id ? 'active' : '' }}">
            {{ strtoupper($categoria->nombre) }}
        </a>
        @endforeach
            </div>
            
            <!-- Filtros adicionales (ocultos inicialmente) -->
            <form method="GET" action="{{ route('productos.index') }}">
                <div class="row mt-3" style="display: none;" id="advancedFilters">
    <div class="col-md-3">
        <select name="marca" class="form-control">
            <option value="">Todas las marcas</option>
            @foreach($marcas as $marca)
            <option value="{{ $marca->id }}" {{ request('marca') == $marca->id ? 'selected' : '' }}>
                {{ $marca->nombre }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="objetivo" class="form-control">
            <option value="">Todos los objetivos</option>
            @foreach($objetivos as $objetivo)
            <option value="{{ $objetivo->id }}" {{ request('objetivo') == $objetivo->id ? 'selected' : '' }}>
                {{ $objetivo->nombre }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="sabor" class="form-control">
            <option value="">Todos los sabores</option>
            @foreach($sabores as $sabor)
            <option value="{{ $sabor->id }}" {{ request('sabor') == $sabor->id ? 'selected' : '' }}>
                {{ $sabor->nombre }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="tamano" class="form-control">
            <option value="">Todos los tamaños</option>
            @foreach($tamanos as $tamano)
            <option value="{{ $tamano->id }}" {{ request('tamano') == $tamano->id ? 'selected' : '' }}>
                {{ $tamano->nombre }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3 mt-2">
        <input type="number" name="precio_min" class="form-control" 
        placeholder="Precio mín" value="{{ request('precio_min') }}">
    </div>

    <div class="col-md-3 mt-2">
        <input type="number" name="precio_max" class="form-control" 
        placeholder="Precio máx" value="{{ request('precio_max') }}">
    </div>

    <div class="col-md-3 mt-2">
        <button type="submit" class="btn btn-primary w-100">Aplicar Filtros</button>
    </div>

    <div class="col-md-3 mt-2">
        <a href="{{ route('productos.index') }}" class="btn btn-secondary w-100">Limpiar</a>
    </div>
</div>

            </form>

    </div>
    
    <!-- Products Grid -->
    <div class="mt-6 flex justify-center">
    {{ $productos->links('pagination::tailwind') }}
</div>

    <div class="products-grid">
        <!-- Add Product Card -->
        <div class="add-product-card" onclick="window.location='{{ route('productos.create') }}'" id="openModal">
            <div class="add-icon">
                <i class="fas fa-plus"></i>
            </div>
            <h5>Agregar Producto</h5>
            <p>Haz clic para crear un nuevo producto</p>
        </div>
        
        <!-- Product Cards -->
        @foreach($productos as $producto)
            <div class="product-card">
                <div class="product-image">
                    @if($producto->imagen)
                        <img src="{{ asset('images/productos/' . $producto->imagen) }}" 
                                alt="{{ $producto->nombre }}">
                    @else
                    <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                        @endif
                        
                        @if($producto->es_delmes)
                        <div class="product-badge">Del Mes ✓</div>
                        @endif
                    </div>
                    
                    <div class="product-info">
                        <h6 class="product-title">{{ $producto->nombre }}</h6>
                        <p class="product-description">{{ Str::limit($producto->descripcion, 80) }}</p>
                        
                        <div class="product-price">
                            <span class="price-current">${{ $producto->precio_nuevo }}</span>
                            @if($producto->precio_antes)
                            <span class="price-old">${{ $producto->precio_antes }}</span>
                        @endif
                    </div>
                    
                    <div class="product-meta">
                        {{ $producto->categoria->nombre }} - {{ $producto->marca->nombre }}
                    </div>
                    
                    <div class="stock-info">
                        <div class="stock-label">Stock: {{ $producto->stock->cantidad }}</div>
                        <div class="stock-bar">
                            <div class="stock-fill" style="width: {{ $producto->stock->stock_percentage }}%;"></div>
                        </div>
                    </div>
                    
                    <div class="product-actions">
                        <a href="{{ route('productos.show', $producto) }}" style="text-decoration: none; color: white; background-color: #198754; border-radius: 5px; width: 60px; height: 30px; font-size: 13px; font-weight: 400; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">Ver</a>
                            <style>a[href="{{ route('productos.show', $producto) }}"]:hover {background-color: #27a36d; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transform: scale(1.05); }</style>
                            <a href="{{ route('productos.edit', $producto) }}" style="text-decoration: none; color: white; background-color: #F2CF59; border-radius: 5px; width: 60px; height: 30px; font-size: 13px; font-weight: 400; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">Editar</a>
                            <style>a[href="{{ route('productos.edit', $producto) }}"]:hover {background-color:rgb(246, 212, 100); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transform: scale(1.05); }</style>
                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </div>
                    
                    <form action="{{ route('productos.toggle-delmes', $producto) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn {{ $producto->es_delmes ? 'btn-success' : 'btn-outline-success' }} btn-sm delmes-btn">
                            {{ $producto->es_delmes ? 'Del Mes ✓' : 'Agregar a Del Mes' }}
                        </button>
                    </form>
                    
                    
                    

                </div>
            </div>

            @endforeach
        </div>
        
        
        <!-- Pagination -->
    </div>
    
</section>
@push('scripts')
<script>
    // Toggle advanced filters
    document.querySelector('.category-btn').addEventListener('click', function() {
        const advancedFilters = document.getElementById('advancedFilters');
        advancedFilters.style.display = advancedFilters.style.display === 'none' ? 'block' : 'none';
    });
    
    // Auto-submit search
    const searchInput = document.querySelector('input[name="search"]');
    const form = document.getElementById('filterForm');

    searchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            form.submit();   
        }
    });


</script>
</body>
@endpush
@extends('layouts.admin')

