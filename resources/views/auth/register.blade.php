<head>
    @component('components.navtecsupfit')
    @endcomponent
</head>

<body>
<x-guest-layout>
    <div class="Contenedor-total" >
    <form method="POST" action="{{ route('register') }}" style="width:400px; margin-bottom:2rem;">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Dirección -->
        <div>
            <x-input-label for="direccion" :value="__('Dirección')" />
            <x-text-input id="direccion" name="direccion" type="text" class="mt-1 block w-full" :value="old('direccion')" required />
            <x-input-error :messages="$errors->get('direccion')" />
        </div>

        <!-- Teléfono -->
        <div>
            <x-input-label for="telefono" :value="__('Teléfono')" />
            <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full" :value="old('telefono')" required />
            <x-input-error :messages="$errors->get('telefono')" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('¿Ya estas registrado?') }}
            </a>

            <x-primary-button class="ms-4" >
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
    <div class="Texto_acceder">
                <h2>
                    Logueo
                </h2>
                <p>¿Ya tienes una cuenta creada? Entonces inicia sesion para poder acceder a TecsupFit </p>
                <a href="{{ route('login') }}"><button class="boton_acceder">Acceder</button></a>
     </div>
</div>
</x-guest-layout>
    <div>
        @component('components.footer')
        @endcomponent
    </div>
</body>

<style>
    body{
        margin-top:1px;
    }    
    .Contenedor-total{
        display:flex; 
        justify-content:space-around;
        margin-bottom:5rem;
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
</style>
