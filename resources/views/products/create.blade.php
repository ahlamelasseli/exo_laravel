<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primaryPurple-dark leading-tight">
            Add Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-primaryBlue-dark via-primaryBlack to-primaryPurple-dark overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-primaryBlue-light border-b-2 border-primaryPurple-dark">
                    <form method="POST" action="{{ route('products.store') }}" class="mt-8">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-primaryPurple text-sm font-bold mb-2">Product Name</label>
                            <input type="text" name="name" id="name" class="shadow appearance-none border border-primaryPurple-dark rounded w-full py-2 px-3 text-primaryBlue-dark leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-primaryPurple text-sm font-bold mb-2">Description</label>
                            <textarea name="description" id="description" rows="3" class="shadow appearance-none border border-primaryPurple-dark rounded w-full py-2 px-3 text-primaryBlue-dark leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-primaryPurple text-sm font-bold mb-2">Price</label>
                            <input type="number" step="0.01" name="price" id="price" class="shadow appearance-none border border-primaryPurple-dark rounded w-full py-2 px-3 text-primaryBlue-dark leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-primaryPurple hover:bg-primaryPurple-dark text-white font-bold py-2 px-4 rounded shadow-md transition">
                                Add Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>