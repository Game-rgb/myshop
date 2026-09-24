<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Category
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 py-10 px-4 sm:px-6">
        <div class="max-w-lg mx-auto">

            {{-- Header --}}
            <div class="mb-8">
                <a href="{{ route('categories.index') }}"
                   class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-slate-800 transition-colors mb-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Categories
                </a>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Add Category</h1>
                <p class="mt-1 text-sm text-slate-500">Create a new category to organize your products.</p>
            </div>

            {{-- Success message --}}
            @if (session('success'))
                <div class="mb-6 flex items-start gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-200">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif

            {{-- Form Card --}}
            <form action="{{ route('categories.store') }}" method="POST"
                  class="bg-white rounded-2xl shadow-sm ring-1 ring-slate-200/60 overflow-hidden">
                @csrf

                <div class="p-6 sm:p-8 space-y-6">

                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                            Category Name
                        </label>
                        <input id="name" type="text" name="name"
                               value="{{ old('name') }}"
                               placeholder="e.g. Electronics"
                               autofocus required
                               class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm text-slate-900 placeholder-slate-400
                                      focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all
                                      @error('name') border-red-400 focus:border-red-500 focus:ring-red-500/20 @enderror">
                        @error('name')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Footer actions --}}
                <div class="px-6 sm:px-8 py-4 bg-slate-50/80 border-t border-slate-200 flex flex-col-reverse sm:flex-row sm:justify-end gap-2">
                    <a href="{{ route('categories.index') }}"
                       class="w-full sm:w-auto text-center px-5 py-2.5 rounded-xl text-sm font-medium text-slate-700
                              bg-white border border-slate-300 hover:bg-slate-100 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                            class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-sm font-semibold text-white
                                   bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700
                                   shadow-sm hover:shadow-md transition-all">
                        Save Category
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>