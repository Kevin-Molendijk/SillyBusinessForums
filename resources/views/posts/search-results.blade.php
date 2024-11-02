<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Zoekresultaten voor "{{ $query }}"
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @forelse ($posts as $post)
            <div class="bg-white shadow-sm rounded-lg mb-4 p-6">
                <a href="{{ route('posts.show', $post) }}">
                    <h3 class="font-bold text-xl">{{ $post->title }}</h3>
                </a>
                <p class="text-gray-700">{{ Str::limit($post->content, 100) }}</p>
            </div>
        @empty
            <p class="text-gray-600">Geen resultaten gevonden voor "{{ $query }}"</p>
        @endforelse
    </div>
</x-app-layout>
