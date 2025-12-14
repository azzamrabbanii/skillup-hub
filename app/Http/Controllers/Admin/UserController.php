<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Ambil data user terbaru, 10 per halaman
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        // Gaboleh hapus diri sendiri
        if ($user->id == Auth::id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
