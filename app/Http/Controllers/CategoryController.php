<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    
    

public function index()
{
    $categories = Category::all();
    return view('categories.index', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name',
    ]);

    Category::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
    ]);

    return redirect()->route('categories.index')->with('success', 'Category created!');
}

public function create()
{
    return view('categories.create');
}

public function show(Category $category)
{
    return view('categories.show', compact('category'));
}

public function edit(Category $category)
{
    return view('categories.edit', compact('category'));
}

public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
    ]);

    return redirect()->route('categories.index')->with('success', 'Category updated!');
}

public function destroy(Category $category)
{
    $category->delete();
    return redirect()->route('categories.index')->with('success', 'Category deleted!');
}
}
