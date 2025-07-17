<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Products
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(auth()->user()->isSeller())
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">My Products</h3>
                            <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add Product
                            </a>
                        </div>
                    @else
                        <h3 class="text-lg font-semibold mb-4">All Products</h3>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($products as $product)
                            <div class="border rounded-lg p-4 shadow-sm">
                                <h4 class="font-semibold text-lg mb-2">{{ $product->name }}</h4>
                                <p class="text-gray-600 mb-2">{{ $product->description }}</p>
                                <p class="text-green-600 font-bold mb-3">${{ number_format($product->price, 2) }}</p>
                                <p class="text-sm text-gray-500 mb-3">By: {{ $product->user->name }}</p>
                                
                                <div class="flex gap-2">
                                    @if(auth()->user()->isCustomer())
                                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            Buy Now
                                        </button>
                                    @elseif(auth()->user()->isSeller() && $product->user_id == auth()->id())
                                        <a href="{{ route('products.edit', $product) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Edit
                                        </a>
                                    @elseif(auth()->user()->isAdmin())
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8">
                                <p class="text-gray-500">No products available.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


