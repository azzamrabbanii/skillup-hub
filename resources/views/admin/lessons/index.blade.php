@extends('layouts.app')

@section('title', 'Manage Lessons')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Course Materials</h1>
            <p class="text-sm text-gray-500">Course: <span class="font-bold text-indigo-600">{{ $course->name }}</span></p>
        </div>
        <div>
            <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                &larr; Back to Courses
            </a>
            <a href="{{ route('admin.courses.lessons.create', $course) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 shadow-md">
                <i class="fas fa-plus mr-2"></i> Add New Lesson
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Chapter</th>
                    <th class="px-6 py-3">Lesson Title</th>
                    <th class="px-6 py-3">Video URL</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lessons as $lesson)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-bold text-gray-800">#{{ $lesson->chapter }}</td>
                    <td class="px-6 py-4">{{ $lesson->name }}</td>
                    <td class="px-6 py-4 text-blue-500 truncate max-w-xs">
                        <a href="{{ $lesson->video_url }}" target="_blank">{{ Str::limit($lesson->video_url, 30) }}</a>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.lessons.edit', $lesson) }}" class="text-indigo-600 hover:underline mr-3">Edit</a>
                        <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST" class="inline" onsubmit="return confirm('Delete this lesson?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-6 text-gray-500">No lessons uploaded yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection