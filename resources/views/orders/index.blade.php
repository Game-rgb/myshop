<x-app-layout>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50 py-10">
        <div class="max-w-3xl mx-auto px-6">

            {{-- Page header --}}
            <div class="mb-8 flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600
                            flex items-center justify-center text-white shadow-md shadow-indigo-200 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-800">Order History</h1>
                    <p class="text-sm text-slate-500 mt-0.5">
                        {{ $orders->count() }} {{ Str::plural('order', $orders->count()) }} placed
                    </p>
                </div>
            </div>

            {{-- Success toast --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50/90 border border-emerald-200 text-emerald-800
                            rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Orders list --}}
            <div class="space-y-4">
                @forelse ($orders as $index => $order)
                    <a href="{{ route('orders.show', $order->id) }}"
                       class="group block bg-white border border-slate-200/80 rounded-2xl p-5
                              shadow-sm hover:shadow-lg hover:-translate-y-0.5
                              transition-all duration-200">

                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-8 h-8 rounded-xl bg-slate-100
                                            flex items-center justify-center shrink-0
                                            group-hover:bg-indigo-50 transition-colors duration-200">
                                    <svg class="w-5 h-5 text-slate-500 group-hover:text-indigo-600 transition-colors duration-200"
                                         fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                </div>

                                <div class="min-w-0">
                                    <p>Order #{{ $orders->count() - $index }}</p>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        {{ $order->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Chevron --}}
                            <svg class="w-5 h-5 text-slate-300 group-hover:text-indigo-500 group-hover:translate-x-1
                                        transition-all duration-200 shrink-0"
                                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>

                        {{-- Bottom row: status + total --}}
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-slate-100">
                            @php
                                $statusStyles = [
                                    'pending'    => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'processing' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'shipped'    => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                    'completed'  => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'cancelled'  => 'bg-rose-50 text-rose-700 border-rose-200',
                                ];
                                $statusClass = $statusStyles[$order->status] ?? 'bg-slate-100 text-slate-600 border-slate-200';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full
                                         text-xs font-medium border {{ $statusClass }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-current opacity-70"></span>
                                {{ ucfirst($order->status) }}
                            </span>

                            <p class="font-semibold text-slate-800">
                                ${{ number_format($order->total_price, 2) }}
                            </p>
                        </div>
                    </a>
                @empty
                    {{-- Empty state --}}
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-12 text-center">
                        <div class="mx-auto w-16 h-16 rounded-full bg-slate-100
                                    flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <p class="text-slate-600 font-medium">No orders yet</p>
                        <p class="text-slate-400 text-sm mt-1">Your order history will appear here.</p>
                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center gap-2 mt-5 px-5 py-2.5
                                  bg-gradient-to-r from-indigo-600 to-blue-600 text-white
                                  text-sm font-medium rounded-full
                                  shadow-md shadow-indigo-200 hover:shadow-lg hover:scale-[1.02]
                                  transition-all duration-200">
                            Start Shopping
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

</x-app-layout>