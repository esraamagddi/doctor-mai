<?php

namespace Solutions\UserProfile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();
        return view('userprofile::edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'phone'    => ['nullable','string','max:30', Rule::unique('users','phone')->ignore($user->id)],
            'avatar'   => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'password' => ['nullable','string','min:8','confirmed'],
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        if (!empty($data['password'] ?? null)) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('profile.edit')
            ->with('success', __('userprofile::messages.updated_successfully'));
    }
}