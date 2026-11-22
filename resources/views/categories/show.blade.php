<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
                
                <!-- Header -->
                <div class="flex items-center justify-between mb-6 border-b border-slate-100 pb-4">
                    <h2 class="text-2xl font-bold text-slate-800">Edit Category</h2>
                    <a href="{{ route('categories.index') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                        &larr; Back to Categories
                    </a>
                </div>

                <!-- Form -->
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Category Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" 
                               class="w-full border border-slate-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 px-4 py-3 text-slate-700 transition-all"
                               required>
                        @error('name')
                            <p class="text-rose-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-8">
                        <button type="submit" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md hover:-translate-y-0.5 transition-all">
                            Update Category
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>