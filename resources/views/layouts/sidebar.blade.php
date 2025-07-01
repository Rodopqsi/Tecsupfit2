<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecnyFit Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
        }

        .labarra {
            width: 280px;
            background: linear-gradient(180deg, #1a1a1a 0%, #2d2d2d 100%);
            color: white;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .logo-container {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
            font-style: italic;
            position: relative;
        }

        .logo::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #ff6b6b, #4ecdc4);
            border-radius: 1px;
        }

        .nav-menu {
            flex: 1;
            padding: 20px 0;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link-2 {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0;
            position: relative;
            font-weight: 500;
        }

        .nav-link-2:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(4px);
        }

        .nav-link-2.active {
            background: linear-gradient(90deg, rgba(255, 107, 107, 0.2), rgba(78, 205, 196, 0.2));
            color: white;
            border-right: 3px solid #4ecdc4;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-text {
            font-size: 15px;
        }

        .submenu {
            background: rgba(0, 0, 0, 0.2);
            margin-top: 4px;
        }

        .submenu .nav-link-2 {
            padding-left: 54px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
        }

        .submenu .nav-link-2:hover {
            color: rgba(255, 255, 255, 0.9);
        }

        .collapse-icon {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .collapse-icon.rotated {
            transform: rotate(180deg);
        }

        .main-content {
            flex: 1;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 18px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .labarra {
                width: 100%;
                max-width: 280px;
                position: fixed;
                left: -280px;
                top: 0;
                height: 100vh;
                z-index: 1000;
            }

            .labarra.open {
                left: 0;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .nosexd {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
            }

            .nosexd.show {
                display: block;
            }

            .tresrayitas {
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1001;
                background: #1a1a1a;
                border: none;
                color: white;
                padding: 12px;
                border-radius: 8px;
                cursor: pointer;
                display: block;
            }
        }

        @media (min-width: 769px) {
            .tresrayitas {
                display: none;
            }
        }

        /* Icons using CSS */
        .icon-dashboard::before { content: "📊"; }
        .icon-orders::before { content: "📦"; }
        .icon-products::before { content: "🏷️"; }
        .icon-clients::before { content: "👥"; }
        .icon-config::before { content: "⚙️"; }
        .icon-info::before { content: "ℹ️"; }
        .icon-account::before { content: "👤"; }
        .icon-social::before { content: "🌐"; }
        .icon-shipping::before { content: "🚚"; }
        .icon-chevron::before { content: "▼"; }
    </style>
</head>
<body>
    <button class="tresrayitas" onclick="toggleSidebar()">
        <span style="font-size: 18px;">☰</span>
    </button>

    <div class="nosexd" onclick="toggleSidebar()"></div>

    <aside class="labarra" id="sidebar">
        <div class="logo-container">
            <a href="#" class="logo">TecnyFit</a>
        </div>

        <nav class="nav-menu">
            <div class="nav-item">
                <a href="#" class="nav-link active">
                    <span class="nav-icon icon-dashboard"></span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#" class="nav-link">
                    <span class="nav-icon icon-orders"></span>
                    <span class="nav-text">Pedidos</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#" class="nav-link">
                    <span class="nav-icon icon-products"></span>
                    <span class="nav-text">Productos</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#" class="nav-link">
                    <span class="nav-icon icon-clients"></span>
                    <span class="nav-text">Clientes</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#" class="nav-link" onclick="toggleSubmenu(event)">
                    <span class="nav-icon icon-config"></span>
                    <span class="nav-text">Configuración</span>
                    <span class="collapse-icon icon-chevron"></span>
                </a>
                <div class="submenu" id="config-submenu" style="display: none;">
                    <a href="#" class="nav-link-2">
                        <span class="nav-text">Información</span>
                    </a>
                    <a href="#" class="nav-link-2">
                        <span class="nav-text">Cuenta</span>
                    </a>
                    <a href="#" class="nav-link-2">
                        <span class="nav-text">Redes sociales</span>
                    </a>
                    <a href="#" class="nav-link-2">
                        <span class="nav-text">Envíos</span>
                    </a>
                </div>
            </div>
        </nav>
    </aside>

    <main class="main-content">
        <div class="search-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('productos.index') }}" id="filterForm" style="flex: 1;">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" name="search" placeholder="Buscar productos..." 
                       value="{{ request('search') }}" 
                       onchange="this.form.submit()">
            </div>
        </form>
        <div class="view-toggle">
            <a href="#" class="text-primary">
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
                <button type="button" class="category-btn top-month">
                    <i class="fas fa-star"></i> Top del mes
                </button>
                <button type="button" class="category-btn edit-categories">
                    <i class="fas fa-edit"></i> Editar Categorías
                </button>
                
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
                    <input type="number" name="precio_min" class="form-control" 
                           placeholder="Precio mín" value="{{ request('precio_min') }}">
                </div>
                <div class="col-md-3">
                    <input type="number" name="precio_max" class="form-control" 
                           placeholder="Precio máx" value="{{ request('precio_max') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Products Grid -->
    <div class="products-grid">
        <!-- Add Product Card -->
        <div class="add-product-card" onclick="window.location='{{ route('productos.create') }}'">
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
                        <a href="{{ route('productos.show', $producto) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </div>

                    <form action="{{ route('productos.toggle-delmes', $producto) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn {{ $producto->es_delmes ? 'btn-success' : 'btn-outline-success' }} btn-sm delmes-btn">
                            {{ $producto->es_delmes ? 'Del Mes ✓' : 'Agregar a Del Mes' }}
                        </button>
                    </form>

                    <form action="{{ route('productos.comprar', $producto) }}" method="POST" class="purchase-form">
                        @csrf
                        <input type="number" name="cantidad" placeholder="Cant." min="1" 
                                max="{{ $producto->stock->cantidad }}" required>
                        <button type="submit" class="btn btn-primary btn-sm">Comprar</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $productos->links() }}
    </div>
</div>

@push('scripts')
<script>
    // Toggle advanced filters
    document.querySelector('.category-btn').addEventListener('click', function() {
        const advancedFilters = document.getElementById('advancedFilters');
        advancedFilters.style.display = advancedFilters.style.display === 'none' ? 'block' : 'none';
    });

    // Auto-submit search
    document.querySelector('input[name="search"]').addEventListener('input', function() {
        setTimeout(() => {
            document.getElementById('filterForm').submit();
        }, 500);
    });
</script>
@endpush
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.nosexd');
            
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('show');
            }
        }

        function toggleSubmenu(event) {
            event.preventDefault();
            const submenu = document.getElementById('config-submenu');
            const icon = event.currentTarget.querySelector('.collapse-icon');
            
            if (submenu.style.display === 'none' || submenu.style.display === '') {
                submenu.style.display = 'block';
                icon.classList.add('rotated');
            } else {
                submenu.style.display = 'none';
                icon.classList.remove('rotated');
            }
        }

        // Set active nav item
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                if (!this.querySelector('.collapse-icon')) {
                    // Remove active class from all links
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                    // Add active class to clicked link
                    this.classList.add('active');
                }
            });
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.tresrayitas');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
                    sidebar.classList.remove('open');
                    document.querySelector('.nosexd').classList.remove('show');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.getElementById('sidebar').classList.remove('open');
                document.querySelector('.nosexd').classList.remove('show');
            }
        });
    </script>
</body>
</html>