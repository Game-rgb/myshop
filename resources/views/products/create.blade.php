<x-app-layout>

    <div class="min-h-screen p-8 ">
        <div class="max-w-2xl mx-auto px-6">

            {{-- Page header --}}
            <div class="mb-8 flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600
                            flex items-center justify-center text-white shadow-md shadow-indigo-200 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-800">Add Product</h1>
                    <p class="text-sm text-slate-500 mt-0.5">Create a new product for your catalog</p>
                </div>
            </div>

            {{-- Form card --}}
            <form action="{{ route('products.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class=" bg-gray-200 border shadow-md border-slate-200/80 rounded-2xl p-6 md:p-8 space-y-6">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="e.g. Wireless Headphones"
                           class="w-full px-4 py-2.5 rounded-xl border bg-slate-50/50 text-slate-800 text-sm
                                  placeholder:text-slate-400
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500
                                  focus:bg-white transition-all duration-150
                                  {{ $errors->has('name') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200' }}">
                    @error('name')
                        <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Price & Stock side-by-side --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Price --}}
                    <div>
                        <label for="price" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Price <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm font-medium pointer-events-none">
                                $
                            </span>
                            <input type="number"
                                   id="price"
                                   name="price"
                                   step="0.01"
                                   min="0"
                                   value="{{ old('price') }}"
                                   placeholder="0.00"
                                   class="w-full pl-8 pr-4 py-2.5 rounded-xl border bg-slate-50/50 text-slate-800 text-sm
                                          placeholder:text-slate-400
                                          focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500
                                          focus:bg-white transition-all duration-150
                                          {{ $errors->has('price') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200' }}">
                        </div>
                        @error('price')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Stock --}}
                    <div>
                        <label for="stock" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Stock
                        </label>
                        <input type="number"
                               id="stock"
                               name="stock"
                               min="0"
                               value="{{ old('stock') }}"
                               placeholder="0"
                               class="w-full px-4 py-2.5 rounded-xl border bg-slate-50/50 text-slate-800 text-sm
                                      placeholder:text-slate-400
                                      focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500
                                      focus:bg-white transition-all duration-150
                                      {{ $errors->has('stock') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200' }}">
                        @error('stock')
                            <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Category --}}
                <div>
                    <label for="category_id" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Category <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="category_id"
                                name="category_id"
                                class="w-full appearance-none px-4 py-2.5 pr-10 rounded-xl border bg-slate-50/50
                                       text-slate-800 text-sm
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500
                                       focus:bg-white transition-all duration-150 cursor-pointer
                                       {{ $errors->has('category_id') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200' }}">
                            <option value="">Select a category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        {{-- Chevron --}}
                        <svg class="w-4 h-4 text-slate-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                             fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    @error('category_id')
                        <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Details --}}
                <div>
                    <label for="details" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Details
                    </label>
                    <textarea id="details"
                              name="details"
                              rows="4"
                              placeholder="Describe your product..."
                              class="w-full px-4 py-2.5 rounded-xl border bg-slate-50/50 text-slate-800 text-sm
                                     placeholder:text-slate-400 resize-none
                                     focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500
                                     focus:bg-white transition-all duration-150
                                     {{ $errors->has('details') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200' }}">{{ old('details') }}</textarea>
                    @error('details')
                        <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Image upload --}}
                <div>
                    <label for="image" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Product Image
                    </label>
                    <label for="image"
                           class="group flex flex-col items-center justify-center gap-2
                                  w-full px-4 py-8 rounded-xl border-2 border-dashed cursor-pointer
                                  transition-all duration-150
                                  {{ $errors->has('image')
                                        ? 'border-rose-400 bg-rose-50/40'
                                        : 'border-slate-300 bg-slate-50/50 hover:border-indigo-400 hover:bg-indigo-50/40' }}">
                        <div class="w-12 h-12 rounded-full bg-white border border-slate-200
                                    flex items-center justify-center text-slate-400
                                    group-hover:text-indigo-500 group-hover:border-indigo-200
                                    transition-colors duration-150">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                        </div>
                        <p class="text-sm text-slate-600">
                            <span class="font-medium text-indigo-600">Click to upload</span> or drag and drop
                        </p>
                        <p class="text-xs text-slate-400">PNG, JPG, WEBP up to 2MB</p>
                        <input type="file"
                               id="image"
                               name="image"
                               accept="image/*"
                               class="hidden">
                    </label>

                    {{-- Preview filename --}}
                    <p id="fileName" class="hidden mt-2 text-xs text-slate-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span id="fileNameText"></span>
                    </p>

                    @error('image')
                        <p class="mt-1.5 text-xs text-rose-600 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('products.index') }}"
                       class="px-5 py-2.5 text-sm font-medium text-slate-600
                              bg-slate-100 hover:bg-slate-200 rounded-full
                              transition-colors duration-150">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5
                                   bg-gradient-to-r from-indigo-600 to-blue-600 text-white
                                   text-sm font-medium rounded-full
                                   shadow-md shadow-indigo-200 hover:shadow-lg hover:scale-[1.02]
                                   transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Product
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- File name preview script --}}
    <script>
        document.getElementById('image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const wrap = document.getElementById('fileName');
            const text = document.getElementById('fileNameText');

            if (file) {
                text.textContent = file.name;
                wrap.classList.remove('hidden');
                wrap.classList.add('flex');
            } else {
                wrap.classList.add('hidden');
                wrap.classList.remove('flex');
            }
        });
    </script>

</x-app-layout>