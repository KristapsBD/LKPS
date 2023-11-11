<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
//            'password' => 'required|string|min:8',
        ]);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
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
            'size' => 'required|in:s,m,l,xl',
            'weight' => 'required|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'sender_id' => 'required|exists:users,id',
//            'sender_name' => 'required|string',
//            'sender_email' => 'required|email',
//            'sender_phone' => 'required|string',
//            'sender_address' => 'required|string',
            'dropoff_date' => 'required|date',
            'dropoff_time_from' => 'required|date_format:H:i',
            'dropoff_time_to' => 'required|date_format:H:i',
            'receiver_name' => 'required|string',
            'receiver_email' => 'required|email',
            'receiver_phone' => 'required|string',
            'receiver_address' => 'required|string',
        ]);

        $sender = User::findOrFail($validatedData['sender_id']);

        $receiver = Client::create([
            'name' => $validatedData['receiver_name'],
            'email' => $validatedData['receiver_email'],
            'phone' => $validatedData['receiver_phone'],
        ]);

        // Create the new parcel
        $parcel = Parcel::create([
            'size' => $validatedData['size'],
            'weight' => $validatedData['weight'],
            'notes' => $validatedData['notes'],
        ]);

        $parcel->sender()->associate($sender);
        $parcel->receiver()->associate($receiver);

        $parcel->save();

        return redirect()->route('admin.parcels')->with('success', 'Parcel created successfully.');
    }

    public function editParcelForm(Parcel $parcel)
    {
        // Implement edit parcel functionality
        return view('admin.editParcel', ['parcel' => $parcel]);
    }

    public function editParcel(Request $request, Parcel $parcel)
    {
        $validatedData = $request->validate([
            'size' => 'required|in:s,m,l,xl',
            'weight' => 'required|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:clients,id',
////            'sender_name' => 'required|string',
////            'sender_email' => 'required|email',
////            'sender_phone' => 'required|string',
////            'sender_address' => 'required|string',
//            'dropoff_date' => 'required|date',
//            'dropoff_time_from' => 'required|date_format:H:i',
//            'dropoff_time_to' => 'required|date_format:H:i',
//            'receiver_name' => 'required|string',
//            'receiver_email' => 'required|email',
//            'receiver_phone' => 'required|string',
//            'receiver_address' => 'required|string',
        ]);

        $parcel->update([
            'size' => $validatedData['size'],
            'weight' => $validatedData['weight'],
            'notes' => $validatedData['notes'],
            'sender_id' => $validatedData['sender_id'],
            'receiver_id' => $validatedData['receiver_id'],
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
