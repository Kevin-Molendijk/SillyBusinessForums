<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a New Post') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div>
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div>
                    <label for="content">Content</label>
                    <textarea id="content" name="content" required></textarea>
                </div>

                <div>
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit">Create Post</button>
            </form>
        </div>
    </div>
</x-app-layout>
