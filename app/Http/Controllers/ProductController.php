<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
class ProductController extends Controller



{
    /**
     * Display a listing of all products.
*/
    public function index(Request $request)
{
    $product = Product::all();
    $categories = Category::all();

    $carts = auth()->check()
        ? Cart::where('user_id', auth()->id())->with('product')->get()
        : collect();

    $cartTotal = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

    return view('products.index', compact('product', 'categories', 'carts', 'cartTotal'));
}

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'details' => 'nullable|string',
            'stock' => 'required|integer',
            'image' => 'required|string|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);

          $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added!');
    }

    /**
     * Display a single product.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing a product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update a product.
     */
    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'details' => 'nullable|string',
        'stock' => 'required|integer',
        'image' => 'nullable|image|max:2048',
        'category_id' => 'nullable|exists:categories,id',
    ]);

    $data = $request->only(['category_id', 'name', 'price', 'details', 'stock']);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Product updated!');
}

    /**
     * Delete a product.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }

    /**
     * Show products filtered by category.
     */
    public function byCategory(Category $category)
    {
        $product = $category->products;
        $categories = Category::all();

        $carts = auth()->check()
            ? Cart::where('user_id', auth()->id())->with('product')->get()
            : collect();

        $cartTotal = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        return view('products.index', compact('product', 'categories', 'carts', 'cartTotal'));
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->query('q') . '%')->get();

        return response()->json($products);
    }

}