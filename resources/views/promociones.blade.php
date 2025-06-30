<!-- barra de inicio -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/promociones.css">
    <title>Promociones</title>
</head>
<body>
    <header style="background-color: #000000;">
        @component('components.navtecsupfit') 

        @endcomponent
    </header>

<!-- carrusel -->
<div class="position-relative" style="min-height: 300px;">
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="{{ asset('imagenes/ImagenHeader/Promo1.jpg') }}" class="d-block w-100" alt="...">
                <a href="/quemadores_de_grasa.html" class="boton-imagen-inicio"></a>
            </div>

            <div class="carousel-item">
                <img src="{{ asset('imagenes/ImagenHeader/Promo2.jpg') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Tarjeta de cupón sobre el carrusel, esquina superior derecha -->
    <div style="position: absolute; top: 20px; right: 20px; z-index: 10;">
        <!-- Botón tipo "flask" que despliega la tarjeta al pasar el mouse -->
        <div class="flask-coupon-container">
            <button class="flask-btn" type="button">
                <img src="https://cdn-icons-png.flaticon.com/512/616/616494.png" alt="Cupón" style="width: 48px; height: 48px;">
            </button>
            <div class="coupon-card bg-white rounded-lg shadow-xl overflow-hidden border-2 border-red-600 w-72">
                <div class="coupon-header bg-red-600 text-white py-3 px-4 relative">
                    <div class="absolute top-0 right-0 w-16 h-full bg-white transform skew-x-12 origin-right"></div>
                    <h3 class="text-xl font-bold relative z-10">¡OFERTA ESPECIAL!</h3>
                </div>
                <div class="p-5 text-center">
                    <div class="text-4xl font-extrabold text-red-600 mb-2">5% OFF</div>
                    <p class="text-gray-700 mb-4">en toda la tienda</p>
                    <div class="bg-gray-100 p-3 rounded-lg mb-4">
                        <p class="text-sm text-gray-600 mb-1">Usa el código:</p>
                        <div class="bg-black text-white font-mono font-bold py-2 px-4 rounded text-lg tracking-wider">TECFIT</div>
                    </div>
                    <button id="copy-coupon-btn" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">
                        Copiar código
                    </button>
                    <div id="copied-message" style="display:none;" class="mt-2 text-green-600 font-semibold text-sm text-center">¡Código copiado!</div>
                </div>
                <div class="bg-gray-100 px-4 py-2 text-center text-xs text-gray-600">
                    Válido hasta 31/12/2025 • No acumulable con otras promociones
                </div>
            </div>
        </div>
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
    .coupon-card {
        font-family: 'Segoe UI', Roboto, sans-serif;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .coupon-header {
        background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
    }
    
    .coupon-card:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .flask-coupon-container {
        position: relative;
        display: inline-block;
    }
    .flask-btn {
        background: #fff;
        border: 2px solid #e53e3e;
        border-radius: 50%;
        padding: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        cursor: pointer;
        transition: box-shadow 0.2s;
        z-index: 11;
    }
    .flask-btn:hover {
        box-shadow: 0 4px 16px rgba(229,62,62,0.25);
    }
    .coupon-card {
        display: none;
        position: absolute;
        top: 60px;
        right: 0;
        z-index: 12;
        animation: fadeIn 0.3s;
    }
    .flask-coupon-container:hover .coupon-card,
    .flask-coupon-container:focus-within .coupon-card {
        display: block;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
    

<body style="background-color: #F5F5F5;" class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]">
    <div style="display:flex; justify-content:center; align-items:center; margin:3rem;">
        Cupones Validos
    </div>
    @extends('cupones.disponibles')        
    </body>






</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
<style>
  
  /* barra de inicio */
body {
    margin: 0;
    padding: 0;
    background-color: black;
}

/* carrusel */
#carouselExampleSlidesOnly {
  width: 100%;
  height: 163px;
  transition: transform 10s ease-in-out;
  padding-top: 8rem;
  margin-bottom: 8rem;
}

.carousel-inner svg {
  width: 100%;
  height: 100%;

}

/* carrusel */
.carrucel-imagen img {
    width: 1519px;
}


/* productos */
.container {
  max-width: 100%;
  margin: 0;
  padding: 5rem 2rem;
  background-color: #fff;
  border: none;
  box-shadow: none;
}

.feactures{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.feactures .card {
    background-color: #fff;
    padding: 1rem;
    border-radius: 20px;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5); 
}

.feactures .card:hover{
    background-color: #cfcfcf;
    transform: scale(1.05);
}

.feactures .card img{
    width: auto;
    height: auto;
    margin-bottom: 10px;
}

.feactures .card h5{
    margin-bottom: 0.5rem;
    color: #000000;
    font-size: 1.2rem;
    font-weight: 600;
}

.feactures .card h3 {
    font-size: 16px;
    margin: 10px 0;
  }

.feactures .card p,h3 {
    align-self: flex-start;
  }
  .old-price {
    text-decoration: line-through;
    color: #aaa;
    margin: 5px 0;
  }
  
  .price {
    color: #0077cc;
    font-size: 18px;
    font-weight: bold;
    margin: 5px 0;
  }
  
  .cart-controls {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
    margin: 10px 0;
  }
  
  .cart-controls button {
    padding: 5px 10px;
    border: none;
    background-color: #b30000;
    color: white;
    cursor: pointer;
    border-radius: 3px;
  }
  
  .add-btn {
    color: white;
  }
  
  .stock {
    font-size: 12px;
    color: #666;
  }
  

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var copyBtn = document.getElementById('copy-coupon-btn');
    var copiedMsg = document.getElementById('copied-message');
    if(copyBtn && copiedMsg) {
        copyBtn.addEventListener('click', function() {
            var code = 'TECFIT';
            if (navigator.clipboard) {
                navigator.clipboard.writeText(code).then(function() {
                    copiedMsg.style.display = 'block';
                    setTimeout(function() {
                        copiedMsg.style.display = 'none';
                    }, 1500);
                });
            } else {
                // Fallback para navegadores antiguos
                var tempInput = document.createElement('input');
                tempInput.value = code;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                copiedMsg.style.display = 'block';
                setTimeout(function() {
                    copiedMsg.style.display = 'none';
                }, 1500);
            }
        });
    }
});
</script>
</body>
</html>