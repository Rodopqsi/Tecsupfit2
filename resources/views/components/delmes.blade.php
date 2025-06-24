<h2 class="h">Productos del Mes</h2>
<a href="{{ route('index') }}" 
                class="category-btn {{ !request('categoria') ? 'active' : '' }}">
                TODOS
            </a>
            
            @foreach($categorias as $categoria)
            <a href="{{ route('index', ['categoria' => $categoria->id]) }}" 
            class="category-btn {{ request('categoria') == $categoria->id ? 'active' : '' }}">
            {{ strtoupper($categoria->nombre) }}
        </a>
        @endforeach
@foreach($productosDelMes as $producto)
    <div>
        @if($producto->imagen)
                        <img src="{{ asset('images/productos/' . $producto->imagen) }}" 
                                alt="{{ $producto->nombre }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
        @endif
        <h3>{{ $producto->nombre }}</h3>
        <p>{{ $producto->descripcion }}</p>
        <p>Precio: S/ {{ $producto->precio_nuevo }}</p>
    </div>
@endforeach

<style>

    .head-productos {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: start;
    padding: 20px;
    margin-top: 4rem;
}
.head-productos h3 {
    color: #000;
    font-family: "Crimson Text";
    font-size: 30px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    width: 380px;
    height: 60px;
    flex-shrink: 0;
}

.cuerpo{
    background-color: white;

}
.tabs {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    font-weight: bold;
    flex-wrap: wrap;
}

.tabs button {
    cursor: pointer;
    color: #000;
    text-decoration: none;
    font-family: "Crimson Text";
    font-size: 15px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    background-color: transparent;
    border: none;
    transition: all 0.3s ease;
}
.tabs button:hover {
    color: #d01619;
    transition: all 0.3s ease;
    transform: scale(1.1);
}

.products{
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    
    justify-content: center;

}
.botones {
    margin: 20px 0;
}
.botones button {
    margin: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

.Contenedores_productos{
    display: flex;
    position: relative;
}
.seccion {
    flex-wrap: wrap;
    gap: 20px;
    padding: 40px;
    font-size: 1.8rem;
    color: white;
    font-weight: bold;
    display: flex;
}
.seccion:not(.activo) {
    display: none;
}
@keyframes fade {
    from { opacity: 0; }
    to { opacity: 1; }
}
.product-card {
    background: #fff;
    border-radius: 10px;
    padding: 15px;
    width: 286px;
    height: 430px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    align-items: start;


}

.product-card img {
    max-width: 100%;
    width: 157px;
    height: 188px;
    margin-bottom: 10px;
    align-self: center;
}

.brand {
    font-size: 12px;
    color: #999;
    text-transform: uppercase;
}

.title {
    font-weight: bold;
    text-align: start;
    font-size: 14px;
    margin: 5px 0;
    color: #333;
}

.price {
    color: #0786A6;
    font-weight: bold;
    margin-top: 2px;
    margin-bottom: 5px;
    font-size: 15px;
}

.old-price {
    text-decoration: line-through;
    color: #999;
    font-size: 12px;
    text-align: start;
}

.quantity-controls {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 3px;
    height: 33px;
    background-color: #a10000;
}

.quantity-controls button {
    background-color: transparent;
    color:white;
    border: none;
    font-size: 16px;
}
.quantity-controls input {
    width: 40px;
    text-align: center;
    border: none;
    background-color: #f0f0f0;
    border-radius: 5px;
    background-color: transparent;
    color: white;
    font-size: 16px;
}

.add-to-cart {
    background: transparent;
    color: white;
    border: none;
    cursor: pointer;
    text-align: center;
    align-self: center;
}
.seccion-productos {
    display: flex;
    flex-direction: column;
    align-items: start;
    padding: 20px;
    
}

.stock {
    font-size: 12px;
    margin-top: 5px;
    color: #555;
}
.stock-bar-container {
    width: 100%;
    height: 8px;
    background: #eee;
    border-radius: 5px;
    margin-top: 6px;
    overflow: hidden;
}
.stock-bar {
    height: 100%;
    background: linear-gradient(90deg, #000000 60%, #b1b1b1 100%);
    border-radius: 5px;
    transition: width 0.4s;
}
</style>
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