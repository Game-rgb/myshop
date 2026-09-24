<x-app-layout>

    <!-- HERO -->
    <section class="text-center py-[45px] px-5 bg-[#f5f5f5]">
        <img id="hero-img" src="https://images.unsplash.com/photo-1441986300917-64674bd600d8" class="mx-auto w-[95%] max-h-[430px] object-cover rounded-[10px]">
        <h1 class="mt-5 text-[32px] font-semibold">Welcome to MyShop</h1>
        <p class="text-[#666] mt-2">Find the best products at the best prices.</p>
        <a href="{{ route('products.index') }}" class="inline-block mt-4 py-[10px] px-6 bg-[#2563eb] text-white rounded-md no-underline">
            Shop Now
        </a>
    </section>

    <script>
        const heroImages = [
            'https://images.unsplash.com/photo-1441986300917-64674bd600d8',
            'https://images.unsplash.com/photo-1472851294608-062f824d29cc',
            'https://images.unsplash.com/photo-1483985988355-763728e1935b'
        ];
        let heroIndex = 0;
        setInterval(() => {
            heroIndex = (heroIndex + 1) % heroImages.length;
            document.getElementById('hero-img').src = heroImages[heroIndex];
        }, 3000);
    </script>

    <!-- ABOUT US -->
    <section class="py-8 px-5 max-w-[700px] mx-auto text-center">
        <h2 class="text-[22px] font-semibold">About Us</h2>
        <p class="text-[#555] mt-2">
            We are a small shop offering quality products across multiple categories, with fast service and fair prices.
        </p>
    </section>

    <!-- BEST SALE -->
    <section class="py-8 px-5 max-w-[1000px] mx-auto">
        <h2 class="text-[22px] font-semibold mb-4">Best Sale</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-[400px] lg:max-w-[900px] mx-auto">
            @foreach ($bestSale as $item)
                <div class="border border-[#ddd] rounded-md p-2">
                    <img src="{{ $item->image }}" class="w-full h-[170px] object-cover rounded-sm block">
                    <p class="font-semibold mt-2">{{ $item->name }}</p>
                    <p class="text-[#555]">${{ $item->price }}</p>
                    <a href="{{ route('products.show', $item->id) }}">
                        <button class="mt-1.5 py-1.5 px-3.5 cursor-pointer">Detail</button>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- CONTACT US -->
    <section class="py-10 px-5 bg-[#f5f5f5] text-center">
        <h2 class="text-[22px] font-semibold">Contact Us</h2>
        <p class="mt-2 text-[#555]">Email: shop@example.com</p>
        <p class="text-[#555]">Phone: 012 345 678</p>
    </section>

</x-app-layout>