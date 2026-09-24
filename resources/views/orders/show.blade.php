<x-app-layout>

    <div class="p-6 w-120 m-auto">

        <h1 style="font-size: 24px; font-weight: 600; margin-bottom: 8px;">Order #{{ $order->id }}</h1>
        <p style="color:#666; margin-bottom:20px;">Placed on {{ $order->created_at->format('M d, Y') }}</p>

        @foreach ($order->items as $item)
            <div style="display:flex; justify-content:space-between; border-bottom:1px solid #eee; padding:12px 0;">
                <div>
                    <p style="font-weight:500;">{{ $item->product->name ?? 'Product removed' }}</p>
                    <p style="color:#666; font-size:14px;">${{ $item->price }} x {{ $item->quantity }}</p>
                </div>
                <p style="font-weight:600;">${{ number_format($item->price * $item->quantity, 2) }}</p>
            </div>
        @endforeach

        

        <div style="margin-top:20px; text-align:right;">
            <p style="font-size:20px; font-weight:600;">
                Total: ${{ number_format($order->total_price, 2) }}
            </p>
        </div>

    </div>

</x-app-layout>