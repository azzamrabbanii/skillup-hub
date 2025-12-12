@extends('layouts.app')

@section('title', 'Learning: ' . $course->name)

@section('content')
<div class="bg-gray-900 min-h-screen text-white pb-10">

    <div class="border-b border-gray-800 bg-gray-900 py-4 px-6 flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center">
            <a href="{{ route('front.details', $course->slug) }}" class="text-gray-400 hover:text-white mr-4 transition">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <h1 class="text-lg font-bold truncate max-w-xl text-indigo-400">{{ $course->name }}</h1>
        </div>
        <div>
            <span class="bg-gray-800 border border-gray-700 text-xs font-bold px-3 py-1 rounded-full text-gray-300">
                <i class="fas fa-user-graduate mr-1"></i> Student Mode
            </span>
        </div>
    </div>

    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col lg:flex-row gap-8">

            <div class="w-full lg:w-3/4">

                @if($currentLesson)
                    <div class="aspect-w-16 aspect-h-9 bg-black rounded-xl overflow-hidden shadow-2xl border border-gray-800 mb-6 relative">
                        <iframe class="w-full h-[500px]"
                            src="https://www.youtube.com/embed/{{ $youtubeId }}?rel=0&modestbranding=1&autoplay=0"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <div class="flex justify-between items-start bg-gray-800 p-6 rounded-xl border border-gray-700">
                        <div>
                            <p class="text-sm text-gray-400 mb-1">Current Lesson:</p>
                            <h2 class="text-2xl font-bold text-white">
                                <span class="text-indigo-500 mr-2">#{{ $currentLesson->chapter }}</span>
                                {{ $currentLesson->name }}
                            </h2>
                        </div>
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg text-sm font-bold transition shadow-lg">
                            Next Lesson <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                @else
                    <div class="bg-gray-800 p-12 rounded-xl text-center border border-gray-700">
                        <i class="fas fa-film text-6xl text-gray-600 mb-4"></i>
                        <h2 class="text-xl font-bold text-white">No Lessons Available</h2>
                        <p class="text-gray-400 mt-2">Instructor hasn't uploaded any content yet.</p>
                    </div>
                @endif

            </div>

            <div class="w-full lg:w-1/4">
                <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden sticky top-24">
                    <div class="p-4 border-b border-gray-700 bg-gray-900 flex justify-between items-center">
                        <h3 class="font-bold text-white">Course Content</h3>
                        <span class="text-xs bg-gray-700 px-2 py-1 rounded text-gray-300">
                            {{ $course->lessons->count() }} Videos
                        </span>
                    </div>

                    <div class="max-h-[500px] overflow-y-auto custom-scrollbar">
                        @forelse($course->lessons as $lesson)
                            <a href="{{ route('learning.show', [$course->slug, $lesson->id]) }}"
                               class="block p-4 border-b border-gray-700 hover:bg-gray-700 transition duration-200
                               {{ isset($currentLesson) && $currentLesson->id == $lesson->id ? 'bg-gray-700 border-l-4 border-indigo-500' : 'border-l-4 border-transparent' }}">
                                <div class="flex items-start">
                                    <div class="mr-3 mt-1">
                                        @if(isset($currentLesson) && $currentLesson->id == $lesson->id)
                                            <i class="fas fa-play-circle text-indigo-400 text-lg animate-pulse"></i>
                                        @else
                                            <i class="far fa-play-circle text-gray-500 text-lg"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium {{ isset($currentLesson) && $currentLesson->id == $lesson->id ? 'text-white' : 'text-gray-400' }}">
                                            {{ $lesson->name }}
                                        </p>
                                        <span class="text-xs text-gray-500">Chapter {{ $lesson->chapter }}</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="p-4 text-center text-sm text-gray-500">
                                Playlist kosong.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
