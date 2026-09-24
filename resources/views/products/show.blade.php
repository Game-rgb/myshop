<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex gap-8">
            <div class="shrink-0">
                @auth
                    <form action="{{ route('cart.store', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                @disabled($product->stock <= 0)
                                class="px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 disabled:opacity-50">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-block px-5 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Login to Add to Cart
                    </a>
                @endauth
            </div>

            <div class="flex-1">
                <h1 class="text-2xl font-semibold">{{ $product->name }}</h1>

                <p class="text-gray-600 mt-1">
                    Category: {{ $product->category->name ?? 'Uncategorized' }}
                </p>

                <p class="text-xl font-bold mt-2">${{ $product->price }}</p>
                <p class="mt-2">{{ $product->details }}</p>

                <p class="mt-2 {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $product->stock > 0 ? "Stock: {$product->stock}" : 'Out of stock' }}
                </p>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-gray-200">
            @php
                $avg = round($product->ratings->avg('stars') ?? 0);
                $count = $product->ratings->count();
            @endphp

            <p class="font-medium">
                Average Rating:
                <span aria-label="{{ $avg }} out of 5 stars">
                    @for ($i = 1; $i <= 5; $i++)
                        {{ $i <= $avg ? '★' : '☆' }}
                    @endfor
                </span>
                ({{ $count }} {{ Str::plural('rating', $count) }})
            </p>

            @auth
                @php $userRating = $product->ratings->firstWhere('user_id', auth()->id()); @endphp

                @if ($userRating)
                    <p class="mt-2 text-sm text-gray-600">
                        You rated this {{ $userRating->stars }} ★
                    </p>
                @else
                    <form action="{{ route('products.rate', $product->id) }}" method="POST" class="mt-3 flex items-center gap-2">
                        @csrf
                        <label for="stars">Your rating:</label>
                        <select name="stars" id="stars" class="border rounded px-2 py-1">
                            @foreach ([5,4,3,2,1] as $star)
                                <option value="{{ $star }}">{{ $star }} ★</option>
                            @endforeach
                        </select>
                        <button type="submit" class="px-4 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Submit
                        </button>
                    </form>
                @endif
            @else
                <p class="mt-2 text-sm text-gray-500">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> to rate this product.
                </p>
            @endauth
        </div>
    </div>
</x-app-layout>