@extends('layouts.app')

@section('title', 'Edit Lesson')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-xl font-bold mb-4">Edit Lesson: {{ $lesson->name }}</h2>

        <form action="{{ route('admin.lessons.update', $lesson) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Lesson Title</label>
                <input type="text" name="name" value="{{ $lesson->name }}" class="w-full border border-gray-300 rounded p-2 focus:ring-indigo-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Chapter Number</label>
                <input type="number" name="chapter" value="{{ $lesson->chapter }}" class="w-full border border-gray-300 rounded p-2 focus:ring-indigo-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Youtube Video URL</label>
                <input type="text" name="video_url" value="{{ $lesson->video_url }}" class="w-full border border-gray-300 rounded p-2 focus:ring-indigo-500" required>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 w-full font-bold">Update Lesson</button>
        </form>
    </div>
</div>
@endsection