<x-app-layout>
    <h1>Edit Category</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ old('name', $category->name) }}">
        @error('name')
            <div style="color:red;">{{ $message }}</div>
        @enderror

        <button type="submit">Update</button>
    </form>
</x-app-layout>