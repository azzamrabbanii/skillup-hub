<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Tampilkan Form Edit
    public function edit()
    {
        $user = Auth::user();
        return view('front.profile.edit', compact('user'));
    }

    // Proses Simpan Data
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ]);

        // Simpan Data Text
        $data = [
            'name' => $request->name,
            'occupation' => $request->occupation,
            'email' => $request->email,
        ];

        // Logic Upload Avatar (Jika user upload foto baru)
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada (dan bukan foto default)
            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            // Simpan foto baru
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        // Update Database User
        // Note: Kita pakai method forceFill atau update biasa
        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
