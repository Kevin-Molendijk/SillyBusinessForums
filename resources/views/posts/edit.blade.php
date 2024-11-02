<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight mb-6">
            {{ __('Post Bewerken') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl mx-auto">
                @include('posts.partials.post-edit-form', ['post' => $post])
            </div>
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl mx-auto">
            @include('posts.partials.delete-post-form', ['post' => $post])
        </div>
    </div>
</x-app-layout>
