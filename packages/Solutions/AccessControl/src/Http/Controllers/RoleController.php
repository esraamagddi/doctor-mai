<?php

namespace Solutions\AccessControl\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Solutions\AccessControl\Models\Role;
use Solutions\AccessControl\Models\Permission;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $items = Role::orderBy('name')->paginate(20);
        return view('acl::roles.index', compact('items'));
    }

    public function create()
    {
        $perms = Permission::orderBy('module')->orderBy('key')->get()->groupBy('module');
        return view('acl::roles.create', compact('perms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:roles,name',
            'permissions' => 'array'
        ]);
        $role = Role::create(['name' => $data['name']]);
        $role->permissions()->sync($request->input('permissions', []));
        return redirect()->route('roles.index')->with('success', __('acl::messages.saved'));
    }

    public function edit(Role $role)
    {
        $perms = Permission::orderBy('module')->orderBy('key')->get()->groupBy('module');
        $selected = $role->permissions()->pluck('permissions.id')->toArray();
        return view('acl::roles.edit', compact('role','perms','selected'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:roles,name,' . $role->id,
            'permissions' => 'array'
        ]);
        $role->update(['name' => $data['name']]);
        $role->permissions()->sync($request->input('permissions', []));
        return redirect()->route('roles.index')->with('success', __('acl::messages.saved'));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', __('acl::messages.deleted'));
    }
}
