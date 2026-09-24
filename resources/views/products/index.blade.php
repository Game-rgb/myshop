<x-app-layout>

    <div class="px-6 py-6 grid grid-cols-1 lg:grid-cols-4 gap-8">

        {{-- MAIN CONTENT --}}
        <div class="lg:col-span-3">

            {{-- Page header --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-800">Products</h1>
                    <p class="text-slate-500 text-sm mt-1">Browse and manage your product catalog</p>
                </div>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('products.create') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5
                                  bg-gradient-to-r from-indigo-600 to-blue-600 text-white text-sm font-medium
                                  rounded-full shadow-md shadow-indigo-200 hover:shadow-lg hover:scale-[1.02]
                                  transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Product
                        </a>
                    @endif
                @endauth
            </div>

            {{-- Category filter pills --}}
            <div class="flex flex-wrap gap-2 mb-6">
                <a href="{{ route('products.index') }}"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-150
                          {{ request()->routeIs('products.index')
                                ? 'bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-md shadow-indigo-200'
                                : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    All
                </a>

                @foreach ($categories as $cat)
                    @php
                        $isActive = request()->route('category') && request()->route('category')->id == $cat->id;
                    @endphp
                    <a href="{{ route('products.byCategory', $cat->id) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-150
                              {{ $isActive
                                    ? 'bg-gradient-to-r from-indigo-600 to-blue-600 text-white shadow-md shadow-indigo-200'
                                    : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            {{-- Product grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                @forelse ($product as $list)
                    <div class=" bg-white border rounded-xl shadow-sm border-slate-200/80 p-3">

                        {{-- Image --}}
                        <div class="overflow-hidden rounded-md bg-slate-100">
                            <img src="{{ $list->image }}"
                                 alt="{{ $list->name }}"
                                 class="w-full h-[180px] object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>

                        {{-- Info + admin actions --}}
                        <div class="flex justify-between items-start mt-3 flex-1">
                            <div class="min-w-0">
                                <p class="font-semibold text-slate-800 truncate">{{ $list->name }}</p>
                                <p class="text-indigo-600 font-medium">${{ $list->price }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    {{ $list->category->name ?? 'Uncategorized' }}
                                </p>
                            </div>

                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <div class="flex items-center gap-1 shrink-0">
                                        <a href="{{ route('products.edit', $list->id) }}"
                                           title="Edit product"
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                                  text-indigo-600 hover:text-indigo-800 hover:bg-indigo-50
                                                  transition-all duration-150">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <form action="{{ route('products.destroy', $list->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this product?')"
                                              class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    title="Delete product"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-full
                                                           text-rose-500 hover:text-rose-700 hover:bg-rose-50
                                                           transition-all duration-150">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-2 mt-3">
                            @auth
                                <form onsubmit="addToCart(event, '{{ route('cart.store', $list->id) }}', '{{ $list->name }}')"
                                      class="flex-1 m-0">
                                    @csrf
                                    <button type="submit"
                                            class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 text-white
                                                   px-4 py-2 rounded-xl text-sm font-medium
                                                   shadow-sm shadow-indigo-200 hover:shadow-md hover:scale-[1.02]
                                                   transition-all duration-150">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                   class="flex-1 text-center text-sm font-medium text-indigo-600
                                          bg-indigo-50 hover:bg-indigo-100 rounded-xl px-4 py-2
                                          transition-all duration-150">
                                    Login to Add
                                </a>
                            @endauth

                            <a href="{{ route('products.show', $list->id) }}"
                               class="px-4 py-2 text-sm font-medium text-slate-700
                                      bg-slate-100 hover:bg-slate-200 rounded-xl
                                      transition-all duration-150">
                                Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-400">
                        <svg class="w-14 h-14 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <p class="text-sm">No products found.</p>
                    </div>
                @endforelse
            </div>

        </div>

        {{-- CART SIDEBAR --}}
        <div class="lg:col-span-1">
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5 sticky top-6 shadow-sm">

                <div class="flex items-center gap-2 mb-4">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <h2 class="font-semibold text-slate-800">Your Cart</h2>
                </div>

                @auth
                    @forelse ($carts as $cart)
                        <div class="flex justify-between items-start text-sm border-b border-slate-100 pb-3 mb-3 last:border-0">
                            <div class="min-w-0">
                                <p class="font-medium text-slate-800 truncate">{{ $cart->product->name }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">Qty × {{ $cart->quantity }}</p>
                            </div>
                            <p class="font-medium text-slate-700 shrink-0 ml-2">
                                ${{ number_format($cart->product->price * $cart->quantity, 2) }}
                            </p>
                        </div>
                    @empty
                        <div class="py-6 text-center text-slate-400">
                            <svg class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <p class="text-sm">Cart is empty.</p>
                        </div>
                    @endforelse

                    @if ($carts->count() > 0)
                        <div class="flex justify-between items-center font-semibold text-slate-800
                                    border-t border-slate-200 pt-3 mt-3">
                            <span>Total</span>
                            <span class="text-indigo-600">${{ number_format($cartTotal, 2) }}</span>
                        </div>

                        <a href="{{ route('cart.index') }}"
                           class="block text-center bg-gradient-to-r from-indigo-600 to-blue-600
                                  text-white py-2.5 rounded-xl text-sm font-medium mt-4
                                  shadow-md shadow-indigo-200 hover:shadow-lg hover:scale-[1.02]
                                  transition-all duration-150">
                            Buy Now
                        </a>
                    @endif
                @else
                    <div class="py-6 text-center">
                        <p class="text-slate-400 text-sm mb-3">You're not logged in.</p>
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium
                                  bg-gradient-to-r from-indigo-600 to-blue-600 text-white
                                  shadow-md shadow-indigo-200 hover:shadow-lg hover:scale-[1.02]
                                  transition-all duration-150">
                            Login to view cart
                        </a>
                    </div>
                @endauth
            </div>
        </div>

    </div>

    <script>
        function addToCart(event, url, productName) {
            event.preventDefault();

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                }
            }).then(() => {
                location.reload();
            });
        }

        let searchTimeout;

        function liveSearch(query) {
            clearTimeout(searchTimeout);

            const resultsBox = document.getElementById('searchResults');

            if (query.trim() === '') {
                resultsBox.style.display = 'none';
                return;
            }

            searchTimeout = setTimeout(() => {
                fetch(`/products/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(products => {
                        if (products.length === 0) {
                            resultsBox.innerHTML = '<div style="padding:10px; color:#888;">No products found</div>';
                        } else {
                            resultsBox.innerHTML = products.map(p => `
                                <a href="/products/${p.id}" style="display:block; padding:10px; text-decoration:none; color:#333; border-bottom:1px solid #eee;">
                                    ${p.name} — $${p.price}
                                </a>
                            `).join('');
                        }
                        resultsBox.style.display = 'block';
                    });
            }, 300);
        }
    </script>

</x-app-layout>         