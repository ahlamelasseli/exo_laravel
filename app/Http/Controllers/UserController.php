<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        // Prevent changing own role
        if ($user->id == auth()->id()) {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }

        // Prevent assigning admin role
        $role = Role::find($request->role_id);
        if ($role->name == 'admin') {
            return redirect()->back()->with('error', 'Cannot assign admin role.');
        }

        $user->update(['role_id' => $request->role_id]);

        return redirect()->back()->with('success', 'User role updated successfully!');
    }
}

