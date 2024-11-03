<form action="{{ route('search') }}" method="GET" class="flex items-center">
    <input
        type="text"
        name="query"
        placeholder="Zoek op titel..."
        class="border rounded-l-md p-2"
        required
    />
    <button type="submit" class="bg-blue-600 text-white rounded-r-md px-4 py-2">Zoeken</button>
</form>
