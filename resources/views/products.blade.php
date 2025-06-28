</header>@component('components.navtecsupfit')@endcomponent</header>
<div class="products">
    <form method="GET" action="{{ route('products.index') }}" class="formulario-filtros">
    <div  id="productFilters" class="filtros-productos">
        <div class="col-md-4 mt-2" >
            <select name="categoria" class="form-control">
                <option value="" >Categorías</option>
                @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 mt-2">
            <select name="marca" class="form-control">
                <option value="">Marcas</option>
                @foreach($marcas as $marca)
                <option value="{{ $marca->id }}" {{ request('marca') == $marca->id ? 'selected' : '' }}>
                    {{ $marca->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 mt-2">
            <select name="tamano" class="form-control">
                <option value="">Tamaños</option>
                @foreach($tamanos as $tamano)
                <option value="{{ $tamano->id }}" {{ request('tamano') == $tamano->id ? 'selected' : '' }}>
                    {{ $tamano->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 mt-2">
            <select name="sabor" class="form-control">
                <option value="">Sabores</option>
                @foreach($sabores as $sabor)
                <option value="{{ $sabor->id }}" {{ request('sabor') == $sabor->id ? 'selected' : '' }}>
                    {{ $sabor->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 mt-2">
            <select name="objetivo" class="form-control">
                <option value="">Objetivos</option>
                @foreach($objetivos as $objetivo)
                <option value="{{ $objetivo->id }}" {{ request('objetivo') == $objetivo->id ? 'selected' : '' }}>
                    {{ $objetivo->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 mt-2 d-flex gap-2" id="botones-para-filtrar-eliminar">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary w-100" id="limpiar">Limpiar</a>
        </div>
    </div>
</form>
<div class="contenedor-flex"> 
    @forelse($productos as $producto)
            <div class="product-card"><a href="{{ route('productos.show', $producto) }}" >
                @if($producto->imagen)
                <img src="{{ asset('images/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" />
                @else
                    <div>
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                @endif
                </a>
                <p class="nombre-marca">{{ $producto->marca->nombre }}</p>
                <h4 class="nombre-producto">{{ $producto->nombre }}</h4>
                @if($producto->precio_antes)
                    <span class="old-price">S/{{ $producto->precio_antes }}</span>
                @endif
                <p class="precio-nuevo">S/{{ $producto->precio_nuevo }}</p>
                @if($producto->stock->cantidad > 0)
    <form action="{{ route('carrito.agregar') }}" method="POST" class="purchase-form">
        <div class="agregar-carrito">
            @csrf
            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
            <div class="quantity-controls">
                <button type="button" class="decrease">−</button>
                <input type="number" name="cantidad" value="1" min="1" max="{{ $producto->stock->cantidad }}" class="cantidad-input" readonly>
                <button type="button" class="increase">+</button>
            </div>
            <button type="submit" class="boton-agregar-carrito">Agregar al carrito</button>
        </div>

        <div class="stock-info">
            <span class="text-gray-600 text-sm">Quedan {{ $producto->stock->cantidad }} unidades</span>
            <div class="w-full bg-gray-200 rounded-full h-2 mt-1 mb-1">
                <div class="bg-gray-800 h-2 rounded-full" style="width: {{ $producto->stock->stock_percentage }}%"></div>
            </div>
            @if($producto->stock->cantidad <= $producto->stock->stock_minimo)
                <span class="text-yellow-600 text-xs">¡Stock bajo!</span>
            @endif
        </div>
    </form>
@else
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-2 rounded w-full text-center font-semibold mt-9">
        Producto agotado
    </div>
@endif


            </div>
            @empty
            <div style="display:flex; flex-direction: column; gap:2rem;align-items: center; ">
                <svg width="100px" height="100px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>cry</title>
                <desc>Created with sketchtool.</desc>
                <g id="people" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="cry" fill="#000000">
                <path d="M9.5,12 C10.3284271,12 11,11.3284271 11,10.5 C11,9.67157288 10.3284271,9 9.5,9 C8.67157288,9 8,9.67157288 8,10.5 C8,11.3284271 8.67157288,12 9.5,12 Z M15,16 C15,14.3431458 13.6568542,13 12,13 C10.3431458,13 9,14.3431458 9,16 L10,16 C10,16 10.3168385,14 12,14 C13.6831615,14 13.99584,16 13.99584,16 L15,16 Z M14.5,12 C15.3284271,12 16,11.3284271 16,10.5 C16,9.67157288 15.3284271,9 14.5,9 C13.6715729,9 13,9.67157288 13,10.5 C13,11.3284271 13.6715729,12 14.5,12 Z M12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 Z M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z M16,15 C16.5522847,15 17,14.5522847 17,14 C17,13.6318102 16.6666667,12.9651435 16,12 C15.3333333,12.9651435 15,13.6318102 15,14 C15,14.5522847 15.4477153,15 16,15 Z" id="Shape">
                </path></g></g></svg>
                <p class="Mensaje-no-encontrado">No se encontró el producto</p>
            </div>
            
        
    @endforelse
    
</div>
<div class="mt-6 flex justify-center">
    {{ $productos->links('pagination::tailwind') }}
</div>

</div>

<!-- Chatbot flotante -->
    <style>
        #chatbot-float-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            background: #a70608;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            cursor: pointer;
            font-size: 2rem;
        }
        #chatbot-iframe {
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 400px;
            height: 600px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.3);
            z-index: 9998;
            display: none;
            background: #fff;
            padding: 0;
            overflow: hidden;
        }
        @media (max-width: 500px) {
            #chatbot-iframe {
                width: 98vw;
                height: 70vh;
                right: 1vw;
                bottom: 80px;
            }
        }
    </style>
    <button id="chatbot-float-btn" title="¿Necesitas ayuda?">
        💬
    </button>
    <iframe id="chatbot-iframe" src="/chatbot/index.html" allow="clipboard-write; clipboard-read" sandbox="allow-scripts allow-same-origin allow-popups allow-forms"></iframe>
    <script>
        const btn = document.getElementById('chatbot-float-btn');
        const iframe = document.getElementById('chatbot-iframe');
        btn.addEventListener('click', () => {
            iframe.style.display = iframe.style.display === 'block' ? 'none' : 'block';
        });
        // Opcional: cerrar el chatbot al hacer clic fuera
        document.addEventListener('click', function(e) {
            if (!btn.contains(e.target) && !iframe.contains(e.target)) {
                iframe.style.display = 'none';
            }
        });
    </script>
    </body>
    @extends('components.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="productos-index.js"></script>
    <script src="carruceles.js"></script>
<style>
    .Mensaje-no-encontrado{
        font-size:22px;
    }
    #botones-para-filtrar-eliminar{
        margin-left:auto;
        
    }
    #botones-para-filtrar-eliminar button{
        border: 2px solid black ;
        width: 100px;
        border-radius: 30px;
        margin-right: 10px;
        transition:all ease-in-out 0.5s;
    }
    #botones-para-filtrar-eliminar button:hover{
        transform: scale(1.1);
    }
    #limpiar{
        color:red;
        border-radius: 30px;
        margin-right: 10px;
        transition:all ease-in-out 0.3s;
    }
    #limpiar:hover{
        transform: scale(1.1);
        color:red;
    }
    .products {
    background:#fff;
    flex-direction:column;
    gap: 20px;
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    padding:5rem;
    min-height:900px;
}
.form-control{
    width: 120px;
}
.filtros-productos{
    display:flex;
    margin-left:8rem;
}
                    .decrease{
                        margin:0;

                    }
                    .increase{
                        margin:0;
                    }
                    
                    .cantidad-input {
    width: 50px;
    height: 33px;
    font-size: 12px;
    border: none;
    outline: none;
    text-align: center; 
    color: #333;
    background-color: transparent;

}


.cantidad-input::-webkit-outer-spin-button,
.cantidad-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
                    .boton-agregar-carrito{
                        color: #FFF;
                        font-family: "Crimson Text";
                        font-size: 15px;
                        font-style: normal;
                        font-weight: 600;
                        line-height: normal;
                    }
                    .agregar-carrito {
                        background: #A70608;
                        width: 239px;
                        height: 33px;
                        flex-shrink: 0;
                        margin-top: 10px;
                        display: flex;
                        gap:20px;
                        padding-left: 10px;
                    }
                    .stock-label{
                        color: #CBC2C2;
                        font-family: "Crimson Text";
                        font-size: 15px;
                        font-style: normal;
                        font-weight: 400;
                        line-height: normal;
                    }
                    .precio-nuevo{
                        color: #0786A6;
                        font-family: "Crimson Text";
                        font-size: 15px;
                        font-style: normal;
                        font-weight: 600;
                        line-height: normal;
                    }
                    .nombre-producto{
                        color: #000;
                        font-family: "Crimson Text";
                        font-size: 15px;
                        font-style: normal;
                        font-weight: 600;
                        line-height: normal;
                    }
                    .nombre-marca{
                        color: rgba(30, 30, 30, 0.31);
                        font-family: "Crimson Text";
                        font-size: 13px;
                        font-style: normal;
                        font-weight: 600;
                        line-height: normal;
                    }
                    .stock-info{
                        height: 6px;
                        width: 90%;
                    }
                    .head-productos {
                        justify-content: space-between;
                        align-items: start;
                        padding: 20px;
                        margin-top: 4rem;
                        margin-left: 50px;
                    }
                    .head-productos h3 {
                        color: #000;
                        font-family: "Crimson Text";
                        font-size: 30px;
                        font-style: normal;
                        font-weight: 600;
                        line-height: normal;
                    }

                    .tabs {
                        display: flex;
                        gap: 20px;
                        margin-bottom: 20px;
                        font-weight: bold;
                        flex-wrap: wrap;
                    }

                    .tabs a {
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
                    .tabs a:hover {
                        color: #d01619;
                        transition: all 0.3s ease;
                        transform: scale(1.1);
                    }

                    .products {
                        
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

                    .Contenedores_productos {
                        display: flex;

                        position: relative;
                    }
                    .product-card {
                        display: flex;
                        background: #fff;
                        border-radius: 10px;
                        padding: 15px;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                        display: flex;
                        flex-direction: column;
                        align-items: start;
                        width: 286px;
                        height: auto;
                        flex-shrink: 0;
                    }
                    .contenedor-flex {
                        display: flex;
                        flex-wrap: wrap; 
                        gap: 20px;
                        margin-top: 60px;
                        justify-content: center;
                        max-width: 100%;
                    }
                    .product-card img {
                        max-width: 100%;
                        width: 157px;
                        height: 165px;
                        margin-bottom: 10px;
                        align-self: center;
                    }
                    .product-card a{
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
                        color: #0786a6;
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
                        margin-top: 5px;
                        display:flex;
                    }



                    .quantity-controls button {
                        background-color: transparent;
                        color: white;
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
                        background: linear-gradient(
                            90deg,
                            #000000 60%,
                            #b1b1b1 100%
                        );
                        border-radius: 5px;
                        transition: width 0.4s;
                    }
                </style>
<script>
        document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.quantity-controls').forEach(function (control) {
            const input = control.querySelector('.cantidad-input');
            const increaseBtn = control.querySelector('.increase');
            const decreaseBtn = control.querySelector('.decrease');

            const max = parseInt(input.max);
            const min = parseInt(input.min) || 1;

            increaseBtn.addEventListener('click', function () {
                let current = parseInt(input.value);
                if (current < max) {
                    input.value = current + 1;
                }
            });

            decreaseBtn.addEventListener('click', function () {
                let current = parseInt(input.value);
                if (current > min) {
                    input.value = current - 1;
                }
            });
            
        });
        
    });
                    // Toggle advanced filters
                    document
                        .querySelector(".category-btn")
                        .addEventListener("click", function () {
                            const advancedFilters =
                                document.getElementById("advancedFilters");
                            advancedFilters.style.display =
                                advancedFilters.style.display === "none"
                                    ? "block"
                                    : "none";
                        });

                    // Auto-submit search
                    document
                        .querySelector('input[name="search"]')
                        .addEventListener("input", function () {
                            setTimeout(() => {
                                document.getElementById("filterForm").submit();
                            }, 500);
                        });
                </script>
</body>
</html>