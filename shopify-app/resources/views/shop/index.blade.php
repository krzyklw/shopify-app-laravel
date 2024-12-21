<x-shop-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-mint-600 rounded-lg shadow-xl mb-8">
                <div class="px-8 py-12 max-w-7xl mx-auto">
                    <h1 class="text-4xl font-bold text-white mb-4">Welcome to AntonShop</h1>
                    <p class="text-mint-100 text-lg">Discover our amazing collection of products</p>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            @if ($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                            @else
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            @if ($product->stock > 0)
                                <span class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded-full text-xs">In Stock</span>
                            @else
                                <span class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs">Out of Stock</span>
                            @endif
                        </div>
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h2>
                            <p class="text-gray-600 mb-4 h-12 overflow-hidden">{{ $product->description }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-bold text-mint-600">${{ number_format($product->price, 2) }}</span>
                                <form action="{{ route('shop.add-to-cart', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="bg-mint-500 text-white px-4 py-2 rounded-lg hover:bg-mint-600 transition-colors {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-shop-layout>
