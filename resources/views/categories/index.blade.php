<x-app-layout>




    <div class="min-h-screen flex justify-center p-6 bg-page-gradient">
        <div class="w-full max-w-5xl mx-auto">
            <div class="shadow-md rounded-md p-6 md:p-8 bg-white/85 backdrop-blur-md border border-white/60">

                

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-3xl font-semibold tracking-tight text-slate-800 flex items-center gap-3">
                            Categories
                        </h1>
                        <p class="text-slate-500 text-sm mt-1">Manage your product categories with ease</p>
                    </div>

                    <a href="{{ route('categories.create') }}"
                       class="inline-flex items-center justify-center gap-2 px-5 py-2.5
                              bg-gradient-to-r from-indigo-600 to-blue-600 text-white text-sm font-medium
                              rounded-full shadow-md shadow-indigo-200 hover:shadow-lg hover:scale-[1.02]
                              transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Category
                    </a>
                </div>

                {{-- Success toast --}}
                @if (session('success'))
                    <div class="mb-6 p-4 bg-emerald-50/90 border border-emerald-200 text-emerald-800
                                rounded-xl flex items-center gap-3 animate-slide-down">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Table --}}
                <div class="overflow-x-auto shadow-sm rounded-md border border-slate-200/70 bg-white/70 backdrop-blur-sm ">
                    <table class="w-full min-w-[600px] border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200/80">
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Name</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Slug</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100/80">
                            @forelse ($categories as $category)
                                <tr class="transition-colors duration-150 hover:bg-blue-500/5">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                                            <span class="font-medium text-slate-800">{{ $category->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-mono
                                                     bg-slate-100 text-slate-600 border border-slate-200">
                                            {{ $category->slug }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('categories.edit', $category) }}"
                                               title="Edit category"
                                               class="inline-flex items-center justify-center w-9 h-9 rounded-full
                                                      text-indigo-600 hover:text-indigo-800 hover:bg-indigo-50
                                                      transition-all duration-150 hover:scale-110">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                <span class="sr-only">Edit</span>
                                            </a>

                                            {{-- Delete --}}
                                            <button type="button"
                                                    title="Delete category"
                                                    onclick="openModal('{{ route('categories.destroy', $category->id) }}')"
                                                    class="inline-flex items-center justify-center w-9 h-9 rounded-full
                                                           text-rose-500 hover:text-rose-700 hover:bg-rose-50
                                                           transition-all duration-150 hover:scale-110">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3"/>
                                                </svg>
                                                <span class="sr-only">Delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-slate-400">
                                        <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                        </svg>
                                        <p class="text-sm">No categories yet. Click "Add Category" to create one.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer meta --}}
                <div class="mt-5 flex justify-end text-xs text-slate-400">
                    <span>{{ $categories->count() }} {{ Str::plural('category', $categories->count()) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete modal --}}
    <div id="deleteModal"
         class="hidden fixed inset-0 items-center justify-center p-4 z-50 bg-slate-900/60 backdrop-blur-sm transition-opacity duration-200">
        <div class="animate-modal-pop w-full max-w-md bg-white rounded-3xl p-6 md:p-8 text-center space-y-6 shadow-2xl">

            <div class="mx-auto w-16 h-16 rounded-full bg-rose-100 flex items-center justify-center text-rose-500">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M5.07 19h13.86a2 2 0 001.74-2.99l-6.93-12a2 2 0 00-3.48 0l-6.93 12A2 2 0 005.07 19z"/>
                </svg>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-slate-800">Delete category</h3>
                <p class="text-slate-500 mt-2 text-sm">
                    Are you sure you want to delete this category? This action cannot be undone.
                </p>
            </div>

            <form id="deleteForm" method="POST" class="space-y-6">
                @csrf
                @method('DELETE')
                <div class="flex items-center justify-center gap-4">
                    <button type="button" onclick="closeModal()"
                            class="px-6 py-2.5 text-sm font-medium text-slate-600 bg-slate-100
                                   hover:bg-slate-200 rounded-full transition-colors duration-150">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-6 py-2.5 text-sm font-medium text-white
                                   bg-gradient-to-r from-rose-600 to-red-600
                                   hover:from-rose-700 hover:to-red-700 rounded-full
                                   shadow-md shadow-rose-200 transition-all duration-150">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(deleteUrl) {
            document.getElementById('deleteForm').action = deleteUrl;
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        document.getElementById('deleteModal').addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>

</x-app-layout>