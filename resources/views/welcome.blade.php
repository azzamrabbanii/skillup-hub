@extends('layouts.app')

@section('title', 'SkillUp Hub - Bangun Karirmu Sekarang')

@section('content')

    <div class="relative bg-white overflow-hidden mb-12">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Tingkatkan Skill,</span>
                            <span class="block text-indigo-600 xl:inline">Raih Masa Depan</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Akses ratusan materi pembelajaran berkualitas dari instruktur ahli. Dapatkan sertifikat digital yang diakui industri untuk portofolio karirmu.
                        </p>

                        <div class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0">
                            <form action="#" method="GET" class="mt-3 sm:flex">
                                <input type="text" name="query" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-4 border" placeholder="Cari kursus (misal: Laravel)...">
                                <button type="submit" class="mt-3 w-full px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:flex-shrink-0 sm:inline-flex sm:items-center sm:w-auto">
                                    <i class="fas fa-search mr-2"></i> Cari
                                </button>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-gray-50 flex items-center justify-center">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full opacity-90" src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80" alt="Orang belajar coding">
        </div>
    </div>

    <div class="bg-indigo-800 rounded-xl shadow-lg mb-16">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Dipercaya oleh {{ $totalStudents }}+ Siswa
                </h2>
            </div>
            <dl class="mt-10 text-center sm:max-w-3xl sm:mx-auto sm:grid sm:grid-cols-3 sm:gap-8">
                <div class="flex flex-col">
                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-indigo-200">Kursus Online</dt>
                    <dd class="order-1 text-5xl font-extrabold text-white">{{ $totalCourses }}+</dd>
                </div>
                <div class="flex flex-col mt-10 sm:mt-0">
                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-indigo-200">Instruktur Ahli</dt>
                    <dd class="order-1 text-5xl font-extrabold text-white">{{ $totalInstructors }}+</dd>
                </div>
                <div class="flex flex-col mt-10 sm:mt-0">
                    <dt class="order-2 mt-2 text-lg leading-6 font-medium text-indigo-200">Sertifikat Terbit</dt>
                    <dd class="order-1 text-5xl font-extrabold text-white">5k+</dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="mb-12">
        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Kursus Terbaru</h2>
                <p class="text-gray-600 mt-1">Materi fresh yang baru saja dirilis bulan ini.</p>
            </div>
            <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium">Lihat Semua &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($courses as $course)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100 flex flex-col h-full">
                    <div class="relative">
                        <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}">

                        <span class="absolute top-2 right-2 bg-indigo-600 text-white text-xs font-bold px-2 py-1 rounded">
                            {{ $course->category->name }}
                        </span>
                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-snug">
                            <a href="{{ route('front.details', $course->slug) }}" class="hover:text-indigo-600">
                                {{ $course->name }}
                            </a>
                        </h3>

                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($course->about, 80) }}
                        </p>

                        <div class="mt-auto">
                            <div class="flex items-center mb-4">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="https://ui-avatars.com/api/?name={{ $course->teacher->name }}&background=random"
                                    alt="Instructor">
                                <p class="text-sm text-gray-700 ml-2 font-medium">
                                    {{ $course->teacher->name }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                                    <span class="ml-1 text-sm font-bold text-gray-900">4.8</span> </div>
                                <div class="text-lg font-bold text-indigo-600">
                                    Rp {{ number_format($course->price, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty

            <div class="col-span-3 text-center py-10">
                <p class="text-gray-500">Belum ada kursus yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>

@endsection
