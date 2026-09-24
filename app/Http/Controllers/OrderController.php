<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{


public function adminIndex()
{
    abort_if(auth()->user()->role !== 'admin', 403);

    $orders = Order::with('user', 'items.product')->latest()->get();
    return view('orders.admin', compact('orders'));
}

public function charts()
{
    abort_if(auth()->user()->role !== 'admin', 403);

    $orders = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $labels = $orders->pluck('date');
    $totals = $orders->pluck('total');

    return view('orders.charts', compact('labels', 'totals'));
}

    public function store(Request $request)
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        $total = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'status' => 'completed', // fake checkout, no real payment
        ]);

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }


}