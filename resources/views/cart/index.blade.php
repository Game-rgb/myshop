<x-app-layout>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50">
        <div class="max-w-6xl mx-auto px-6 py-10">

            {{-- Page header --}}
            <div class="mb-10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-blue-600
                                flex items-center justify-center text-white shadow-md shadow-indigo-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-semibold tracking-tight text-slate-800">Your Bag</h1>
                        <p class="text-sm text-slate-500 mt-0.5">
                            {{ $carts->count() }} {{ Str::plural('item', $carts->count()) }} in your cart
                        </p>
                    </div>
                </div>
            </div>

            {{-- Success toast --}}
            @if (session('success'))
                <div class="mb-8 p-4 bg-emerald-50/90 border border-emerald-200 text-emerald-800
                            rounded-xl flex items-center gap-3 animate-[slideDown_0.3s_ease]">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- LEFT: Cart items --}}
                <div class="lg:col-span-2 space-y-4">
                    @forelse ($carts as $cart)
                        <div id="cart-item-{{ $cart->id }}"
                             class="group flex gap-4 bg-white border border-slate-200/80 rounded-2xl p-4
                                    shadow-sm hover:shadow-md transition-all duration-200">

                            {{-- Product image --}}
                            <div class="shrink-0 overflow-hidden rounded-xl bg-slate-100">
                                <img src="{{ asset('storage/' . $cart->product->image) }}"
                                     alt="{{ $cart->product->name }}"
                                     class="w-24 h-24 object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>

                            {{-- Product info --}}
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-800 truncate">{{ $cart->product->name }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    {{ $cart->product->category->name ?? 'Uncategorized' }}
                                </p>

                                <div class="flex items-center gap-2 mt-2">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full
                                                 text-xs font-medium bg-indigo-50 text-indigo-700
                                                 border border-indigo-100">
                                        Qty × {{ $cart->quantity }}
                                    </span>
                                </div>

                                {{-- Actions --}}
                                <div class="flex items-center gap-3 mt-3 text-sm">
                                    <a href="{{ route('products.edit', $cart->product_id) }}"
                                       class="inline-flex items-center gap-1 text-slate-600
                                              hover:text-indigo-600 transition-colors duration-150">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <span class="w-px h-4 bg-slate-200"></span>
                                    <button onclick="removeFromCart(event, '{{ route('cart.destroy', $cart->id) }}', '{{ $cart->id }}')"
                                            class="inline-flex items-center gap-1 text-slate-600
                                                   hover:text-rose-600 transition-colors duration-150">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3"/>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </div>

                            {{-- Line price --}}
                            <div class="shrink-0 text-right">
                                <p class="font-semibold text-slate-800">
                                    ${{ number_format($cart->product->price * $cart->quantity, 2) }}
                                </p>
                            </div>
                        </div>
                    @empty
                        {{-- Empty state --}}
                        <div class="bg-white border border-slate-200/80 rounded-2xl p-12 text-center">
                            <div class="mx-auto w-16 h-16 rounded-full bg-slate-100
                                        flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <p class="text-slate-600 font-medium">Your cart is empty</p>
                            <p class="text-slate-400 text-sm mt-1">Start shopping to fill it up.</p>
                            <a href="{{ route('products.index') }}"
                               class="inline-flex items-center gap-2 mt-5 px-5 py-2.5
                                      bg-gradient-to-r from-indigo-600 to-blue-600 text-white
                                      text-sm font-medium rounded-full
                                      shadow-md shadow-indigo-200 hover:shadow-lg hover:scale-[1.02]
                                      transition-all duration-200">
                                Browse Products
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    @endforelse
                </div>

                {{-- RIGHT: Order summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-6 sticky top-6 shadow-sm">

                        {{-- Checkout button --}}
                        @if ($carts->count() > 0)
                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full bg-blue-600 text-white
                                               py-3 rounded-xl text-sm font-medium
                                               shadow-md shadow-slate-300
                                               hover:shadow-lg hover:scale-[1.02]
                                               transition-all duration-200
                                               flex items-center justify-center gap-2">
                                    Checkout
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </button>
                            </form>
                        @endif

                        {{-- Summary heading --}}
                        <h2 class="text-xs font-semibold mt-6 mb-3 tracking-widest text-slate-500 uppercase">
                            Order Summary
                        </h2>

                        {{-- Summary rows --}}
                        <div class="text-sm space-y-3 border-t border-slate-100 pt-4">
                            <div class="flex justify-between text-slate-600">
                                <span>
                                    {{ $carts->count() }} product{{ $carts->count() !== 1 ? 's' : '' }}
                                </span>
                                <span class="font-medium text-slate-800">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-slate-600">
                                <span>Delivery</span>
                                <span class="inline-flex items-center gap-1 font-medium text-emerald-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Free
                                </span>
                            </div>
                        </div>

                        {{-- Total --}}
                        <div class="flex justify-between items-center font-semibold text-base
                                    border-t border-slate-200 mt-4 pt-4">
                            <span class="text-slate-800">Total</span>
                            <span class="text-indigo-600 text-lg">${{ number_format($total, 2) }}</span>
                        </div>

                        {{-- Trust badges --}}
                        <div class="mt-6 pt-4 border-t border-slate-100 space-y-2 text-xs text-slate-500">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                Secure checkout
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Free returns within 30 days
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Remove toast --}}
    <div id="removeToast"
         class="hidden fixed top-6 right-6 z-50 transition-all duration-300">
        <div class="flex items-center gap-3 bg-white pl-4 pr-6 py-3.5 rounded-2xl
                    shadow-xl shadow-slate-300/50 border border-slate-200/80 backdrop-blur-sm">
            <div class="w-9 h-9 rounded-full bg-rose-50 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-800">Removed from cart</p>
                <p class="text-xs text-slate-500 mt-0.5">Item has been removed</p>
            </div>
        </div>
    </div>

    <script>
    function removeFromCart(event, url, cartId) {
        event.preventDefault();

        const item = document.getElementById('cart-item-' + cartId);
        if (item) {
            item.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
            item.style.opacity = '0';
            item.style.transform = 'translateX(20px)';
            setTimeout(() => item.remove(), 200);
        }

        const toast = document.getElementById('removeToast');
        toast.classList.remove('hidden');
        toast.classList.add('block');

        setTimeout(() => {
            toast.classList.remove('block');
            toast.classList.add('hidden');
        }, 2000);

        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            }
        });
    }
    </script>

</x-app-layout>