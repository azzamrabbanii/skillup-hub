@extends('layouts.app')

@section('title', 'Admin Dashboard - SkillUp Hub')

@section('content')
<div class="flex flex-col lg:flex-row gap-6">

    <aside class="w-full lg:w-1/4">
        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100 sticky top-24">
            <div class="p-4 bg-indigo-600">
                <div class="flex items-center gap-3">
                    <img class="h-10 w-10 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=Admin+User&background=random" alt="Admin">
                    <div>
                        <p class="text-white font-bold text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-indigo-200 text-xs">Super Administrator</p>
                    </div>
                </div>
            </div>
            <nav class="p-2 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-indigo-700 font-medium rounded-md">
                    <i class="fas fa-home w-5"></i> Dashboard
                </a>

                <div class="border-t border-gray-100 my-2"></div>
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mt-4 mb-2">Master Data</p>


                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-md transition">
                    <i class="fas fa-tags w-5 text-gray-400"></i> Manage Categories
                    <span class="ml-auto bg-gray-100 text-gray-600 py-0.5 px-2 rounded-full text-xs">Arka</span>
                </a>

                <a href="{{ route('admin.courses.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-md transition">
                    <i class="fas fa-book w-5 text-gray-400"></i> Manage Courses
                    <span class="ml-auto bg-gray-100 text-gray-600 py-0.5 px-2 rounded-full text-xs">Azzam</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-md transition">
                    <i class="fas fa-users w-5 text-gray-400"></i> Manage Users
                    <span class="ml-auto bg-gray-100 text-gray-600 py-0.5 px-2 rounded-full text-xs">Nicholas</span>
                </a>

                <div class="border-t border-gray-100 my-2"></div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-md transition text-left">
                        <i class="fas fa-sign-out-alt w-5"></i> Logout
                    </button>
                </form>
            </nav>
        </div>
    </aside>

    <main class="w-full lg:w-3/4">

        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
                <p class="text-gray-500 text-sm">Welcome back, here's what's happening today.</p>
            </div>
            {{-- <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 shadow-sm text-sm font-medium">
                <i class="fas fa-download mr-2"></i> Download Report
            </button> --}}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                <div class="p-3 bg-blue-100 rounded-full text-blue-600 mr-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Students</p>
                    <p class="text-2xl font-bold text-gray-800">1,240</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                <div class="p-3 bg-green-100 rounded-full text-green-600 mr-4">
                    <i class="fas fa-book text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Active Courses</p>
                    <p class="text-2xl font-bold text-gray-800">45</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
                <div class="p-3 bg-yellow-100 rounded-full text-yellow-600 mr-4">
                    <i class="fas fa-certificate text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Certificates Issued</p>
                    <p class="text-2xl font-bold text-gray-800">328</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="font-bold text-gray-800">Recent Registrations</h3>
                <a href="#" class="text-indigo-600 text-sm hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">User</th>
                            <th class="px-6 py-3">Role</th>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                Budi Santoso
                                <div class="text-xs text-gray-500">budi@gmail.com</div>
                            </td>
                            <td class="px-6 py-4">Student</td>
                            <td class="px-6 py-4">Today, 10:23 AM</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Active</span>
                            </td>
                        </tr>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                Siti Aminah
                                <div class="text-xs text-gray-500">siti@yahoo.com</div>
                            </td>
                            <td class="px-6 py-4">Instructor</td>
                            <td class="px-6 py-4">Yesterday</td>
                            <td class="px-6 py-4">
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">Pending</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>
@endsection
