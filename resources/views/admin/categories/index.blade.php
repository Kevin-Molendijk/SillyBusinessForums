<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Beheer Categorieën') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6 space-y-6">
        <!-- Nieuwe Categorie Toevoegen -->
        <div class="p-6 bg-white shadow sm:rounded-lg">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nieuwe Categorie</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full" required>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Aanmaken</button>
            </form>
        </div>

        <!-- Categorieën Lijst -->
        <div class="p-6 bg-white shadow sm:rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Bestaande Categorieën</h3>
            <ul>
                @foreach ($categories as $category)
                    <li class="flex justify-between items-center mb-2">
                        <span>{{ $category->name }}</span>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze categorie wilt verwijderen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Verwijderen</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
