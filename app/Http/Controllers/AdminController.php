<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use App\Models\Tariff;
use App\Rules\Phone;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Parcel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

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
//    TODO Add additional user fields to create user admin dashboard
// TODO Add fields to edit user dashboard
    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', new Phone, 'unique:'.User::class],
            'role' => 'required|in:0,1,2',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'role' => (int)$validatedData['role'],
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
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', new Phone, Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:0,1,2',
        ]);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'role' => (int)$validatedData['role'],
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function editUserPassword(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('admin.users')->with('success', 'User password updated successfully.');
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

    private function getParcelFormData()
    {
        return [
            'users' => User::all(),
            'clients' => Client::all(),
            'addresses' => Address::all(),
            'tariffs' => Tariff::all(),
            'vehicles' => Vehicle::all(),
        ];
    }

    public function createParcelForm()
    {
        $formData = $this->getParcelFormData();
        return view('admin.parcel.createParcel', compact('formData'));
    }

    public function createParcel(Request $request)
    {
        $validatedData = $request->validate([
            'size' => 'required|in:s,m,l,xl',
            'weight' => 'required|numeric|min:1|max:100',
            'notes' => 'nullable|string',
            'sender' => 'required|exists:users,id',
            'source' => 'required|exists:addresses,id',
            'receiver' => 'required|exists:clients,id',
            'destination' => 'required|exists:addresses,id',
            'tariff' => 'required|exists:tariffs,id',
            'vehicle' => 'required|exists:vehicles,id',
        ]);

        $sender = User::findOrFail($validatedData['sender']);
        $receiver = Client::findOrFail($validatedData['receiver']);
        $source = Address::findOrFail($validatedData['source']);
        $destination = Address::findOrFail($validatedData['destination']);
        $tariff = Tariff::findOrFail($validatedData['tariff']);
        $vehicle = Tariff::findOrFail($validatedData['vehicle']);

        $parcel = Parcel::create([
            'size' => $validatedData['size'],
            'weight' => $validatedData['weight'],
            'notes' => $validatedData['notes'],
        ]);

        //TODO calculate tariff automatically

        // Add foreign key relationships
        $parcel->sender()->associate($sender);
        $parcel->receiver()->associate($receiver);
        $parcel->source()->associate($source);
        $parcel->destination()->associate($destination);
        $parcel->tariff()->associate($tariff);
        $parcel->vehicle()->associate($vehicle);

        $parcel->save();

        return redirect()->route('admin.parcels')->with('success', 'Parcel created successfully.');
    }

    public function editParcelForm(Parcel $parcel)
    {
        $formData = $this->getParcelFormData();
        return view('admin.parcel.editParcel', compact('parcel' ,'formData'));
    }

    public function editParcel(Request $request, Parcel $parcel)
    {
        $validatedData = $request->validate([
            'size' => 'required|in:s,m,l,xl',
            'weight' => 'required|numeric|min:1|max:100',
            'notes' => 'nullable|string',
            'sender' => 'required|exists:users,id',
            'source' => 'required|exists:addresses,id',
            'receiver' => 'required|exists:clients,id',
            'destination' => 'required|exists:addresses,id',
            'tariff' => 'required|exists:tariffs,id',
            'vehicle' => 'required|exists:vehicles,id',
        ]);

        $sender = User::findOrFail($validatedData['sender']);
        $receiver = Client::findOrFail($validatedData['receiver']);
        $source = Address::findOrFail($validatedData['source']);
        $destination = Address::findOrFail($validatedData['destination']);
        $tariff = Tariff::findOrFail($validatedData['tariff']);
        $vehicle = Tariff::findOrFail($validatedData['vehicle']);
//        $tariff = getTariffIdBySize($validatedData['size']);
//        $parcel->tariff()->associate($tariff);

        $parcel->update([
            'size' => $validatedData['size'],
            'weight' => $validatedData['weight'],
            'notes' => $validatedData['notes'],
        ]);

        $parcel->sender()->associate($sender);
        $parcel->receiver()->associate($receiver);
        $parcel->source()->associate($source);
        $parcel->destination()->associate($destination);
        $parcel->tariff()->associate($tariff);
        $parcel->vehicle()->associate($vehicle);

        $parcel->save();

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
            'name' => 'required|string|max:255',
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
        $validatedData = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);

        // Create the new address
        $address = Address::create([
            'street' => $validatedData['street'],
            'city' => $validatedData['city'],
            'postal_code' => $validatedData['postal_code'],
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
        ]);

        $address->update([
            'street' => $validatedData['street'],
            'city' => $validatedData['city'],
            'postal_code' => $validatedData['postal_code'],
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
