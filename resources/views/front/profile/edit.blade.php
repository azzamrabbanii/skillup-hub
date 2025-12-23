@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-2xl mx-auto px-4">

        <div class="flex items-center mb-6">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Edit Profile</h1>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">


            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')


                <div class="flex flex-col items-center mb-8">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-indigo-100 mb-4">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                             class="w-full h-full object-cover">
                    </div>
                    <label class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                        <i class="fas fa-camera mr-2"></i> Change Photo
                        <input type="file" name="avatar" class="hidden">
                    </label>
                </div>

                <div class="grid gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    </div>


                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                        <input type="text" name="occupation" value="{{ old('occupation', $user->occupation) }}" placeholder="e.g. Student, Software Engineer"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg">
                        Save Changes
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
