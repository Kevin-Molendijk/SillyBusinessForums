<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Overzicht van Posts') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @foreach ($posts as $post)
            <a href="{{ route('posts.show', $post->id) }}" class="block">
                <div class="bg-white p-6 shadow-sm rounded-lg mb-4 hover:bg-gray-100 transition">
                    <h3 class="font-bold text-lg">{{ $post->title }}</h3>
                    <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($post->content, 150) }}</p>
                    <p class="text-sm text-gray-500 mt-2">
                        Geplaatst door: {{ $post->user->name }} op {{ $post->created_at->format('M d, Y') }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>
