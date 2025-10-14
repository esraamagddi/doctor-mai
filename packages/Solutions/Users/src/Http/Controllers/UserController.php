<?php

namespace Solutions\Users\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int)$request->get('per_page', 12);
        $items = User::orderByDesc('id')->paginate($perPage);
        return view('users::index', compact('items'));
    }

    public function create()
    {
        return view('users::create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:50',
            'password' => 'required|string|min:6|confirmed',
            'avatar' => 'nullable|image|max:2048',
            'role_id' => 'nullable|integer' // assigned via AccessControl if present
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        // assign role if AccessControl installed
        if (class_exists('Solutions\\AccessControl\\Models\\Role') && $request->filled('role_id')) {
            $role = \Solutions\AccessControl\Models\Role::find($request->input('role_id'));
            if ($role) {
                $user->roles()->sync([$role->id]);
            }
        }

        return redirect()->route('users.index')->with('success', __('users::messages.created'));
    }

    public function edit(User $user)
    {
        return view('users::edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:150',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|max:50',
            'password' => 'nullable|string|min:6|confirmed',
            'avatar'    => 'nullable|image|max:2048',
            'role_id'  => 'nullable|integer',
        ]);

        if ($request->hasFile('avatar')) {
            if (!empty($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        unset($data['role_id']);

        $user->update($data);

        if (class_exists('Solutions\\AccessControl\\Models\\Role')) {
            $roleId = null;

            if (
                $request->filled('role_id') &&
                \Solutions\AccessControl\Models\Role::whereKey($request->input('role_id'))->exists()
            ) {
                $roleId = (int) $request->input('role_id');
            }


            $user->forceFill(['role_id' => $roleId])->save();
        }

        return redirect()->route('users.index')->with('success', __('users::messages.updated'));
    }


    public function destroy(User $user)
    {
        if ($user->avatar ?? false) {
            Storage::disk('public')->delete($user->avatar);
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', __('users::messages.deleted'));
    }
}
