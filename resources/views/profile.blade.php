<!-- resources/views/profile/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold mb-4">
            {{ __('Profiel Pagina') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">{{ __('Persoonlijke Gegevens') }}</h3>

                    <div class="mb-4">
                        <strong>{{ __('Naam:') }}</strong> {{ Auth::user()->name }}
                    </div>
                    <div class="mb-4">
                        <strong>{{ __('E-mail:') }}</strong> {{ Auth::user()->email }}
                    </div>

                    <a href="{{ route('profile.edit') }}"
                       class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition">
                        {{ __('Gegevens Aanpassen') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
