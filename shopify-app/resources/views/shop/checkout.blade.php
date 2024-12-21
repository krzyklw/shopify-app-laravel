<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold mb-6">Checkout</h2>

                    <form action="{{ route('shop.place-order') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900">Shipping Information</h3>
                                
                                <div>
                                    <x-input-label for="shipping_address" :value="__('Address')" />
                                    <x-text-input id="shipping_address" name="shipping_address" type="text" class="mt-1 block w-full" required />
                                    <x-input-error :messages="$errors->get('shipping_address')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="shipping_city" :value="__('City')" />
                                    <x-text-input id="shipping_city" name="shipping_city" type="text" class="mt-1 block w-full" required />
                                    <x-input-error :messages="$errors->get('shipping_city')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="shipping_country" :value="__('Country')" />
                                    <x-text-input id="shipping_country" name="shipping_country" type="text" class="mt-1 block w-full" required />
                                    <x-input-error :messages="$errors->get('shipping_country')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="shipping_postal_code" :value="__('Postal Code')" />
                                    <x-text-input id="shipping_postal_code" name="shipping_postal_code" type="text" class="mt-1 block w-full" required />
                                    <x-input-error :messages="$errors->get('shipping_postal_code')" class="mt-2" />
                                </div>
                            </div>

                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-gray-900">Order Summary</h3>
                                
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    @php $total = 0 @endphp
                                    @foreach(session('cart') as $id => $details)
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                        <div class="flex justify-between py-2">
                                            <span class="text-gray-600">{{ $details['name'] }} x {{ $details['quantity'] }}</span>
                                            <span class="text-gray-900">${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                                        </div>
                                    @endforeach
                                    <div class="border-t border-gray-200 mt-4 pt-4">
                                        <div class="flex justify-between">
                                            <span class="font-semibold">Total</span>
                                            <span class="font-bold text-mint-600">${{ number_format($total, 2) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Method</h3>
                                    <div class="space-y-4">
                                        <div class="flex items-center">
                                            <input id="payment_method_card" name="payment_method" type="radio" value="card" class="h-4 w-4 text-mint-600 focus:ring-mint-500" checked>
                                            <label for="payment_method_card" class="ml-3">
                                                <span class="block text-sm font-medium text-gray-700">Credit Card</span>
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="payment_method_paypal" name="payment_method" type="radio" value="paypal" class="h-4 w-4 text-mint-600 focus:ring-mint-500">
                                            <label for="payment_method_paypal" class="ml-3">
                                                <span class="block text-sm font-medium text-gray-700">PayPal</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <x-primary-button class="bg-mint-500 hover:bg-mint-600">
                                {{ __('Place Order') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
