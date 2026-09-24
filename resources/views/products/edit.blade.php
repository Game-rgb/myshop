<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 py-8 px-4 sm:px-6">
        <div class="max-w-2xl mx-auto">

            {{-- Header --}}
            <div class="mb-8">
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-slate-800 transition-colors mb-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Products
                </a>
                <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-slate-900">Edit Product</h1>
                <p class="mt-1 text-sm text-slate-500">Update the details below and save your changes.</p>
            </div>

            {{-- Error Banner --}}
            @if ($errors->any())
                <div class="mb-6 flex items-start gap-3 p-4 rounded-xl bg-red-50 border border-red-200">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-sm text-red-800">
                        <p class="font-semibold">Please fix the following errors:</p>
                        <ul class="mt-1 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Form Card --}}
            <form action="{{ route('products.update', $product->id) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200/60 overflow-hidden">

                @csrf
                @method('PUT')

                <div class="p-6 sm:p-8 space-y-6">

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                            Product Name
                        </label>
                        <input id="name" type="text" name="name"
                               value="{{ old('name', $product->name) }}"
                               placeholder="e.g. Wireless Headphones"
                               class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400
                                      focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                        @error('name')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Price + Stock grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="price" class="block text-sm font-semibold text-slate-700 mb-2">
                                Price
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-medium">$</span>
                                <input id="price" type="number" step="0.01" min="0" name="price"
                                       value="{{ old('price', $product->price) }}"
                                       placeholder="0.00"
                                       class="w-full rounded-xl border-slate-200 bg-slate-50/50 pl-8 pr-4 py-2.5 text-sm text-slate-900 placeholder-slate-400
                                              focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                            </div>
                            @error('price')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-semibold text-slate-700 mb-2">
                                Stock
                            </label>
                            <input id="stock" type="number" min="0" name="stock"
                                   value="{{ old('stock', $product->stock) }}"
                                   placeholder="0"
                                   class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400
                                          focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                            @error('stock')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Details --}}
                    <div>
                        <label for="details" class="block text-sm font-semibold text-slate-700 mb-2">
                            Details
                        </label>
                        <textarea id="details" name="details" rows="4"
                                  placeholder="Describe the product..."
                                  class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400
                                         focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all resize-y">{{ old('details', $product->details) }}</textarea>
                        @error('details')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-2">
                            Category
                        </label>
                        <select id="category_id" name="category_id"
                                class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-900
                                       focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                            <option value="">Select category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Image Upload --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Product Image
                        </label>

                        <div class="flex flex-col sm:flex-row gap-4 items-start">
                            {{-- Current / Preview --}}
                            <div class="shrink-0">
                                @if ($product->image)
                                    <img id="preview"
                                         src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         onerror="this.src='https://via.placeholder.com/160?text=No+Image'"
                                         class="w-28 h-28 object-cover rounded-xl ring-1 ring-slate-200">
                                @else
                                    <div id="previewPlaceholder"
                                         class="w-28 h-28 rounded-xl bg-slate-100 ring-1 ring-slate-200 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                        </svg>
                                    </div>
                                    <img id="preview" class="hidden w-28 h-28 object-cover rounded-xl ring-1 ring-slate-200">
                                @endif
                            </div>

                            {{-- Upload control --}}
                            <div class="flex-1 w-full">
                                <label for="image"
                                       class="group flex flex-col items-center justify-center w-full h-28 px-4
                                              border-2 border-dashed border-slate-300 rounded-xl cursor-pointer
                                              bg-slate-50/50 hover:bg-blue-50 hover:border-blue-400 transition-colors">
                                    <svg class="w-6 h-6 text-slate-400 group-hover:text-blue-500 transition-colors mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    <span class="text-xs text-slate-500 group-hover:text-blue-600 transition-colors">
                                        Click to upload a new image
                                    </span>
                                    <span class="text-[11px] text-slate-400 mt-0.5">PNG, JPG up to 2MB</span>
                                    <input id="image" type="file" name="image" accept="image/*"
                                           onchange="previewImage(event)" class="hidden">
                                </label>
                                <p class="mt-2 text-xs text-slate-500">Leave empty to keep the current image.</p>
                                @error('image')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Footer Actions --}}
                <div class="px-6 sm:px-8 py-4 bg-slate-50/80 border-t border-slate-200 flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                    <a href="{{ route('products.index') }}"
                       class="w-full sm:w-auto text-center px-5 py-2.5 rounded-xl text-sm font-medium text-slate-700
                              bg-white border border-slate-300 hover:bg-slate-100 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                            class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold text-white
                                   bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700
                                   shadow-sm hover:shadow-md transition-all">
                        Save Changes
                    </button>
                </div>

            </form>

        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            const img = document.getElementById('preview');
            const placeholder = document.getElementById('previewPlaceholder');
            img.src = URL.createObjectURL(file);
            img.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        }
    </script>
</x-app-layout>