<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $cart = Cart::where('user_id', auth()->id())
                     ->where('product_id', $product->id)
                     ->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Added to cart!');
    }

    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        $total = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        return view('cart.index', compact('carts', 'total'));
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with('success', 'Removed from cart!');
    }

    public function data()
{
    $carts = Cart::where('user_id', auth()->id())->with('product')->get();
    $total = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

    return response()->json([
        'items' => $carts->map(fn($cart) => [
            'id' => $cart->id,
            'name' => $cart->product->name,
            'price' => $cart->product->price,
            'quantity' => $cart->quantity,
            'subtotal' => $cart->product->price * $cart->quantity,
        ]),
        'total' => $total,
    ]);
}


}