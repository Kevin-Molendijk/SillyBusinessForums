<!-- resources/views/home.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold mb-4 text-center">
            {{ __('Welcome to the Forum!') }}
        </h2>
    </x-slot>

    <div class="text-center">
        <p>This is the home page of the forum application. Feel free to browse around and participate!</p>
    </div>
    <div class="max-w-xl mx-auto">
    </div>
</x-app-layout>
