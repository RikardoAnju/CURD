<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Product Details') }}
            </h2>
            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Products
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-white">
                    <h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                    <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p><strong>Stock:</strong> {{ $product->stock }}</p>
                    <p><strong>Category:</strong> {{ $product->category }}</p>
                    <p><strong>Status:</strong> {{ $product->is_active ? 'Active' : 'Inactive' }}</p>

                    @if ($product->image)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-48 rounded shadow">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
