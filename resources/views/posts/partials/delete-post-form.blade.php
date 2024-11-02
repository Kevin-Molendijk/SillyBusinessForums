<form action="{{ route('posts.destroy', $post) }}" method="POST" class="space-y-6">
    @csrf
    @method('DELETE')

    <div class="text-red-600 font-semibold">
        <p>{{ __('Waarschuwing: Verwijdering van deze post is permanent en kan niet worden hersteld.') }}</p>
    </div>

    <div class="flex justify-end">
        <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition">
            {{ __('Verwijder Post') }}
        </button>
    </div>
</form>
