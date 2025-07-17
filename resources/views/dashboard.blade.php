<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primaryPurple-dark leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-primaryBlue-dark via-primaryBlack to-primaryPurple-dark overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-primaryPurple-light">
                    @if(auth()->user()->isAdmin())
                        <h3 class="text-lg font-semibold mb-4">Manage Users</h3>
                        @if(session('success'))
                            <div class="bg-primaryPurple-light border border-primaryPurple-dark text-primaryPurple-dark px-4 py-3 rounded mb-4 shadow-md">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="min-w-full divide-y divide-primaryPurple-dark">
                            <thead class="bg-primaryBlue-light">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-primaryPurple-light uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-primaryPurple-light uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-primaryPurple-light uppercase tracking-wider">Current Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-primaryPurple-light uppercase tracking-wider">Change Role</th>
                                </tr>
                            </thead>
                            <tbody class="bg-primaryBlue-light divide-y divide-primaryPurple-dark">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($user->role->name == 'admin') bg-primaryPurple-light text-primaryPurple-dark
                                                @elseif($user->role->name == 'seller') bg-primaryBlue-light text-primaryBlue-dark
                                                @else bg-primaryBlack text-primaryPurple-light @endif">
                                                {{ $user->role->name == 'seller' ? 'Seller' : ucfirst($user->role->name) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($user->id != auth()->id())
                                                <form action="{{ route('users.update.role', $user) }}" method="POST" class="flex items-center">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="role_id" class="rounded-md shadow-sm border-primaryPurple-dark focus:border-primaryPurple focus:ring focus:ring-primaryPurple-dark focus:ring-opacity-50">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                                {{ ucfirst($role->name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="ml-2 bg-primaryPurple hover:bg-primaryPurple-dark text-white font-bold py-1 px-3 rounded shadow-md transition">
                                                        Update
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-primaryPurple-light">Cannot change own role</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @elseif(auth()->user()->isCustomer())
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">My Products</h3>
                            <a href="{{ route('products.create') }}" class="bg-primaryPurple hover:bg-primaryPurple-dark text-white font-bold py-2 px-4 rounded shadow-md transition">
                                Add Product
                            </a>
                        </div>

                        @if($products->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($products as $product)
                                    <div class="bg-primaryBlue-light border border-primaryPurple-dark rounded-lg shadow-md p-6">
                                        <h4 class="text-lg font-semibold mb-2 text-primaryPurple-dark">{{ $product->name }}</h4>
                                        <p class="text-primaryBlue-dark mb-2">{{ $product->description }}</p>
                                        <p class="text-xl font-bold text-primaryPurple mb-4">${{ $product->price }}</p>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('products.edit', $product) }}" class="bg-primaryPurple hover:bg-primaryPurple-dark text-white font-bold py-1 px-3 rounded shadow-md transition">
                                                Edit
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-primaryPurple-light">You haven't added any products yet.</p>
                        @endif

                    @else
                        <p>Welcome! You can browse products.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

