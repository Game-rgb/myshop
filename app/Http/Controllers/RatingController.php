<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'stars' => 'required|integer|min:1|max:5',
        ]);

        Rating::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $product->id],
            ['stars' => $request->stars]
        );

        return back()->with('success', 'Thanks for your rating!');
    }
}