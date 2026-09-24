@extends('app')

@section('content')

<h1>Shop by Category</h1>

<div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:16px;">
    @foreach ($categories as $cat)
        <a href="{{ route('products.byCategory', $cat->id) }}" style="text-decoration:none; color:inherit;">
            <div style="border:1px solid #ddd; padding:20px; border-radius:10px; text-align:center;">
                <h3>{{ $cat->name }}</h3>
                <p style="color:#666; font-size:14px;">{{ $cat->products->count() }} products</p>
            </div>
        </a>
    @endforeach
</div>



@endsection