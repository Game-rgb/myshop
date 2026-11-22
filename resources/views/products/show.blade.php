<x-app-layout>
    <!-- Adding a subtle colorful gradient background to the whole page -->
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-indigo-50/30 to-blue-50/40 py-12 flex items-center">
        <div class="max-w-5xl mx-auto px-6 w-full">
            
            <!-- Back Button with Color Hover -->
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-indigo-600 mb-6 transition-all duration-300 group">
                <div class="w-8 h-8 rounded-full bg-white shadow-sm flex items-center justify-center mr-3 group-hover:bg-indigo-100 group-hover:text-indigo-600 group-hover:-translate-x-1 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </div>
                Back to Collection
            </a>

            <!-- Main Product Card -->
            <div class="bg-white rounded-[2rem] shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] shadow-indigo-100/50 border border-white overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    
                    <!-- Image Section -->
                    <div class="p-6 lg:p-8 bg-gradient-to-br from-slate-100 to-indigo-50/50 relative flex items-center justify-center">
                        <div class="aspect-square w-full max-w-sm rounded-3xl overflow-hidden bg-white shadow-xl shadow-slate-200/50 flex items-center justify-center relative group">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="text-sm font-medium">No Image</span>
                                </div>
                            @endif
                            
                            <div class="absolute top-4 left-4">
                                <span class="backdrop-blur-md bg-white/90 text-indigo-700 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full shadow-md border border-indigo-100">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Details Section -->
                    <div class="p-6 lg:p-10 flex flex-col justify-center bg-white relative">
                        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 rounded-full bg-blue-50 opacity-50 blur-2xl pointer-events-none"></div>

                        <div class="relative z-10">
                            <h1 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tight leading-tight mb-3">{{ $product->name }}</h1>
                            
                            <div class="flex flex-wrap items-center gap-3 mb-5">
                                <p class="text-4xl font-black text-transparent bg-clip-text text-green-500  drop-shadow-sm">
                                    ${{ number_format($product->price, 2) }}
                                </p>
                                
                                @if($product->stock > 0)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-emerald-400 to-emerald-500 text-white text-xs font-bold rounded-full shadow-md shadow-emerald-200">
                                        <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                                        In Stock ({{ $product->stock }})
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-rose-400 to-rose-500 text-white text-xs font-bold rounded-full shadow-md shadow-rose-200">
                                        <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                                        Out of Stock
                                    </span>
                                @endif
                            </div>

                            <div class="prose prose-sm prose-slate text-slate-600 mb-6 leading-relaxed">
                                <p>{{ $product->details ?? 'No description available for this product.' }}</p>
                            </div>
                        </div>

                        <!-- Add to Cart Action & Ratings -->
                        <div class="mt-auto pt-5 border-t border-slate-100 relative z-10">
                            @auth
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.store', $product->id) }}" method="POST" class="mb-4">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 via-blue-600 to-indigo-600 bg-[length:200%_auto] hover:bg-right text-white font-bold rounded-xl shadow-lg shadow-indigo-200/60 hover:shadow-indigo-300 hover:-translate-y-0.5 transition-all duration-500">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <button class="w-full flex items-center justify-center px-6 py-3 bg-slate-100 text-slate-400 font-bold rounded-xl cursor-not-allowed border border-slate-200 mb-4" disabled>
                                        Currently Unavailable
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-bold rounded-xl transition-all duration-300 border border-indigo-100 mb-4">
                                    Log in to Add to Cart
                                </a>
                            @endauth

                            <!-- SUPER COMPACT RATING SYSTEM -->
                            <div class="bg-slate-50 rounded-xl p-3 border border-slate-200/60 flex items-center justify-between">
                                @php
                                    $avg = round($product->ratings->avg('stars') ?? 0);
                                    $count = $product->ratings->count();
                                @endphp

                                <div class="flex items-center gap-2">
                                    <div class="flex text-lg text-amber-400 drop-shadow-sm">
                                        @for ($i = 1; $i <= 5; $i++)
                                            {{ $i <= $avg ? '★' : '☆' }}
                                        @endfor
                                    </div>
                                    <span class="text-xs font-medium text-slate-500">({{ $count }})</span>
                                </div>

                                @auth
                                    @php $userRating = $product->ratings->firstWhere('user_id', auth()->id()); @endphp

                                    @if ($userRating)
                                        <span class="text-xs font-bold text-emerald-600 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                            Rated {{ $userRating->stars }}★
                                        </span>
                                    @else
                                        <form action="{{ route('products.rate', $product->id) }}" method="POST" class="flex items-center gap-1.5">
                                            @csrf
                                            <select name="stars" class="border-slate-200 rounded-lg px-4 py-1 bg-white text-slate-700 text-xs shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 transition-all appearance-none cursor-pointer">
                                                <option value="5">5★</option>
                                                <option value="4">4★</option>
                                                <option value="3">3★</option>
                                                <option value="2">2★</option>
                                                <option value="1">1★</option>
                                            </select>
                                            <button type="submit" class="px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg shadow-sm transition-colors">
                                                Rate
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="text-xs font-bold text-indigo-600 hover:underline">
                                        Login to rate
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>