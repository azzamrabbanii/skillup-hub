<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    public function edit()
    {
        $user = Auth::user();
        return view('front.profile.edit', compact('user'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);


        $data = [
            'name' => $request->name,
            'occupation' => $request->occupation,
            'email' => $request->email,
        ];


        if ($request->hasFile('avatar')) {

            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $avatarPath;
        }

        
        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
