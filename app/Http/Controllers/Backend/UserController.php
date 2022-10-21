<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Rules\VerifyPasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $otherData = [
            'password' => Hash::make($request->password),
            'email_verified_at' => now()
        ];

        if ($request->hasFile('user_image')) {
            $user_image = $request->file('user_image')->store('users_profile', 'public');
            $otherData['user_image'] =  $user_image;
        }

        $userData = [
            ...$request->all(),
            ...$otherData
        ];

        $user = User::create($userData);
        $user->attachRole($request->role);

        flash()->addSuccess('The user ' . $user->first_name . ' has been created successfully.');

        return redirect()->route('backend.users.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('backend.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        $user->syncRoles($request->roles);
        flash()->addSuccess('The main info has been changed successfully.');
        return redirect()->back();
    }

    public function updateProfileImage(Request $request, $id)
    {

        $request->validate([
            'user_image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);

        $user = User::findOrFail($id);

        if ($user->user_image && Storage::disk('public')->exists($user->user_image)) {
            // Remove old image
            Storage::disk('public')->delete($user->user_image);
        }

        if ($request->hasFile('user_image')) {
            $user->user_image = $request->file('user_image')->store('users_profile', 'public');
            $user->save();
        }
        flash()->addSuccess('The profile has been changed successfully.');
        return redirect()->back();
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'password' => ['required', new VerifyPasswordRule($user)],
            'newPassword' => ['required', 'min:8'],
            'passwordConfirm' => ['required', 'min:8', 'same:newPassword']
        ]);

        $user->password = Hash::make($request->newPassword);
        $user->save();

        flash()->addSuccess('The password has been changed successfully.');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        User::destroy($id);

        flash()->addSuccess('The user has been deleted successfully.');
        return redirect()->route('backend.users.index');
    }
}
