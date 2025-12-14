@extends('layouts.app')

@section('content')
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add New Category</h1>

    <div class="bg-white p-6 rounded-xl shadow">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Category Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded-lg" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Icon (Image)</label>
                <input type="file" name="icon" class="w-full border p-2 rounded-lg" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg font-bold hover:bg-indigo-700">
                Save Category
            </button>
        </form>
    </div>
</div>
@endsection
