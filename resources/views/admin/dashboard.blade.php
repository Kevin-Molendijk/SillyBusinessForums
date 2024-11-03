<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6 space-y-6">
        <!-- Sectie: Categorieën beheren -->
        <div class="bg-white p-6 shadow-sm rounded-lg">
            <h3 class="text-lg font-semibold mb-4">Categorieën Beheren</h3>

            <!-- Knop voor nieuwe categorie toevoegen -->
            <form action="{{ route('admin.categories.store') }}" method="POST" class="mb-6">
                @csrf
                <div class="flex items-center space-x-4">
                    <input type="text" name="name" placeholder="Nieuwe categorie naam" class="border-gray-300 rounded w-full" required>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Toevoegen</button>
                </div>
            </form>


            <!-- Categorieën lijst -->
            <ul>
                @foreach ($categories as $category)
                    <li class="flex justify-between items-center mb-2 border-b pb-2">
                        <span>{{ $category->name }}</span>

                        <!-- Delete formulier -->
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
