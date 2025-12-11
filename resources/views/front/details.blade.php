@extends('layouts.app')

@section('title', $course->name . ' - SkillUp Hub')

@section('content')

<div class="bg-gray-900 py-10 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl">
            <div class="text-sm text-gray-400 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <i class="fas fa-chevron-right mx-2 text-xs"></i>
                <span class="text-indigo-400">{{ $course->category->name }}</span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $course->name }}</h1>
            <p class="text-gray-300 text-lg mb-6">{{ Str::limit($course->about, 150) }}</p>

            <div class="flex items-center text-sm">
                <div class="flex items-center mr-6">
                    <img class="h-8 w-8 rounded-full border border-gray-600 mr-2"
                         src="https://ui-avatars.com/api/?name={{ $course->teacher->name }}&background=random" alt="Instructor">
                    <span>Created by <span class="text-indigo-400 font-bold">{{ $course->teacher->name }}</span></span>
                </div>
                <div class="flex items-center mr-6">
                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                    <span class="font-bold">4.8</span>
                    <span class="text-gray-400 ml-1">(120 ratings)</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-globe mr-2 text-gray-400"></i> Bahasa Indonesia
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="flex flex-col-reverse lg:flex-row gap-12">

        <div class="w-full lg:w-2/3">

            @if($course->path_trailer)
            <div class="mb-10 rounded-xl overflow-hidden shadow-lg border border-gray-100">
                <div class="aspect-w-16 aspect-h-9 bg-gray-100 relative">
                    <iframe class="w-full h-[400px]"
                            src="https://www.youtube.com/embed/{{ $course->youtube_id }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                </div>
            </div>
            @endif

            <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">About This Course</h3>
                <div class="prose max-w-none text-gray-600 leading-relaxed">
                    {!! nl2br(e($course->about)) !!}
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Curriculum</h3>

                @forelse($course->lessons as $lesson)
                    <div class="flex items-center justify-between border-b border-gray-100 py-4 last:border-0 hover:bg-gray-50 transition px-2 rounded">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 text-indigo-600 w-8 h-8 rounded-full flex items-center justify-center mr-4 text-sm font-bold">
                                {{ $lesson->chapter }}
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-play-circle text-gray-400 mr-3"></i>
                                <span class="text-gray-700 font-medium">{{ $lesson->name }}</span>
                            </div>
                        </div>
                        <span class="text-xs font-semibold bg-gray-100 text-gray-500 px-2 py-1 rounded">
                            <i class="fas fa-lock mr-1"></i> Locked
                        </span>
                    </div>
                @empty
                    <div class="text-center py-8 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                        <i class="fas fa-clipboard-list text-gray-400 text-3xl mb-3"></i>
                        <p class="text-gray-500">Materi belum diupload oleh instruktur.</p>
                        <p class="text-xs text-gray-400 mt-1">(Ini tugas Maya nanti)</p>
                    </div>
                @endforelse
            </div>

        </div>

        <div class="w-full lg:w-1/3 relative">
            <div class="sticky top-24">
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">

                    <div class="relative">
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail" class="w-full h-56 object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                    </div>

                    <div class="p-6">
                        <div class="mb-6">
                            <p class="text-gray-500 text-sm line-through">Rp {{ number_format($course->price * 1.5, 0, ',', '.') }}</p>
                            <h2 class="text-3xl font-bold text-indigo-600">Rp {{ number_format($course->price, 0, ',', '.') }}</h2>
                        </div>

                        <a href="#" class="block w-full bg-indigo-600 text-white text-center font-bold text-lg py-4 rounded-lg hover:bg-indigo-700 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 mb-4">
                            Join This Course
                        </a>

                        <p class="text-center text-xs text-gray-500 mb-6">30-Day Money-Back Guarantee</p>

                        <div class="space-y-3 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-video w-6 text-indigo-500"></i>
                                <span>Full Lifetime Access</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-mobile-alt w-6 text-indigo-500"></i>
                                <span>Access on Mobile and TV</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-certificate w-6 text-indigo-500"></i>
                                <span>Certificate of Completion</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
