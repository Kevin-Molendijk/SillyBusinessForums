<div class="max-w-2xl mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-4">{{ __('Edit Post') }}</h2>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Titel Input -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('title')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Content Input -->
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">{{ __('Content') }}</label>
            <textarea name="content" id="content" rows="5" required
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('content', $post->content) }}</textarea>
            @error('content')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
