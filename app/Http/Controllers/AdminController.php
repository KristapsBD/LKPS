<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function createUserForm()
    {
        return view('admin.createUser');
    }

    public function createUser(Request $request)
    {
        // Validation rules go here
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Create the new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function editUserForm(User $user)
    {
        // Implement edit user functionality
        return view('admin.editUser', ['user' => $user]);
    }

    public function editUser(Request $request, User $user)
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
        session()->flash('success', 'User deleted successfully.');
        return response()->json(['message' => 'User deleted successfully']);
        // return response(null, 204)->with('success', 'User deleted successfully.');
        // return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }
}
