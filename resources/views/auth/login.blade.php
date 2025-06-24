<div>
    @component('components.navtecsupfit')
    @endcomponent
</div>
<x-guest-layout>
    <div class="Contenedor-total">
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />
    <form method="POST" action="{{ route('login') }}" style="width:400px">
        @csrf
        <h2>ACCEDER</h2>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Dirección de correo electrónico ')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        
        <div >
            

            <x-primary-button>
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>
        <div style="display:flex;">
            <div>
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span style="font-size:15px;">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div  style="margin-left:auto;">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="color:red; font-size:13px">
                    {{ __('¿Has perdido tu contraseña?') }}
                </a>
                @endif
            </div>
        </div>
    </form>
    <div class="Texto_acceder">
                <h2>
                    REGISTRO

                </h2>
                <p>Registrarse en este sitio le permite acceder al estado y al historial de su pedido. Simplemente complete los campos a continuación y  configuraremos una nueva cuenta para usted en poco tiempo. Sólo te  pediremos los datos necesarios para que el proceso de compra sea más  rápido y sencillo. </p>
                <a href="/register" class="boton_acceder">{{ __('Registrar') }}</a>
    </div>
        
</div>
</x-guest-layout>
<div>
        @component('components.footer')
        @endcomponent
    </div>
<style>
    .Contenedor-total{
        display:flex; 
        justify-content:space-around;
    }
    .boton_acceder{
        background-color: #000;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
        margin-bottom: 20px;
    }
    .texto_acceder {
        text-align: center;
        width: 500px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .texto_acceder h2{
        padding-bottom: 55px;
    }
    .texto_acceder p{
        padding-bottom: 20px;
        width: 493px;
        text-align:start;
    }
</style>