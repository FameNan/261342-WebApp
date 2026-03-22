<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: var(--secondary);">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="page-wrap">
        <div class="container">

            @if (session('success'))
                <p class="mb-4" style="color: green;">{{ session('success') }}</p>
            @endif

            @if ($products->isEmpty())
                <div class="card card-pad">
                    <p style="color: var(--text); text-align: center;">No products yet</p>
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
                    @foreach ($products as $product)
                        <div class="card" style="padding: 1rem; display: flex; flex-direction: column;">

                            {{-- Image --}}
                            @if (str_starts_with($product->image, 'http'))
                                <img src="{{ $product->image }}"
                                     style="width:100%; height:160px; object-fit:cover; border-radius:10px; margin-bottom:12px;">
                            @else
                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                     style="width:100%; height:160px; object-fit:cover; border-radius:10px; margin-bottom:12px;">
                            @endif

                            {{-- Product Name --}}
                            <p style="font-size:14px; font-weight:500; color: var(--text); margin-bottom:4px;">
                                {{ $product->name }}
                            </p>

                            {{-- Price --}}
                            <p style="font-size:13px; color: var(--secondary); margin-bottom:12px;">
                                ฿{{ number_format($product->price, 2) }}
                            </p>

                            {{-- Add to Cart --}}
                            <form method="POST" action="{{ route('carts.store') }}" style="margin-top:auto;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit"
                                        style="width:100%; padding:8px; background:var(--secondary); color:var(--surface); border:none; border-radius:8px; font-size:14px; cursor:pointer;
                                        transition: opacity .2s ease, filter .2s ease;"
                                        onmouseover="this.style.filter='brightness(0.92)';"
                                        onmouseout="this.style.filter='brightness(1)';">
                                    Add to Cart
                                </button>
                            </form>

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>