<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $product->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-mint-500 focus:ring-mint-500" rows="3">{{ old('description', $product->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" :value="old('price', $product->price)" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="stock" :value="__('Stock')" />
                            <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', $product->stock)" required />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="image_url" :value="__('Image URL')" />
                            <x-text-input id="image_url" name="image_url" type="url" class="mt-1 block w-full" :value="old('image_url', $product->image_url)" />
                            <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                        </div>

                        <div class="flex items-center">
                            <input id="active" name="active" type="checkbox" class="rounded border-gray-300 text-mint-600 shadow-sm focus:border-mint-500 focus:ring-mint-500" value="1" {{ old('active', $product->active) ? 'checked' : '' }}>
                            <label for="active" class="ml-2 block text-sm text-gray-900">Active</label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-secondary-button onclick="window.history.back()" type="button" class="mr-3">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button class="bg-mint-500 hover:bg-mint-600">
                                {{ __('Update Product') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
