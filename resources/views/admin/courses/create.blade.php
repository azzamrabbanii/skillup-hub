@extends('layouts.app')

@section('title', 'Add New Course')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Add New Course</h1>
        <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-gray-900">
            &larr; Back to List
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Course Name</label>
                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" placeholder="e.g. Mastering Laravel 11" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                    <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price (IDR)</label>
                    <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" placeholder="150000" required>
                </div>
            </div>

            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="thumbnail">Course Thumbnail</label>
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="thumbnail" name="thumbnail" type="file" required>
                <p class="mt-1 text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 2MB).</p>
            </div>

            <div class="mb-5">
                <label for="path_trailer" class="block mb-2 text-sm font-medium text-gray-900">Youtube Trailer URL (Optional)</label>
                <input type="text" name="path_trailer" id="path_trailer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" placeholder="https://youtube.com/watch?v=...">
            </div>

            <div class="mb-5">
                <label for="about" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                <textarea id="about" name="about" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Write course description here..." required></textarea>
            </div>

            <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                Save New Course
            </button>
        </form>

    </div>
</div>
@endsection
