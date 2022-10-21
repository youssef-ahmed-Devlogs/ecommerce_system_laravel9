<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('backend.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('backend.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
        ]);
        $data = $request->all();
        $data['name'] =  strtolower(str_replace(' ', '_', $request->name));
        $data['display_name'] = $request->name;
        $data['description'] = $request->description ? $request->description : $request->name;

        $role = Role::create($data);

        flash()->addSuccess('The role has been created successfully.');
        return redirect()->route('backend.roles.index');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('backend.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
        ]);
        $data = $request->all();
        $data['name'] = strtolower(str_replace(' ', '_', $request->name));
        $data['display_name'] = $request->name;
        $data['description'] = $request->description ? $request->description : $request->name;

        $role = Role::findOrFail($id);
        $role->update($data);

        flash()->addSuccess('The role has been updated successfully.');
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        Role::destroy($id);

        flash()->addSuccess('The role has been deleted successfully.');
        return redirect()->route('backend.roles.index');
    }
}
