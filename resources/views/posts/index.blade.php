<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach ($posts as $post)
            <a href="{{ route('posts.show', $post) }}" class="block">
                <div class="bg-white shadow-sm sm:rounded-lg mb-4 p-6 hover:bg-gray-100 transition">
                    <h3 class="font-bold text-xl">{{ $post->title }}</h3>
                    <p class="text-gray-700">{{ Str::limit($post->content, 100) }}</p>
                    <p class="text-sm text-gray-500">By {{ $post->user->name }} | {{ $post->created_at->format('M d, Y') }}</p>
                </div>
            </a>

            @if (auth()->id() === $post->user_id)
                <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:underline">Edit</a>
            @endif
        @endforeach
    </div>
</x-app-layout>
