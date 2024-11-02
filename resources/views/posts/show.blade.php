<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm rounded-lg mb-4">
            <h3 class="font-bold text-lg">{{ $post->title }}</h3>
            <p class="text-gray-700">{{ $post->content }}</p>
            <p class="text-sm text-gray-500 mt-2">Geplaatst door: {{ $post->user->name }} op {{ $post->created_at->format('M d, Y') }}</p>
        </div>

        <!-- Comment Form -->
        <div class="bg-white p-6 shadow-sm rounded-lg mb-4">
            @auth
                <!-- Form for logged-in users to leave a comment -->
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700">Reactie</label>
                        <textarea name="content" id="content" rows="4" class="mt-1 block w-full" required></textarea>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Plaats Reactie</button>
                </form>
            @else
                <!-- Message for guests -->
                <p class="text-gray-700">Log in om comments achter te laten.</p>
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Log in</a>
                of <a href="{{ route('register') }}" class="text-blue-600 hover:underline">maak een account aan</a>.
            @endauth
        </div>

        <!-- List of Comments -->
        @foreach ($comments as $comment)
            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                <p class="text-gray-700">{{ $comment->content }}</p>
                <p class="text-sm text-gray-500">
                    Gepubliceerd door {{ $comment->user->name }}
                    op {{ $comment->created_at->format('M d, Y') }}
                </p>
            </div>
        @endforeach
    </div>
</x-app-layout>
