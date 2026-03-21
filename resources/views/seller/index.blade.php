<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: var(--secondary);">
            My Products
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <div class="flex justify-end">
                <a href="{{ route('seller.products.create')}}"
                   class="px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 text-sm">
                    + Add Product
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3 text-left">Image</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Price</th>
                            <th class="px-6 py-3 text-left">Stock</th>
                            <th class="px-6 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                @if($product->image)
                                    <img src="{{ $product->image }}" class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg"></div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-gray-600">฿{{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-4">{{ $product->stock_number }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                   <a href="{{ route('seller.products.edit', $product->product_id) }}"
                                       class="px-3 py-1 bg-blue-500 text-white rounded-lg text-xs hover:bg-blue-600">
                                        Edit
                                    </a>
                                   <form method="POST" action="{{ route('seller.products.destroy', $product->product_id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure?')"
                                            class="px-3 py-1 bg-red-500 text-white rounded-lg text-xs hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No products yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>