@extends('layouts.app')

@section('content')
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Category</h1>

    <div class="bg-white p-6 rounded-xl shadow">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Category Name</label>
                <input type="text" name="name" value="{{ $category->name }}" class="w-full border p-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Current Icon</label>
                <img src="{{ asset('storage/' . $category->icon) }}" class="w-16 h-16 object-contain border rounded p-1">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Change Icon (Optional)</label>
                <input type="file" name="icon" class="w-full border p-2 rounded-lg">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg font-bold hover:bg-indigo-700">
                Update Category
            </button>
        </form>
    </div>
</div>
@endsection
