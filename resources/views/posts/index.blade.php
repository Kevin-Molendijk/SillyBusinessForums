<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Alle Posts</h2>
    </x-slot>

    <div class="container mx-auto py-6 space-y-6">
        @if($posts->isEmpty())
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <p>Geen posts gevonden.</p>
            </div>
        @else
            @foreach($posts as $post)
                <div class="bg-white p-6 shadow-sm rounded-lg">
                    <a href="{{ route('posts.show', $post->id) }}" class="font-semibold text-lg">{{ $post->title }}</a>
                    <p>{{ Str::limit($post->content, 100) }}</p>
                    <p class="text-gray-600 text-sm">Categorie: {{ $post->category ? $post->category->name : 'Geen categorie' }}</p>
                </div>
            @endforeach
        @endif
    </div>

</x-app-layout>
