@extends('layouts.app')

@section('title', 'Login - SkillUp Hub')

@section('content')
<div class="flex justify-center items-center h-[70vh]">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <h2 class="text-2xl font-bold text-center text-indigo-600 mb-6">Welcome Back!</h2>

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                Login
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register here</a>
        </p>
    </div>
</div>
@endsection
