<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #db2777;">
            Cart
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <p style="color: green; margin-bottom: 16px;">{{ session('success') }}</p>
            @endif

            @if(session('error'))
                <p style="color: red; margin-bottom: 16px;">{{ session('error') }}</p>
            @endif

            @if(!$cart || $cart->items->isEmpty())
                <div style="text-align:center; padding: 60px 0; color: #c084a0;">
                    <svg width="64" height="64" fill="none" stroke="#f9a8d4" stroke-width="1.5" viewBox="0 0 24 24" style="margin: 0 auto 16px;">
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                        <circle cx="10" cy="20.5" r="1.5"/>
                        <circle cx="18.5" cy="20.5" r="1.5"/>
                    </svg>
                    <p style="font-size:16px;">ตะกร้าของคุณว่างเปล่า</p>
                    <a href="{{ route('products.index') }}" style="display:inline-block; margin-top:16px; padding:10px 24px; background:#f48fb1; color:white; border-radius:10px; text-decoration:none; font-size:14px;">
                        ไปช้อปเลย
                    </a>
                </div>
            @else
                <div style="background:white; border-radius:16px; border: 0.5px solid #f9c0d4; overflow:hidden;">

                    {{-- Header --}}
                    <div style="display:grid; grid-template-columns: 2fr 1fr 1fr 1fr; padding:16px 24px; background:#fdf2f8; border-bottom: 0.5px solid #f9c0d4;">
                        <span style="font-size:14px; color:#c084a0;">Product</span>
                        <span style="font-size:14px; color:#c084a0; text-align:center;">Price</span>
                        <span style="font-size:14px; color:#c084a0; text-align:center;">Quantity</span>
                        <span style="font-size:14px; color:#c084a0; text-align:right;">Subtotal</span>
                    </div>

                    {{-- Items --}}
                    @foreach($cart->items as $item)
                        <div style="display:grid; grid-template-columns: 2fr 1fr 1fr 1fr; padding:20px 24px; align-items:center; border-bottom: 0.5px solid #fce7f3;">

                            {{-- Product --}}
                            <div style="display:flex; align-items:center; gap:14px;">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                         style="width:60px; height:60px; object-fit:cover; border-radius:10px; border:0.5px solid #fce7f3;">
                                @endif
                                <span style="font-size:15px; font-weight:500; color:#72243E;">{{ $item->product->name }}</span>
                            </div>

                            {{-- Price --}}
                            <span style="text-align:center; color:#888; font-size:14px;">฿{{ number_format($item->product->price, 2) }}</span>

                            {{-- Quantity --}}
                            <div style="display:flex; align-items:center; justify-content:center; gap:8px;">
                                <form method="POST" action="{{ route('carts.update', $item->cart_item_id) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                    <button type="submit" style="width:32px; height:32px; border-radius:8px; border:0.5px solid #f9c0d4; background:white; cursor:pointer; font-size:16px; color:#db2777;">-</button>
                                </form>

                                <span style="min-width:24px; text-align:center; font-size:15px; font-weight:500;">{{ $item->quantity }}</span>

                                <form method="POST" action="{{ route('carts.update', $item->cart_item_id) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button type="submit" style="width:32px; height:32px; border-radius:8px; border:0.5px solid #f9c0d4; background:white; cursor:pointer; font-size:16px; color:#db2777;">+</button>
                                </form>
                            </div>

                            {{-- Subtotal + ลบ --}}
                            <div style="display:flex; align-items:center; justify-content:flex-end; gap:16px;">
                                <span style="font-size:15px; font-weight:500; color:#72243E;">฿{{ number_format($item->product->price * $item->quantity, 2) }}</span>
                                <form method="POST" action="{{ route('carts.destroy', $item->cart_item_id) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background:none; border:none; color:#db2777; font-size:13px; cursor:pointer; font-weight:500;">ลบ</button>
                                </form>
                            </div>

                        </div>
                    @endforeach

                    {{-- Summary --}}
                    @php
                        $subtotal = $cart->items->sum(fn($i) => $i->product->price * $i->quantity);
                        $shipping = 50;
                        $total = $subtotal + $shipping;
                    @endphp

                    <div style="padding: 20px 24px; border-top: 0.5px solid #fce7f3;">
                        <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
                            <span style="color:#888; font-size:14px;">Price</span>
                            <span style="color:#888; font-size:14px;">฿{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; margin-bottom:16px;">
                            <span style="color:#888; font-size:14px;">Shipping Fee</span>
                            <span style="color:#888; font-size:14px;">฿{{ number_format($shipping, 2) }}</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; padding-top:16px; border-top: 0.5px solid #fce7f3; margin-bottom:20px;">
                            <span style="font-size:16px; font-weight:600; color:#72243E;">Total</span>
                            <span style="font-size:22px; font-weight:700; color:#db2777;">฿{{ number_format($total, 2) }}</span>
                        </div>
                        <div style="display:flex; justify-content:flex-end;">
                            <a href="{{ route('orders.store') }}" style="padding:12px 32px; background:#3b82f6; color:white; border-radius:12px; text-decoration:none; font-size:15px; font-weight:500;">
                                Order Now
                            </a>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
</x-app-layout>