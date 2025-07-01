<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @if(file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <!-- Fallback styles for when Vite build is not available -->
            <script src="https://cdn.tailwindcss.com"></script>
            <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
            <style>
                /* Basic fallback styles */
                .font-sans { font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif; }
                .text-gray-900 { color: rgb(17 24 39); }
                .antialiased { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
                .pt-6 { padding-top: 1.5rem; }
                .sm\:pt-0 { padding-top: 0; }
                @media (min-width: 640px) { .sm\:pt-0 { padding-top: 0; } }
            </style>
        @endif
    </head>
    <body class="font-sans text-gray-900 antialiased" >
        <div class=" pt-6 sm:pt-0" id="div_principal">
            <div class="Acceder">
                <h2></h2>
                {{ $slot }}
            </div>
            
        </div>
            
    </body>
    
</html>
<style>
    #div_principal{
        background-color: #fff;
        min-height: 800px;
        width: 100%;
        padding-top:12rem;
        
    }
    .Acceder{
        width: 100%;
        height: 61px;
        background: transparent;
    }
    .Acceder h2 {
        color: #000;
    font-family: 'Inter', sans-serif;
    font-size: 26px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    width: 137px;
height: 37px;
flex-shrink: 0;
    }
    
</style>
