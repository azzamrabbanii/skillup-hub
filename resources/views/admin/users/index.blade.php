@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manage Users</h1>
    </div>

    {{-- Pesan Sukses/Error --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 border-b">Nama User</th>
                    <th class="p-4 border-b">Role</th>
                    <th class="p-4 border-b">Tanggal Join</th>
                    <th class="p-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 border-b">
                        <div class="font-bold">{{ $user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                    </td>
                    <td class="p-4 border-b">
                        @if($user->hasRole('owner'))
                            <span class="bg-purple-200 text-purple-800 text-xs px-2 py-1 rounded">Owner</span>
                        @elseif($user->hasRole('teacher'))
                            <span class="bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded">Instructor</span>
                        @elseif($user->hasRole('student'))
                            <span class="bg-green-200 text-green-800 text-xs px-2 py-1 rounded">Student</span>
                        @else
                            <span class="bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded">User</span>
                        @endif
                    </td>
                    <td class="p-4 border-b">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="p-4 border-b text-center">
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:text-red-700 font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
