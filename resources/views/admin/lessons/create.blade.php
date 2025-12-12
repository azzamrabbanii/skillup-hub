@extends('layouts.app')

@section('title', 'Add Lesson')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-xl font-bold mb-4">Add Lesson to: {{ $course->name }}</h2>

        <form action="{{ route('admin.courses.lessons.store', $course) }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Lesson Title</label>
                <input type="text" name="name" class="w-full border border-gray-300 rounded p-2 focus:ring-indigo-500" placeholder="e.g. Introduction to MVC" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Chapter Number</label>
                <input type="number" name="chapter" class="w-full border border-gray-300 rounded p-2 focus:ring-indigo-500" placeholder="1" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Youtube Video URL</label>
                <input type="text" name="video_url" class="w-full border border-gray-300 rounded p-2 focus:ring-indigo-500" placeholder="https://youtube.com/watch?v=..." required>
                <p class="text-xs text-gray-500 mt-1">Gunakan link full Youtube.</p>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 w-full font-bold">Save Lesson</button>
        </form>
    </div>
</div>
@endsection