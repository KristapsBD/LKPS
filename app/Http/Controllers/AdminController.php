<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use App\Models\Tariff;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Parcel;
use Illuminate\Support\Facades\Hash;

// TODO implement driver can change status functionality -
// Implement route generation functionality
// Implement dividing client delivery addresses to couriers functionality
// Implement email system for notifications
// Implement payment system

class AdminController extends Controller
{
    // User CRUD
    public function index()
    {
        return view('admin.dashboard');
    }

    public function viewAllUsers()
    {
        $users = User::paginate(10);
        return view('admin.user.users', compact('users'));
    }

    public function createUserForm()
    {
        return view('admin.user.createUser');
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
        return view('admin.user.editUser', ['user' => $user]);
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
        $parcels = Parcel::paginate(10);
        return view('admin.parcel.parcels', compact('parcels'));
    }

    public function createParcelForm()
    {
        return view('admin.parcel.createParcel');
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
        return view('admin.parcel.editParcel', ['parcel' => $parcel]);
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

    // Vehicle CRUD
    public function viewAllVehicles()
    {
        $vehicles = Vehicle::paginate(10);
        return view('admin.vehicle.vehicles', compact('vehicles'));
    }

    public function createVehicleForm()
    {
        return view('admin.vehicle.createVehicle');
    }

    public function createVehicle(Request $request)
    {
        // Validation rules go here
        $validatedData = $request->validate([
            'registration_number' => 'required|unique:vehicles,registration_number|string|max:12',
            'type' => 'required|in:1,2,3',
        ]);

        // Create the new vehicle
        $vehicle = Vehicle::create([
            'registration_number' => $validatedData['registration_number'],
            'type' => $validatedData['type'],
        ]);

        return redirect()->route('admin.vehicles')->with('success', 'Vehicle created successfully.');
    }

    public function editVehicleForm(Vehicle $vehicle)
    {
        // Implement edit vehicle functionality
        return view('admin.vehicle.editVehicle', ['vehicle' => $vehicle]);
    }

    public function editVehicle(Request $request, Vehicle $vehicle)
    {
        $validatedData = $request->validate([
            'registration_number' => 'required|string|max:12',
            'type' => 'required|in:1,2,3',
        ]);

        $vehicle->update([
            'registration_number' => $validatedData['registration_number'],
            'type' => $validatedData['type'],
        ]);

        return redirect()->route('admin.vehicles')->with('success', 'Vehicle updated successfully.');
    }

    public function deleteVehicle(Vehicle $vehicle)
    {
        // Implement delete vehicle functionality
        $vehicle->delete();
        session()->flash('success', 'Vehicle deleted successfully.');
        return response()->json();
    }

    // Tariff CRUD
    public function viewAllTariffs()
    {
        $tariffs = Tariff::paginate(10);
        return view('admin.tariff.tariffs', compact('tariffs'));
    }

    public function createTariffForm()
    {
        return view('admin.tariff.createTariff');
    }

    public function createTariff(Request $request)
    {
        // Validation rules go here
        $validatedData = $request->validate([
            'name' => 'required|string|max:30',
            'price' => 'required|numeric|min:0.01|max:999',
            'extra_information' => 'nullable|string',
        ]);

        // Create the new tariff
        $tariff = Tariff::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'extra_information' => $validatedData['extra_information'],
        ]);

        return redirect()->route('admin.tariffs')->with('success', 'Tariff created successfully.');
    }

    public function editTariffForm(Tariff $tariff)
    {
        // Implement edit tariff functionality
        return view('admin.tariff.editTariff', ['tariff' => $tariff]);
    }

    public function editTariff(Request $request, Tariff $tariff)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:30',
            'price' => 'required|numeric|min:0.01|max:999',
            'extra_information' => 'nullable|string',
        ]);

        $tariff->update([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'extra_information' => $validatedData['extra_information'],
        ]);

        return redirect()->route('admin.tariffs')->with('success', 'Tariff updated successfully.');
    }

    public function deleteTariff(Tariff $tariff)
    {
        // Implement delete tariff functionality
        $tariff->delete();
        session()->flash('success', 'Tariff deleted successfully.');
        return response()->json();
    }

    // Address CRUD
    public function viewAllAddresses()
    {
        $addresses = Address::paginate(10);
        return view('admin.address.addresses', compact('addresses'));
    }

    public function createAddressForm()
    {
        return view('admin.address.createAddress');
    }

    public function createAddress(Request $request)
    {
        // Validation rules go here
        $validatedData = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'county' => 'required|string|max:255',
        ]);

        // Create the new address
        $address = Address::create([
            'street' => $validatedData['street'],
            'city' => $validatedData['city'],
            'postal_code' => $validatedData['postal_code'],
            'county' => $validatedData['county'],
        ]);

        return redirect()->route('admin.addresses')->with('success', 'Address created successfully.');
    }

    public function editAddressForm(Address $address)
    {
        // Implement edit address functionality
        return view('admin.address.editAddress', ['address' => $address]);
    }

    public function editAddress(Request $request, Address $address)
    {
        $validatedData = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'county' => 'required|string|max:255',
        ]);

        $address->update([
            'street' => $validatedData['street'],
            'city' => $validatedData['city'],
            'postal_code' => $validatedData['postal_code'],
            'county' => $validatedData['county'],
        ]);

        return redirect()->route('admin.addresses')->with('success', 'Address updated successfully.');
    }

    public function deleteAddress(Address $address)
    {
        // Implement delete address functionality
        $address->delete();
        session()->flash('success', 'Address deleted successfully.');
        return response()->json();
    }
}
