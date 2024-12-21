<x-shop-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Shopping Cart</h2>

                    @if(session('cart'))
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-mint-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-mint-800 uppercase tracking-wider">Product</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-mint-800 uppercase tracking-wider">Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-mint-800 uppercase tracking-wider">Quantity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-mint-800 uppercase tracking-wider">Subtotal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-mint-800 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php $total = 0 @endphp
                                    @foreach(session('cart') as $id => $details)
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if($details['image_url'])
                                                        <img src="{{ $details['image_url'] }}" alt="{{ $details['name'] }}" class="w-16 h-16 object-cover rounded">
                                                    @endif
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $details['name'] }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">${{ number_format($details['price'], 2) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $details['quantity'] }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-mint-600">
                                                    ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <form action="{{ route('shop.remove-from-cart', $id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-right font-semibold">Total:</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-lg font-bold text-mint-600">${{ number_format($total, 2) }}</div>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="mt-6 flex justify-end space-x-4">
                            <a href="{{ route('shop.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors">
                                Continue Shopping
                            </a>
                            <a href="{{ route('shop.checkout') }}" class="bg-mint-500 text-white px-6 py-3 rounded-lg hover:bg-mint-600 transition-colors">
                                Proceed to Checkout
                            </a>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Your cart is empty</h3>
                            <p class="mt-1 text-sm text-gray-500">Start adding some items to your cart!</p>
                            <div class="mt-6">
                                <a href="{{ route('shop.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-mint-500 hover:bg-mint-600">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-shop-layout>
