
<header>@component('components.navtecsupfit')@endcomponent</header>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-sm sm:rounded-lg" style="border:1px solid black; min-height: 200px;">
                <div class="p-6 text-black-900 dark:text-black-100">
                    <h2 class="text-xl font-bold mb-4">Tu informacion: {{ Auth::user()->name }} </h2>
                    <ul class="space-y-2">
                        <li><strong>Nombre:</strong> {{ Auth::user()->name }}</li>
                        <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                        <li><strong>Teléfono:</strong> {{ Auth::user()->telefono ?? 'No registrado' }}</li>
                        <li><strong>Dirección:</strong> {{ Auth::user()->direccion ?? 'No registrada' }}</li>
                        <li><strong>Rol:</strong> {{ Auth::user()->is_admin ? 'Administrador' : 'Cliente' }}</li>
                        <li><strong>Registrado en:</strong> {{ Auth::user()->created_at->format('d/m/Y H:i') }}</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
@extends('components.footer')