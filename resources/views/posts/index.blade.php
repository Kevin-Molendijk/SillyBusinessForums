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

                    <!-- Toevoegen van de Hide/Unhide-button voor de eigenaar van de post -->
                    @if($post->user_id === auth()->id())
                        <button
                            class="toggle-hidden-btn bg-blue-500 text-white px-4 py-2 rounded-md mt-2"
                            data-post-id="{{ $post->id }}"
                            data-hidden="{{ $post->hidden }}">
                            {{ $post->hidden ? 'Unhide' : 'Hide' }}
                        </button>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    <!-- JavaScript voor Hide/Unhide functionaliteit -->
    <script>
        console.log('JavaScript is loaded and working!');

        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.toggle-hidden-btn');

            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const postId = this.dataset.postId;
                    const isHidden = this.dataset.hidden === 'true';

                    console.log(`Sending request to toggle hidden state for post ID: ${postId}`);

                    fetch(`/posts/${postId}/toggle-hidden`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({})
                    })
                        .then(response => {
                            console.log('Response status:', response.status);
                            return response.json();
                        })
                        .then(data => {
                            console.log('Server response:', data);
                            if (data.hidden !== undefined) {
                                this.dataset.hidden = data.hidden;
                                this.textContent = data.hidden ? 'Unhide' : 'Hide';
                            } else {
                                alert('Er is een fout opgetreden bij het updaten van de zichtbaarheid.');
                            }
                        })
                        .catch(error => {
                            console.error('Error occurred:', error);
                            alert('Er is een fout opgetreden bij het maken van de request.');
                        });

                });
            });
        });
    </script>

</x-app-layout>
