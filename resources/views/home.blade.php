<x-frontend-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido a Laravel Breeze') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @livewire('vehicles.table')
    </div>
</x-frontend-layout>