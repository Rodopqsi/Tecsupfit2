<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <title>TecsupFit</title>
    </head>
    <body>
        <header>@component('components.navtecsupfit') @endcomponent</header>
        <div
            id="carouselExampleInterval"
            class="carousel slide"
            data-bs-ride="carousel"
        >
        
@auth
    @if(auth()->user()->is_admin)
        <div class="sticky top-4 z-50">
            <a href="{{ route('productos.index') }}"
                class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-red-700 transition" style="z-index:5000; position:absolute; right:10px;">
                Panel administrativo
            </a>
        </div>
    @endif
@endauth


            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img
                        src="imagenes/ImagenHeader/carrusel1 (2).png"
                        class="d-block w-100"
                        alt="..."
                    />
                    <a
                        href="/quemadores_de_grasa.html"
                        class="boton-imagen-inicio"
                    ></a>
                </div>

                <div class="carousel-item" data-bs-interval="2000">
                    <img
                        src="imagenes/ImagenHeader/carrusel2 (2).png"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>

                <div class="carousel-item">
                    <img
                        src="imagenes/ImagenHeader/carrusel3.png"
                        class="d-block w-100"
                        alt="..."
                    />
                </div>
            </div>

            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselExampleInterval"
                data-bs-slide="prev"
            >
                <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                ></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselExampleInterval"
                data-bs-slide="next"
            >
                <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                ></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <section class="etiquetas">
            <div class="carta1">
                <svg
                    width="69"
                    height="69"
                    viewBox="0 0 69 69"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M23 48.875V43.125H29.2531C29.0135 44.0833 28.8583 45.0417 28.7874 46C28.7165 46.9583 28.728 47.9167 28.8219 48.875H23ZM23 63.25C19.0229 63.25 15.6333 61.848 12.8311 59.0439C10.029 56.2398 8.62692 52.8502 8.625 48.875V23C7.04375 23 5.69058 22.4375 4.5655 21.3124C3.44042 20.1873 2.87692 18.8332 2.875 17.25V11.5C2.875 9.91875 3.4385 8.56558 4.5655 7.4405C5.6925 6.31542 7.04567 5.75192 8.625 5.75H37.375C38.9562 5.75 40.3104 6.3135 41.4374 7.4405C42.5644 8.5675 43.1269 9.92067 43.125 11.5V17.25C43.125 18.8313 42.5625 20.1854 41.4374 21.3124C40.3123 22.4394 38.9582 23.0019 37.375 23V31.6969C36.225 32.4156 35.1708 33.2542 34.2125 34.2125C33.2542 35.1708 32.4156 36.225 31.6969 37.375H23V31.625H31.625V23H14.375V48.875C14.375 51.2708 15.2135 53.3073 16.8906 54.9844C18.5677 56.6615 20.6042 57.5 23 57.5C24.4375 57.5 25.7437 57.1885 26.9186 56.5656C28.0935 55.9427 29.0873 55.0802 29.9 53.9781C30.2833 54.9365 30.7146 55.8469 31.1938 56.7094C31.6729 57.5719 32.2479 58.4104 32.9187 59.225C31.625 60.4708 30.1396 61.4531 28.4625 62.1719C26.7854 62.8906 24.9646 63.25 23 63.25ZM8.625 17.25H37.375V11.5H8.625V17.25ZM47.4375 54.625C49.45 54.625 51.151 53.9302 52.5406 52.5406C53.9302 51.151 54.625 49.45 54.625 47.4375C54.625 45.425 53.9302 43.724 52.5406 42.3344C51.151 40.9448 49.45 40.25 47.4375 40.25C45.425 40.25 43.724 40.9448 42.3344 42.3344C40.9448 43.724 40.25 45.425 40.25 47.4375C40.25 49.45 40.9448 51.151 42.3344 52.5406C43.724 53.9302 45.425 54.625 47.4375 54.625ZM62.1 66.125L54.3375 58.3625C53.2833 59.0333 52.1813 59.5365 51.0312 59.8719C49.8812 60.2073 48.6833 60.375 47.4375 60.375C43.8438 60.375 40.7895 59.1177 38.2749 56.603C35.7602 54.0883 34.5019 51.0332 34.5 47.4375C34.4981 43.8418 35.7564 40.7876 38.2749 38.2749C40.7934 35.7621 43.8476 34.5038 47.4375 34.5C51.0274 34.4962 54.0826 35.7545 56.603 38.2749C59.1234 40.7953 60.3807 43.8495 60.375 47.4375C60.375 48.6833 60.2073 49.8812 59.8719 51.0312C59.5365 52.1813 59.0333 53.2833 58.3625 54.3375L66.125 62.1L62.1 66.125Z"
                        fill="white"
                    />
                </svg>
                <p>
                    Formulas basadas en evidencias <br />
                    <span>cientificas</span>
                </p>
            </div>
            <div class="carta2">
                <svg
                    width="54"
                    height="58"
                    viewBox="0 0 54 56"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <rect width="54" height="56" fill="black" />
                    <path
                        d="M13.5 44.3333V46.6666C13.5 47.3277 13.2844 47.8819 12.8531 48.3291C12.4219 48.7763 11.8875 49 11.25 49H9C8.3625 49 7.82812 48.7763 7.39687 48.3291C6.96562 47.8819 6.75 47.3277 6.75 46.6666V28L11.475 14C11.7 13.3 12.1031 12.7361 12.6844 12.3083C13.2656 11.8805 13.9125 11.6666 14.625 11.6666H39.375C40.0875 11.6666 40.7344 11.8805 41.3156 12.3083C41.8969 12.7361 42.3 13.3 42.525 14L47.25 28V46.6666C47.25 47.3277 47.0344 47.8819 46.6031 48.3291C46.1719 48.7763 45.6375 49 45 49H42.75C42.1125 49 41.5781 48.7763 41.1469 48.3291C40.7156 47.8819 40.5 47.3277 40.5 46.6666V44.3333H13.5ZM13.05 23.3333H40.95L38.5875 16.3333H15.4125L13.05 23.3333ZM16.875 37.3333C17.8125 37.3333 18.6094 36.993 19.2656 36.3125C19.9219 35.6319 20.25 34.8055 20.25 33.8333C20.25 32.8611 19.9219 32.0347 19.2656 31.3541C18.6094 30.6736 17.8125 30.3333 16.875 30.3333C15.9375 30.3333 15.1406 30.6736 14.4844 31.3541C13.8281 32.0347 13.5 32.8611 13.5 33.8333C13.5 34.8055 13.8281 35.6319 14.4844 36.3125C15.1406 36.993 15.9375 37.3333 16.875 37.3333ZM37.125 37.3333C38.0625 37.3333 38.8594 36.993 39.5156 36.3125C40.1719 35.6319 40.5 34.8055 40.5 33.8333C40.5 32.8611 40.1719 32.0347 39.5156 31.3541C38.8594 30.6736 38.0625 30.3333 37.125 30.3333C36.1875 30.3333 35.3906 30.6736 34.7344 31.3541C34.0781 32.0347 33.75 32.8611 33.75 33.8333C33.75 34.8055 34.0781 35.6319 34.7344 36.3125C35.3906 36.993 36.1875 37.3333 37.125 37.3333ZM11.25 39.6666H42.75V28H11.25V39.6666Z"
                        fill="#FEF7FF"
                    />
                </svg>
                <h3>
                    Envios a nivel nacional <br />
                    <span>Envio rápido en todo el Perú</span>
                </h3>
            </div>
            <div class="carta3">
                <svg
                    width="40"
                    height="45"
                    viewBox="0 0 40 45"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M20 34.2857C21.3261 34.2857 22.5979 33.8342 23.5355 33.0305C24.4732 32.2267 25 31.1366 25 30C25 27.6214 22.75 25.7143 20 25.7143C18.6739 25.7143 17.4021 26.1658 16.4645 26.9695C15.5268 27.7733 15 28.8634 15 30C15 31.1366 15.5268 32.2267 16.4645 33.0305C17.4021 33.8342 18.6739 34.2857 20 34.2857ZM35 15C36.3261 15 37.5979 15.4515 38.5355 16.2553C39.4732 17.059 40 18.1491 40 19.2857V40.7143C40 41.8509 39.4732 42.941 38.5355 43.7447C37.5979 44.5485 36.3261 45 35 45H5C3.67392 45 2.40215 44.5485 1.46447 43.7447C0.526784 42.941 0 41.8509 0 40.7143V19.2857C0 16.9071 2.25 15 5 15H7.5V10.7143C7.5 7.87268 8.81696 5.14746 11.1612 3.13814C13.5054 1.12882 16.6848 0 20 0C21.6415 0 23.267 0.277133 24.7835 0.815576C26.3001 1.35402 27.6781 2.14323 28.8388 3.13814C29.9996 4.13305 30.9203 5.31419 31.5485 6.61411C32.1767 7.91402 32.5 9.30727 32.5 10.7143V15H35ZM20 4.28571C18.0109 4.28571 16.1032 4.96301 14.6967 6.1686C13.2902 7.37419 12.5 9.00932 12.5 10.7143V15H27.5V10.7143C27.5 9.00932 26.7098 7.37419 25.3033 6.1686C23.8968 4.96301 21.9891 4.28571 20 4.28571Z"
                        fill="white"
                    />
                </svg>
                <h3>
                    Pagos 100% seguros <br />
                    <span>Pagos totalmente confiables</span>
                </h3>
            </div>
            <div class="carta4">
                <svg
                    width="58"
                    height="45"
                    viewBox="0 0 58 45"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M16.9167 22.5C22.2333 22.5 26.5833 17.4375 26.5833 11.25C26.5833 5.0625 22.2333 0 16.9167 0C11.6 0 7.25 5.0625 7.25 11.25C7.25 17.4375 11.6 22.5 16.9167 22.5ZM26.5833 45V30.0937C23.925 28.9687 20.5417 28.125 16.9167 28.125C7.49167 28.125 0 33.1875 0 39.375V45H26.5833ZM36.25 0C33.5917 0 31.4167 2.53125 31.4167 5.625V39.375C31.4167 42.4688 33.5917 45 36.25 45H53.1667C55.825 45 58 42.4688 58 39.375V5.625C58 2.53125 55.825 0 53.1667 0H36.25Z"
                        fill="white"
                    />
                </svg>
                <h3>
                    Atención al cliente <br />
                    <span>Atención personalizada</span>
                </h3>
            </div>
        </section>
        <section class="cuerpo" >
            <div class="carrusel-container">
    <div class="carrusel-track">
        @foreach($marcas as $marca)
            <img src="{{ asset('images/marcas/' . $marca->imagen) }}" alt="{{ $marca->id }}">
        @endforeach
        @foreach($marcas as $marca)
            <img src="{{ asset('images/marcas/' . $marca->imagen) }}" alt="{{ $marca->id }}">
        @endforeach
    </div>
</div>


<div class="head-productos" data-aos="fade-up" >
    <h3 class="h">Lo más vendido del mes</h3>

    <div class="tabs">
        <a
            href="{{ route('index') }}"
            class="category-btn {{ !request('categoria') ? 'active' : '' }}"
        >
            TODOS
        </a>
        @foreach($categorias as $categoria)
            <a
                href="{{ route('index', ['categoria' => $categoria->id]) }}"
                class="category-btn {{ request('categoria') == $categoria->id ? 'active' : '' }}"
            >
                {{ strtoupper($categoria->nombre) }}
            </a>
        @endforeach 
    </div>
<script>
    
</script>
    <div class="contenedor-flex"> 
        @foreach($productosDelMes as $producto)
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
        @endforeach
    </div>
</div>


                <style>
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
                        height: 380px;
                        flex-shrink: 0;
                    }
                    .contenedor-flex {
                        display: flex;
                        flex-wrap: wrap; 
                        gap: 20px;
                        margin-top: 60px;
                        justify-content: center;
                        max-width: 1500px;
                        margin-left: auto;
                        margin-right: auto;
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
        const searchInput = document.querySelector('input[name="search"]');
    const form = document.getElementById('filterForm');

    searchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            form.submit();   
        }
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
            </div>

            <section class="nuestra-categoria" data-aos="fade-up" >
                <h3>Nuestra Categoria</h3>
                <div class="botones-categoria">
                    <a href="products?categoria=7">
                        <div class="categoria">
                            <p>CREATINAS</p>
                            <img
                                src="imagenes/Producto_1-removebg-preview.png"
                                alt=""
                            />
                        </div>
                    </a>
                    <a href="">
                        <div class="categoria">
                            <p>PROTEINAS</p>
                            <img
                                src="imagenes/Proteinas/Whey_Protein_Powder_for_Women_Vanilla_Powder_-_Low_Carb_Gluten-Free_Grass-Fed_-proteinaFrente-removebg-preview.png"
                                alt=""
                            />
                        </div>
                    </a>
                    <a href="/products?categoria=14">
                        <div class="categoria">
                            <p>GANADORES DE PESO</p>
                            <img
                                src="imagenes/Ganadores de peso/Proteina_Ganador_Mutant_Mass_5_Libras_Sabor_Vainilla-ganadores_de_masaGfrente-removebg-preview.png"
                                alt=""
                            />
                        </div>
                    </a>
                    <a href="/products?categoria=15">
                        <div class="categoria">
                            <p>QUEMADORES DE GRASA</p>
                            <img
                                src="imagenes/Quemadores de grasa/Veltryx_Quemador_De_Grasa_Natural_Activa_Ampk_Quita_Antojos-quemadoresgrasaJfrente-removebg-preview.png"
                                alt=""
                            />
                        </div>
                    </a>
                    <a href="/products?categoria=16">
                        <div class="categoria">
                            <p>BARRAS ENERGÉTICAS</p>
                            <img
                                src="imagenes/Barras-Energeticas/Galletas_Energéticas_Stroopwafel_Campfire_Smores_Gu_Energy-barrasenergeticasAfrente-removebg-preview.png"
                                alt=""
                            />
                        </div>
                    </a>
                    <a href="/products?categoria=17">
                        <div class="categoria">
                            <p>VITAMINAS Y OTROS</p>
                            <img
                                src="imagenes/vitaminas y otros/Metabolic_Vitamins-vitaminas_y_otros-removebg-preview.png"
                                alt=""
                            />
                        </div>
                    </a>
                </div>
            </section>
            <section class="Objetivos" data-aos="fade-up" >
                <h3>Cuentanos, ¿Cuál es tu objetivo?</h3>
                <div class="objetivos-cards">
                    <a href="products?objetivo=3" class=""
                        ><div class="objetivo1">
                            <p>GANANCIA MUSCULAR</p>
                        </div></a
                    >
                    <a href="products?objetivo=1" class=""
                        ><div class="objetivo2">
                            <p>PERDIDA DE PESO Y TONIFICACION</p>
                        </div></a
                    >
                    <a href="/products?objetivo=7" class=""
                        ><div class="objetivo3"><p>BIENESTAR</p></div></a
                    >
                    <a href="/products?objetivo=6" class=""
                        ><div class="objetivo4">
                            <p>RECUPERACIÓN MUSCULAR</p>
                        </div></a
                    >
                </div>
            </section>

            <div class="separador">
                <p>Únete a TecsupFit y potencia tu mejor versión</p>
            </div>
        </section>
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
</html>
    </body>
    @extends('components.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="productos-index.js"></script>
    <script src="carruceles.js"></script>
</html>
<style>
    body {
        margin: 0;
        margin: 1.5px;
        padding: 0;
    }
    /* Carrusel */
    .carrucel-imagen img {
        width: 1519px;
    }

    .etiquetas {
        display: flex;
        justify-content: space-around;
        margin: 30px;
        flex-wrap: wrap;
    }

    .etiquetas p,
    span {
        color: #fff;
        text-align: center;
        font-family: "Crimson Text";
        font-size: 15px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
    }

    .carta1,
    .carta2,
    .carta3,
    .carta4 {
        display: flex;
        padding: 20px;
        justify-content: center;
    }

    .carta2,
    .carta3,
    .carta4 {
        border-left: 2px solid white;
        height: 92px;
        padding-left: 54px;
    }
    @media screen and (max-width: 768px) {
        .carta2,
        .carta3,
        .carta4 {
            border-left: none;
            padding-left: 0px;
        }
    }
    @media screen and (max-width: 1200px) {
        .carta2,
        .carta3,
        .carta4 {
            border-left: none;
            padding-left: 0px;
        }
    }

    .carta2 h3,
    .carta3 h3,
    .carta4 h3 {
        color: #fff;
        text-align: start;
        font-family: "Crimson Text";
        font-size: 20px;
        font-style: normal;
        font-weight: 700;
        line-height: 26px;
        padding-left: 25px;
    }
    .carta1 p {
        text-align: start;
        line-height: 26px;
        padding-left: 25px;
    }
    .boton-imagen-inicio {
        background-color: transparent;
        width: 290px;
        height: 60px;
        position: absolute;
        z-index: 1;
        left: 990px;
        border-radius: 30px;
        top: 400px;
    }

    /*seccion de productos*/
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

    .cuerpo {
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

    .products {
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

    .Contenedores_productos {
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
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    .product-card {
        background: #fff;
        border-radius: 10px;
        padding: 15px;
        width: 286px;
        height: 430px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: start;
    }

    .product-card a {
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
        background: linear-gradient(90deg, #000000 60%, #b1b1b1 100%);
        border-radius: 5px;
        transition: width 0.4s;
    }
    /*Carrucel-2*/
    .carrusel-container {
        width: 100%;
        overflow: hidden;
        padding-top: 4rem;
        height:200px;
    }

    .carrusel-track {
        display: flex;
        gap: 20px;
        padding: 20px;
        animation: slide 40s linear infinite; 
    }

    .carrusel-track img {
        width: 200px;
        height: 120px;
        object-fit: contain;
        border-radius: 10px;
        transition: transform 0.3s;
    }

    .carrusel-track img:hover {
        transform: scale(1.1);
    }

    @keyframes slide {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    /*CATEGORIAS*/
    .nuestra-categoria {
        margin-top: 12rem;
        padding-top: 2rem;
        padding: 0%;
        padding-left: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .nuestra-categoria h3 {
        color: #000;
        font-family: "Crimson Text";
        font-size: 30px;
        font-style: normal;
        font-weight: 600;
        line-height: normal;
        align-self: start;
    }
    .botones-categoria {
        display: grid;
        grid-template-columns: auto auto auto;
        margin-top: 4rem;
        width: 1340px;
        height: 292px;
    }
    .botones-categoria a {
        width: 433px;
        height: 131px;
        margin: 0px;
        padding: 0px;
        text-decoration: none;
    }
    .categoria {
        background-color: white;
        backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid #ccc;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        width: 433px;
        height: 131px;
        flex-shrink: 0;
        box-sizing: border-box;
        padding: 10px;
        transition: all 0.3s ease;
    }
    .categoria:hover {
        transform: scale(1.05);
        transition: all 0.3s ease;
        background-color: black;
    }

    .categoria img {
        width: 84.571px;
        height: 101px;
    }
    .categoria p {
        text-decoration: none;
        color: black;
        font-family: "Crimson Text";
        font-size: 15px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        transition: all 0.3s ease;
    }
    .categoria:hover p {
        color: white;
    }

    /*OBJETIVOS*/
    .Objetivos {
        margin-top: 9rem;
    }
    .Objetivos h3 {
        color: #000;
        font-family: "Crimson Text";
        font-size: 30px;
        font-style: normal;
        font-weight: 600;
        line-height: normal;
        margin-left: 40px;
    }
    .objetivos-cards {
        display: flex;
        justify-content: space-around;
        margin-top: 4rem;
        flex-wrap: wrap;
    }
    .objetivos-cards a {
        text-decoration: none;
        width: 349.792px;
        height: 365px;
        transition: all 0.3s ease;
        flex-wrap: wrap;
    }
    .objetivos-cards a:hover {
        scale: 1.1;
        transition: all 0.3s ease;
    }
    .objetivo1 {
        background-image: url(imagenes/imgObjetivo/imgobjetivoGananciamuscular.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 400px;
        height: 400px;
    }

    .objetivo2 {
        background-image: url(imagenes/imgObjetivo/imgobjetivoPerdidapeso.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 400px;
        height: 400px;
    }
    .objetivo3 {
        background-image: url(imagenes/imgObjetivo/imhobjetivogananciaEnergia.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 400px;
        height: 400px;
    }
    .objetivo4 {
        background-image: url(imagenes/imgObjetivo/imgobjetivorecuperacionmuscular.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        width: 400px;
        height: 400px;
    }
    .objetivo1,
    .objetivo2,
    .objetivo3,
    .objetivo4 {
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 349.792px;
        height: 365px;
    }
    .objetivo1 p,
    .objetivo2 p,
    .objetivo3 p,
    .objetivo4 p {
        text-decoration: none;
        color: #fff;
        padding-top: 9rem;
        font-family: "Crimson Text";
        font-size: 20px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }
    .objetivo2 {
        padding-left: 1.5rem;
    }

    /*OPINIONES*/
    .opiniones-clientes {
        margin: 40px 0 30px 0;
        background: #fafafa;
        padding: 30px 0 10px 0;
        margin-top: 4rem;
    }
    .opiniones-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
        margin-left: 20px;
    }
    .opiniones-header h3 {
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0;
    }
    .opiniones-header .ver-mas {
        font-size: 0.95rem;
        color: #888;
    }
    .opiniones-header .ver-mas a {
        color: #888;
        text-decoration: none;
    }
    .opiniones-carrusel {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 98vw;
        margin: 0 auto;
    }
    .opiniones-prev,
    .opiniones-next {
        background: none;
        border: none;
        font-size: 2rem;
        color: #222;
        cursor: pointer;
        padding: 0 18px;
        transition: color 0.2s;
    }
    .opiniones-prev:hover,
    .opiniones-next:hover {
        color: #f7b500;
    }
    .opiniones-list {
        display: flex;
        gap: 60px;
        flex: 1;
        justify-content: center;
    }
    .opinion-item {
        background: none;
        max-width: 340px;
        min-width: 260px;
        padding: 0 10px;
        text-align: left;
    }
    .opinion-item p {
        color: #444;
        font-size: 1rem;
        margin-bottom: 18px;
        min-height: 56px;
    }
    .opinion-info {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
        font-weight: 500;
    }
    .opinion-nombre {
        color: #222;
    }
    .opinion-fecha {
        color: #888;
        font-size: 0.98rem;
    }
    .opinion-estrellas .stars {
        color: #ffc107;
        font-size: 1.1rem;
        margin-left: 4px;
    }
    @media (max-width: 900px) {
        .opiniones-list {
            gap: 20px;
        }
        .opinion-item {
            max-width: 220px;
            min-width: 160px;
        }
    }
    @media (max-width: 600px) {
        .opiniones-header {
            margin-left: 8px;
        }
        .opiniones-list {
            flex-direction: column;
            gap: 10px;
            align-items: center;
        }
        .opinion-item {
            max-width: 98vw;
            min-width: 0;
        }
        .opiniones-carrusel {
            gap: 0;
        }
    }

    /*OFERTAS*/

    .ofertas {
        background: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 32px 24px 40px 24px;
        margin-top: 6rem;
        margin-bottom: 4rem;
        min-height: 120px;
        margin-left: 40px;
    }

    .ofertas-info h3 {
        font-size: 1.6rem;
        font-weight: 700;
        margin: 0 0 4px 0;
        color: #181818;
        font-family: "Crimson Text", serif;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .icono-mail {
        font-size: 1.3em;
        margin-right: 5px;
    }

    .ofertas-info p {
        color: #555;
        font-size: 1.08rem;
        margin: 0;
        font-family: "Crimson Text", serif;
        max-width: 650px;
    }

    .ofertas-btn {
        margin-right: 60px;
    }

    .ofertas-btn button {
        background: #111;
        color: #fff;
        font-family: "Crimson Text";
        font-size: 28px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        border: none;
        padding: 16px 38px;
        border-radius: 0;
        cursor: pointer;
        transition: all 0.4s ease-in-out;
    }

    .ofertas-btn button:hover {
        background: #a10000;
    }

    @media (max-width: 900px) {
        .ofertas {
            flex-direction: column;
            align-items: flex-start;
            gap: 18px;
            padding: 24px 10px 30px 10px;
        }
        .ofertas-btn {
            margin-right: 0;
            align-self: flex-end;
        }
    }

    /*SEPARADOR*/
    .separador {
        background-color: #a70608;
        width: 100%;
        height: 134px;
        margin: 0 auto;
        margin-top: 2rem;
        align-items: center;
        text-align: center;
        display: flex;
        justify-content: center;
    }
    .separador p {
        color: #fff;
        font-family: "Crimson Text";
        font-size: 35px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }

    /*FOOTER*/

    footer {
        background-color: #000;
        color: white;
        font-size: 14px;
        padding-top: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .footer-container {
        display: flex;
        justify-content: center;
        gap: 130px;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 120px;
    }

    .subscribe-section {
        flex: 1 1 250px;
        max-width: 490px;
    }

    .subscribe-section h4 {
        margin-bottom: 10px;
    }

    .subscribe-form {
        display: flex;
        margin-bottom: 10px;
    }

    .subscribe-form input {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto",
            "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans",
            "Helvetica Neue", sans-serif;
        font-weight: 500;
        font-size: 0.8vw;
        color: #fff;
        background-color: rgb(28, 28, 30);
        box-shadow: 0 0 0.4vw rgba(0, 0, 0, 0.5), 0 0 0 0.15vw transparent;
        border-radius: 0.4vw;
        border: none;
        outline: none;
        padding: 0.4vw;
        width: 490px;
        transition: 0.4s;
    }

    .subscribe-form input:hover {
        box-shadow: 0 0 0 0.15vw rgba(135, 207, 235, 0.186);
    }

    .subscribe-form input:focus {
        box-shadow: 0 0 0 0.15vw skyblue;
    }

    .subscribe-form button {
        background-color: #888;
        color: white;
        border: none;
        padding: 8px 15px;
        cursor: pointer;
    }

</style>
