@extends('layouts.app')

@section('title', 'Manage Courses - Admin')

@section('content')
<div class="flex flex-col lg:flex-row gap-6">

    <main class="w-full">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Course Management</h1>
                <p class="text-gray-500 text-sm">List of all courses available on SkillUp Hub.</p>
            </div>
            <a href="{{ route('admin.courses.create') }}" class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 shadow-md transition font-medium">
                <i class="fas fa-plus mr-2"></i> Add New Course
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Thumbnail</th>
                            <th class="px-6 py-3">Course Name</th>
                            <th class="px-6 py-3">Category</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $index => $course)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" class="w-16 h-10 object-cover rounded" alt="Thumb">
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $course->name }}
                                <div class="text-xs text-gray-400">Slug: {{ $course->slug }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    {{ $course->category->name }} </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-800">
                                Rp {{ number_format($course->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.courses.lessons.index', $course) }}" class="text-white bg-indigo-500 hover:bg-indigo-600 border border-indigo-600 p-2 rounded mr-2" title="Manage Lessons">
                                            <i class="fas fa-layer-group"></i> 
                                        </a>
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="text-indigo-600 hover:text-indigo-900 border border-indigo-200 p-2 rounded hover:bg-indigo-50" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 border border-red-200 p-2 rounded hover:bg-red-50" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-folder-open text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-lg font-medium">No courses found</p>
                                    <p class="text-sm text-gray-400 mb-4">Start by creating your first course.</p>
                                    <a href="{{ route('admin.courses.create') }}" class="text-indigo-600 hover:underline">Create Course Now</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $courses->links() }}
            </div>
        </div>
    </main>
</div>
@endsection
