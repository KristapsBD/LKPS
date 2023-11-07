<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Parcel;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // User CRUD
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
        return response()->json();
    }

    // Parcel Crud
    public function viewAllParcels()
    {
        $parcels = Parcel::all(); // Fetch all parcels from the database
        return view('admin.parcels', ['parcels' => $parcels]);
    }

    public function createParcelForm()
    {
        return view('admin.createParcel');
    }

    public function createParcel(Request $request)
    {
        // Validation rules go here
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Create the new parcel
        $parcel = Parcel::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('admin.parcels')->with('success', 'Parcel created successfully.');
    }

    public function editParcelForm(Parcel $parcel)
    {
        // Implement edit parcel functionality
        return view('admin.editParcel', ['parcel' => $parcel]);
    }

    public function editParcel(Request $request, Parcel $parcel)
    {
        $parcel->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        return redirect()->route('admin.parcels')->with('success', 'Parcel updated successfully.');
    }

    public function deleteParcel(Parcel $parcel)
    {
        // Implement delete parcel functionality
        $parcel->delete();
        session()->flash('success', 'Parcel deleted successfully.');
        return response()->json();
    }
}
