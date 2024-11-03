<!-- resources/views/posts/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6 space-y-6">
        @foreach($posts as $post)
            <!-- Alleen zichtbare posts of posts van de eigenaar/admin worden getoond -->
            @if (!$post->hidden || (auth()->check() && (auth()->user()->is_admin || auth()->id() == $post->user_id)))
                <div class="bg-white p-6 shadow-sm rounded-lg mb-4">
                    <a href="{{ route('posts.show', $post->id) }}" class="font-semibold text-lg">
                        {{ $post->title }}
                    </a>
                    <p>{{ Str::limit($post->content, 100) }}</p>
                    <p class="text-gray-600 text-sm">Categorie: {{ $post->category->name ?? 'Geen categorie' }}</p>

                    <!-- Alleen tonen aan admins en eigenaren -->
                    @can('toggleHidden', $post)
                        <button class="toggle-hidden-btn" data-post-id="{{ $post->id }}">
                            {{ $post->hidden ? 'Unhide' : 'Hide' }}
                        </button>
                    @endcan
                </div>
            @endif
        @endforeach
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $('.toggle-hidden-btn').click(function() {
            var button = $(this);
            var postId = button.data('post-id');

            $.ajax({
                url: '/posts/' + postId + '/toggle-hidden',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.status === 'success') {
                        // Update de knoptekst
                        button.text(response.hidden ? 'Unhide' : 'Hide');
                        alert(response.message);
                    } else {
                        alert('Er is een fout opgetreden');
                    }
                },
                error: function(xhr) {
                    alert('Fout bij het wijzigen van de zichtbaarheid');
                }
            });
        });
    });
</script>
