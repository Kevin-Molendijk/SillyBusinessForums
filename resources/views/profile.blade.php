<!-- resources/views/profile.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mijn Profiel') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6 space-y-6">
        <div class="bg-white p-6 shadow-sm rounded-lg">
            <h3 class="font-semibold text-lg">Welkom, {{ $user->name }}</h3>
            <p>Email: {{ $user->email }}</p>
        </div>
        <div>
            <!-- Bewerk profiel knop -->
            <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">
                Bewerk Profiel
            </a>
        </div>

        <h3 class="font-semibold text-lg mt-6">Mijn Posts</h3>
        @foreach ($posts as $post)
            <div class="bg-white p-6 shadow-sm rounded-lg mt-4">
                <h4 class="font-semibold">{{ $post->title }}</h4>
                <p>{{ $post->content }}</p>
                <p>Status: {{ $post->hidden ? 'Verborgen' : 'Zichtbaar' }}</p>
            </div>

            @if(auth()->id() === $post->user_id)
                <button class="toggle-hidden-btn" data-post-id="{{ $post->id }}">
                    {{ $post->hidden ? 'Unhide' : 'Hide' }}
                </button>
            @endif

        @endforeach
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.toggle-hidden-btn').on('click', function() {
                var button = $(this);
                var postId = button.data('post-id');

                $.ajax({
                    url: `/posts/${postId}/toggle-hidden`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.hidden) {
                            button.text('Unhide');
                        } else {
                            button.text('Hide');
                        }
                    },
                    error: function(xhr) {
                        alert('Er is een fout opgetreden: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>

</x-app-layout>
