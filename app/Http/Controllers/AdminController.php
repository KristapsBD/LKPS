<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function viewAllUsers()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.users', ['users' => $users]);
    }

    public function editUser(User $user)
    {
        // Implement edit user functionality
        return view('admin.editUser', ['user' => $user]);
    }

    public function updateUser(Request $request, User $user)
    {
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function deleteUser(User $user)
    {
        // Implement delete user functionality
        $user->delete();
        return response(null, 204)->with('success', 'User deleted successfully.');
        // return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
