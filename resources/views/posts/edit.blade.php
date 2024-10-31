<!-- resources/views/posts/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight mb-6">
            {{ __('Post Bewerken') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 space-y-6">
        <!-- Update Post Informatie -->
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl mx-auto">
                @include('posts.partials.post-edit-form', ['post' => $post])
            </div>
        </div>

        <!-- Optioneel: Andere functionaliteiten of secties kunnen hier worden toegevoegd -->
    </div>
</x-app-layout>
