<body>
    <nav class="side-bar">
        <div class="contenedor-logo">
            <a href="">
                <!-- logo aki si kieres -->
            </a>
        </div>
        <div class="directorios">
            <div class="directorios-productos">
                <a href="/productos" class="directorios-productos-link">
                    <!-- carrito svg -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-shopping-cart">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h10.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <p>Productos</p>
                </a>
            </div>
            <div class="directorios-pedidos">
                <a href="/admin/pedidos" class="directorios-productos-link">
                    <!-- pedidos svg -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-file-text">
                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                        <polyline points="13 2 13 9 20 9"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9.01 9.01"></polyline>
                    </svg>
                    <p>Pedidos</p>
                </a>
            </div>
            <div class="directorios-cupones">
                <a href="/cupones" class="directorios-productos-link">
                    <!-- cupon svg -->
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" stroke-width="0.024">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.75 6.75L4.5 6H20.25L21 6.75V10.7812H20.25C19.5769 10.7812 19.0312 11.3269 19.0312 12C19.0312 12.6731 19.5769 13.2188 20.25 13.2188H21V17.25L20.25 18L4.5 18L3.75 17.25V13.2188H4.5C5.1731 13.2188 5.71875 12.6731 5.71875 12C5.71875 11.3269 5.1731 10.7812 4.5 10.7812H3.75V6.75ZM5.25 7.5V9.38602C6.38677 9.71157 7.21875 10.7586 7.21875 12C7.21875 13.2414 6.38677 14.2884 5.25 14.614V16.5L9 16.5L9 7.5H5.25ZM10.5 7.5V16.5L19.5 16.5V14.614C18.3632 14.2884 17.5312 13.2414 17.5312 12C17.5312 10.7586 18.3632 9.71157 19.5 9.38602V7.5H10.5Z" fill="#ffffff"/>
                    </svg>
                    <p>Cupones</p>
                </a>
            </div>
            <div class="directorios-reclamaciones">
                <a href="/reclamaciones" class="directorios-productos-link">
                    <!-- reclamos svg -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-message-circle">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 7.5 7.5v.5z"></path>
                    </svg>
                    <p>Reclamaciones</p>
                </a>
            </div>
            <div class="Configuraciones">
                <div class="configuraciones-cuenta" onclick="toggleMenu()">
                    <a href="#" class="directorios-productos-link">
                        <!-- config svg -->
                        <svg width="24px" height="24px" viewBox="0 0 28 28" fill="none"
                            xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" stroke-width="0.00028">
                            <path clip-rule="evenodd"
                                d="M14 20C17.3137 20 20 17.3137 20 14C20 10.6863 17.3137 8 14 8C10.6863 8 8 10.6863 8 14C8 17.3137 10.6863 20 14 20ZM18 14C18 16.2091 16.2091 18 14 18C11.7909 18 10 16.2091 10 14C10 11.7909 11.7909 10 14 10C16.2091 10 18 11.7909 18 14Z"
                                fill="#ffffff" fill-rule="evenodd" />
                            <path clip-rule="evenodd"
                                d="M0 12.9996V14.9996C0 16.5478 1.17261 17.822 2.67809 17.9826C2.80588 18.3459 2.95062 18.7011 3.11133 19.0473C2.12484 20.226 2.18536 21.984 3.29291 23.0916L4.70712 24.5058C5.78946 25.5881 7.49305 25.6706 8.67003 24.7531C9.1044 24.9688 9.55383 25.159 10.0163 25.3218C10.1769 26.8273 11.4511 28 12.9993 28H14.9993C16.5471 28 17.8211 26.8279 17.9821 25.3228C18.4024 25.175 18.8119 25.0046 19.2091 24.8129C20.3823 25.6664 22.0344 25.564 23.0926 24.5058L24.5068 23.0916C25.565 22.0334 25.6674 20.3813 24.814 19.2081C25.0054 18.8113 25.1757 18.4023 25.3234 17.9824C26.8282 17.8211 28 16.5472 28 14.9996V12.9996C28 11.452 26.8282 10.1782 25.3234 10.0169C25.1605 9.55375 24.9701 9.10374 24.7541 8.66883C25.6708 7.49189 25.5882 5.78888 24.5061 4.70681L23.0919 3.29259C21.9846 2.18531 20.2271 2.12455 19.0485 3.1103C18.7017 2.94935 18.3459 2.80441 17.982 2.67647C17.8207 1.17177 16.5468 0 14.9993 0H12.9993C11.4514 0 10.1773 1.17231 10.0164 2.6775C9.60779 2.8213 9.20936 2.98653 8.82251 3.17181C7.64444 2.12251 5.83764 2.16276 4.70782 3.29259L3.2936 4.7068C2.16377 5.83664 2.12352 7.64345 3.17285 8.82152C2.98737 9.20877 2.82199 9.60763 2.67809 10.0167C1.17261 10.1773 0 11.4515 0 12.9996ZM15.9993 3C15.9993 2.44772 15.5516 2 14.9993 2H12.9993C12.447 2 11.9993 2.44772 11.9993 3V3.38269C11.9993 3.85823 11.6626 4.26276 11.2059 4.39542C10.4966 4.60148 9.81974 4.88401 9.18495 5.23348C8.76836 5.46282 8.24425 5.41481 7.90799 5.07855L7.53624 4.70681C7.14572 4.31628 6.51256 4.31628 6.12203 4.7068L4.70782 6.12102C4.31729 6.51154 4.31729 7.14471 4.70782 7.53523L5.07958 7.90699C5.41584 8.24325 5.46385 8.76736 5.23451 9.18395C4.88485 9.8191 4.6022 10.4963 4.39611 11.2061C4.2635 11.6629 3.85894 11.9996 3.38334 11.9996H3C2.44772 11.9996 2 12.4474 2 12.9996V14.9996C2 15.5519 2.44772 15.9996 3 15.9996H3.38334C3.85894 15.9996 4.26349 16.3364 4.39611 16.7931C4.58954 17.4594 4.85042 18.0969 5.17085 18.6979C5.39202 19.1127 5.34095 19.6293 5.00855 19.9617L4.70712 20.2632C4.3166 20.6537 4.3166 21.2868 4.70712 21.6774L6.12134 23.0916C6.51186 23.4821 7.14503 23.4821 7.53555 23.0916L7.77887 22.8483C8.11899 22.5081 8.65055 22.4633 9.06879 22.7008C9.73695 23.0804 10.4531 23.3852 11.2059 23.6039C11.6626 23.7365 11.9993 24.1411 11.9993 24.6166V25C11.9993 25.5523 12.447 26 12.9993 26H14.9993C15.5516 26 15.9993 25.5523 15.9993 25V24.6174C15.9993 24.1418 16.3361 23.7372 16.7929 23.6046C17.5032 23.3985 18.1809 23.1157 18.8164 22.7658C19.233 22.5365 19.7571 22.5845 20.0934 22.9208L20.2642 23.0916C20.6547 23.4821 21.2879 23.4821 21.6784 23.0916L23.0926 21.6774C23.4831 21.2868 23.4831 20.6537 23.0926 20.2632L22.9218 20.0924C22.5855 19.7561 22.5375 19.232 22.7669 18.8154C23.1166 18.1802 23.3992 17.503 23.6053 16.7931C23.7379 16.3364 24.1425 15.9996 24.6181 15.9996H25C25.5523 15.9996 26 15.5519 26 14.9996V12.9996C26 12.4474 25.5523 11.9996 25 11.9996H24.6181C24.1425 11.9996 23.7379 11.6629 23.6053 11.2061C23.3866 10.4529 23.0817 9.73627 22.7019 9.06773C22.4643 8.64949 22.5092 8.11793 22.8493 7.77781L23.0919 7.53523C23.4824 7.14471 23.4824 6.51154 23.0919 6.12102L21.6777 4.7068C21.2872 4.31628 20.654 4.31628 20.2635 4.7068L19.9628 5.00748C19.6304 5.33988 19.1137 5.39096 18.6989 5.16979C18.0976 4.84915 17.4596 4.58815 16.7929 4.39467C16.3361 4.2621 15.9993 3.85752 15.9993 3.38187V3Z"
                                fill="#ffffff" fill-rule="evenodd" />
                        </svg>
                        <p>Configuraciones</p>
                    </a>
                </div>
                <div class="submenu" id="submenu">
                    <a href="/dashboard">Cuenta</a>
                    <a href="/admin/usuarios">Cuentas Usuarios</a>
                </div>
            </div>
        </div>
    </nav>
</body>

<style>
    body {
        margin: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .side-bar {
        background-color: black;
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 2rem;
        box-sizing: border-box;
        position: sticky;
        top: 0;
        z-index: 100;
    }
    .directorios {
        display: flex;
        flex-direction: row;
        gap: 2rem;
    }
    .contenedor-logo a {
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        text-decoration: none;
    }
    .directorios-productos-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: white;
        text-decoration: none;
        transition: transform 0.3s ease;
    }
    .directorios-productos-link:hover {
        transform: scale(1.05);
    }
    .directorios-productos-link p {
        margin: 0;
    }
    .Configuraciones {
        position: relative;
    }
    .configuraciones-cuenta {
        cursor: pointer;
        color: white;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .submenu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: black;
        flex-direction: column;
        min-width: 180px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        z-index: 99;
    }
    .submenu a {
        padding: 10px;
        text-decoration: none;
        color: white;
        transition: all 0.2s ease;
    }
    .submenu a:hover {
        background-color: #333;
    }
    /* boton hamburguesa pa moviles */
    .hamburger-btn {
        display: none;
        position: fixed;
        top: 1rem;
        left: 1rem;
        background-color: black;
        color: black;
        border: none;
        font-size: 2rem;
        z-index: 50;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        cursor: pointer;
    }
    /* responsive pa celus */
    @media (max-width: 768px) {
        .side-bar {
            flex-direction: column;
            align-items: flex-start;
        }
        .directorios {
            flex-direction: column;
            width: 100%;
            gap: 1rem;
            margin-top: 1rem;
        }
        .submenu {
            position: static;
            width: 100%;
        }
    }
</style>

<script>
    // pa mostrar el menu de config, bien basico
    function toggleMenu() {
        const submenu = document.getElementById('submenu');
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    }
</script>
