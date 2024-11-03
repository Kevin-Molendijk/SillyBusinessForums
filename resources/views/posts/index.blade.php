<!-- resources/views/posts/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($category) ? $category->name . ' Posts' : 'All Posts' }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6 space-y-6">
        @foreach($posts as $post)
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <a href="{{ route('posts.show', $post->id) }}" class="font-semibold text-lg">
                    {{ $post->title }}
                </a>
                <p>{{ Str::limit($post->content, 100) }}</p>
                <p class="text-gray-600 text-sm">Categorie: {{ $post->category->name }}</p>
                <p>Categorie: {{ $post->category ? $post->category->name : 'Geen categorie' }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
