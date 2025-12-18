<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SkillUp Hub')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="bg-white shadow-md border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600">
                            <i class="fas fa-graduation-cap"></i> SkillUp Hub
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ url('/') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Home
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Courses
                        </a>
                    </div>
                </div>

                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">

                    @auth
                        <div class="flex items-center space-x-3">
                            
                            <span class="text-gray-700 text-sm font-medium">
                                Hello, <strong>{{ Auth::user()->name }}</strong>
                            </span>
                            <a href="{{ route('profile.edit') }}" class="hover:text-blue-700 transition duration-150 cursor-pointer">
                                <i class="fas fa-user-circle text-2xl"></i>
                            </a>

                            
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-md text-sm font-medium transition duration-150">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                            Log in
                        </a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out shadow-sm">
                            Sign up
                        </a>
                    @endauth

                </div>

                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="max-w-7xl mx-auto">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex justify-between items-center" role="alert">
                    <div>
                        <p class="font-bold">Success</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm" role="alert">
                    <p class="font-bold">Error</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif
        </div>

        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                &copy; 2025 SkillUp Hub - Group 1 Project. All rights reserved.
            </p>
        </div>
    </footer>

</body>
</html>
