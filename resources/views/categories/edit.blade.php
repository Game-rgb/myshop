<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-indigo-50/30 to-blue-50/40 py-12">
        <div class="max-w-2xl mx-auto px-6">
            
            <!-- Main Card -->
            <div class="bg-white rounded-[2rem] shadow-xl shadow-indigo-100/50 border border-white p-8 sm:p-10 relative overflow-hidden">
                
                <!-- Decorative background glow -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 rounded-full bg-blue-50 opacity-60 blur-2xl pointer-events-none"></div>

                <div class="relative z-10">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-8 pb-6 border-b border-slate-100">
                        <div>
                            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Edit Category</h2>
                            <p class="text-slate-500 text-sm mt-1">Update the name of your category.</p>
                        </div>
                        <a href="{{ route('categories.index') }}" class="group flex items-center justify-center w-10 h-10 bg-slate-50 hover:bg-indigo-50 rounded-full transition-colors text-slate-400 hover:text-indigo-600">
                            <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </a>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-8">
                            <label for="name" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Category Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" 
                                       class="w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 font-medium placeholder-slate-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300"
                                       placeholder="e.g. Electronics, Clothing..." required>
                            </div>
                            @error('name')
                                <p class="text-rose-500 text-sm font-medium mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                            <a href="{{ route('categories.index') }}" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-700 hover:bg-slate-50 rounded-xl transition-all">
                                Cancel
                            </a>
                            <button type="submit" class="flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-indigo-600 via-blue-600 to-indigo-600 bg-[length:200%_auto] hover:bg-right text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-200/50 hover:shadow-indigo-300 hover:-translate-y-0.5 transition-all duration-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Update Category
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>