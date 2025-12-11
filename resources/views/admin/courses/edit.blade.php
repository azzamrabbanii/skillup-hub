@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Course: {{ $course->name }}</h1>
        <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-gray-900">
            &larr; Back to List
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

        <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Course Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                    <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $course->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price (IDR)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $course->price) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5" required>
                </div>
            </div>

            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="thumbnail">Course Thumbnail</label>

                <div class="mb-2">
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Current Thumbnail" class="w-32 h-20 object-cover rounded border">
                    <p class="text-xs text-gray-500 mt-1">Current Image</p>
                </div>

                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="thumbnail" name="thumbnail" type="file">
                <p class="mt-1 text-xs text-gray-500">Leave empty if you don't want to change the image.</p>
            </div>

            <div class="mb-5">
                <label for="path_trailer" class="block mb-2 text-sm font-medium text-gray-900">Youtube Trailer URL (Optional)</label>
                <input type="text" name="path_trailer" id="path_trailer" value="{{ old('path_trailer', $course->path_trailer) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5">
            </div>

            <div class="mb-5">
                <label for="about" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                <textarea id="about" name="about" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('about', $course->about) }}</textarea>
            </div>

            <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                Update Course
            </button>
        </form>

    </div>
</div>
@endsection
