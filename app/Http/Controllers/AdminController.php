<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use App\Models\ParcelTracking;
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
// Implement dividing client delivery addresses to couriers functionality

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Display all users with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function viewAllUsers()
    {
        $users = User::withTrashed()->paginate(10);
        return view('admin.user.users', compact('users'));
    }

    /**
     * Display the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function createUserForm()
    {
        return view('admin.user.createUser');
    }

    /**
     * Create a new user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(Request $request)
    {
        // Validate user input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', new Phone, 'unique:'.User::class],
            'role' => 'required|in:0,1,2',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'role' => (int)$validatedData['role'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    /**
     * Display the form for editing a user.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     */
    public function editUserForm(User $user)
    {
        return view('admin.user.editUser', ['user' => $user]);
    }

    /**
     * Update user details.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editUser(Request $request, User $user)
    {
        // Validate user input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', new Phone, Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:0,1,2',
        ]);

        // Update user details
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'role' => (int)$validatedData['role'],
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    /**
     * Update user password.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editUserPassword(Request $request, User $user)
    {
        // Validate password input
        $validatedData = $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Update user password
        $user->update([
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('admin.users')->with('success', 'User password updated successfully.');
    }

    /**
     * Delete a user.
     *
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser($userId)
    {
        $user = User::withTrashed()->findOrFail($userId);
        $user->forceDelete();
        session()->flash('success', 'User deleted successfully.');
        return response()->json();
    }

    /**
     * Display all parcels with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function viewAllParcels()
    {
        $parcels = Parcel::with(['sender' => function ($query) {
            $query->withTrashed();
        }])->paginate(10);
        return view('admin.parcel.parcels', compact('parcels'));
    }

    /**
     * Get form data for creating a parcel.
     *
     * @return array
     */
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

    /**
     * Display the form for creating a new parcel.
     *
     * @return \Illuminate\View\View
     */
    public function createParcelForm()
    {
        $formData = $this->getParcelFormData();
        return view('admin.parcel.createParcel', compact('formData'));
    }

    /**
     * Create a new parcel.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createParcel(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate parcel input
        $validatedData = $request->validate([
            'size' => 'required|in:s,m,l,xl',
            'weight' => 'required|numeric|min:1|max:100',
            'notes' => 'nullable|string|max:255',
            'status' => 'required|in:0,1,2,3,4,5',
            'sender' => 'required|exists:users,id',
            'source' => 'required|exists:addresses,id',
            'receiver' => 'required|exists:clients,id',
            'destination' => 'required|exists:addresses,id',
            'tariff' => 'required|exists:tariffs,id',
            'vehicle' => 'nullable|exists:vehicles,id',
        ]);

        // Retrieve related models
        $sender = User::findOrFail($validatedData['sender']);
        $receiver = Client::findOrFail($validatedData['receiver']);
        $source = Address::findOrFail($validatedData['source']);
        $destination = Address::findOrFail($validatedData['destination']);
        $tariff = Tariff::findOrFail($validatedData['tariff']);

        // Create parcel
        $parcel = Parcel::create([
            'size' => $validatedData['size'],
            'weight' => $validatedData['weight'],
            'notes' => $validatedData['notes'],
            'status' => $validatedData['status'],
        ]);

        // Add foreign key relationships
        $parcel->sender()->associate($sender);
        $parcel->receiver()->associate($receiver);
        $parcel->source()->associate($source);
        $parcel->destination()->associate($destination);
        $parcel->tariff()->associate($tariff);

        if (isset($validatedData['vehicle'])) {
            $vehicle = Vehicle::findOrFail($validatedData['vehicle']);
            $parcel->vehicle()->associate($vehicle);
        }

        $parcel->save();

        return redirect()->route('admin.parcels')->with('success', 'Parcel created successfully.');
    }

    /**
     * Display the form for editing a parcel.
     *
     * @param \App\Models\Parcel $parcel
     * @return \Illuminate\View\View
     */
    public function editParcelForm(Parcel $parcel)
    {
        $formData = $this->getParcelFormData();
        return view('admin.parcel.editParcel', compact('parcel', 'formData'));
    }

    /**
     * Update parcel details.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Parcel $parcel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editParcel(Request $request, Parcel $parcel)
    {
        // Validate parcel input
        $validatedData = $request->validate([
            'size' => 'required|in:s,m,l,xl',
            'weight' => 'required|numeric|min:1|max:100',
            'notes' => 'nullable|string|max:255',
            'status' => 'required|in:0,1,2,3,4,5',
            'sender' => 'required|exists:users,id',
            'source' => 'required|exists:addresses,id',
            'receiver' => 'required|exists:clients,id',
            'destination' => 'required|exists:addresses,id',
            'tariff' => 'required|exists:tariffs,id',
            'vehicle' => 'nullable|exists:vehicles,id',
        ]);

        // Retrieve related models
        $sender = User::findOrFail($validatedData['sender']);
        $receiver = Client::findOrFail($validatedData['receiver']);
        $source = Address::findOrFail($validatedData['source']);
        $destination = Address::findOrFail($validatedData['destination']);
        $tariff = Tariff::findOrFail($validatedData['tariff']);

        // Update parcel details
        $oldStatus = $parcel->status;
        $parcel->update([
            'size' => $validatedData['size'],
            'weight' => $validatedData['weight'],
            'notes' => $validatedData['notes'],
            'status' => $validatedData['status'],
        ]);

        // Add foreign key relationships
        $parcel->sender()->associate($sender);
        $parcel->receiver()->associate($receiver);
        $parcel->source()->associate($source);
        $parcel->destination()->associate($destination);
        $parcel->tariff()->associate($tariff);

        if (isset($validatedData['vehicle'])) {
            $vehicle = Vehicle::findOrFail($validatedData['vehicle']);
            $parcel->vehicle()->associate($vehicle);
        }

        $parcel->save();

        // Trigger event for parcel status update
        event(new \App\Events\ParcelStatusUpdated($parcel, $oldStatus));

        return redirect()->route('admin.parcels')->with('success', 'Parcel updated successfully.');
    }

    /**
     * Delete a parcel.
     *
     * @param \App\Models\Parcel $parcel
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteParcel(Parcel $parcel)
    {
        // Implement delete parcel functionality
        $parcel->delete();
        session()->flash('success', 'Parcel deleted successfully.');
        return response()->json();
    }

    // Vehicle CRUD

    /**
     * Display all vehicles with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function viewAllVehicles()
    {
        $vehicles = Vehicle::paginate(10);
        return view('admin.vehicle.vehicles', compact('vehicles'));
    }

    /**
     * Display the form for creating a new vehicle.
     *
     * @return \Illuminate\View\View
     */
    public function createVehicleForm()
    {
        $drivers = User::where('role', 2)->get();
        return view('admin.vehicle.createVehicle', compact('drivers'));
    }

    /**
     * Create a new vehicle.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createVehicle(Request $request)
    {
        // Validate vehicle input
        $validatedData = $request->validate([
            'registration_number' => 'required|unique:vehicles,registration_number|string|max:12',
            'type' => 'required|in:1,2,3',
            'current_driver' => 'nullable|exists:users,id'
        ]);

        // Create vehicle data array
        $vehicleData = [
            'registration_number' => $validatedData['registration_number'],
            'type' => (int)$validatedData['type'],
        ];

        // Create vehicle
        $vehicle = Vehicle::create($vehicleData);

        // Associate current driver if provided
        if (isset($validatedData['current_driver'])) {
            $driver = User::findOrFail($validatedData['current_driver']);
            $vehicle->current_driver()->associate($driver);
            $vehicle->save();
        }

        return redirect()->route('admin.vehicles')->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the form for editing a vehicle.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\View\View
     */
    public function editVehicleForm(Vehicle $vehicle)
    {
        $drivers = User::where('role', 2)->get();
        return view('admin.vehicle.editVehicle', compact('vehicle', 'drivers'));
    }

    /**
     * Update vehicle details.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editVehicle(Request $request, Vehicle $vehicle)
    {
        // Validate vehicle input
        $validatedData = $request->validate([
            'registration_number' => ['required','string', 'max:12',  Rule::unique('vehicles')->ignore($vehicle->id)],
            'type' => 'required|in:1,2,3',
            'status' => 'required|in:0,1',
            'current_driver' => 'nullable|exists:users,id'
        ]);

        // Update vehicle details
        $vehicle->update([
            'registration_number' => $validatedData['registration_number'],
            'type' => (int)$validatedData['type'],
            'status' => (int)$validatedData['status'],
        ]);

        // Associate current driver if provided
        if (isset($validatedData['current_driver'])) {
            $driver = User::findOrFail($validatedData['current_driver']);
            $vehicle->current_driver()->associate($driver);
            $vehicle->save();
        }

        return redirect()->route('admin.vehicles')->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Delete a vehicle.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteVehicle(Vehicle $vehicle)
    {
        $vehicle->delete();
        session()->flash('success', 'Vehicle deleted successfully.');
        return response()->json();
    }

    // Tariff CRUD

    /**
     * Display all tariffs with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function viewAllTariffs()
    {
        $tariffs = Tariff::paginate(10);
        return view('admin.tariff.tariffs', compact('tariffs'));
    }

    /**
     * Display the form for creating a new tariff.
     *
     * @return \Illuminate\View\View
     */
    public function createTariffForm()
    {
        return view('admin.tariff.createTariff');
    }

    /**
     * Create a new tariff.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createTariff(Request $request)
    {
        // Validate tariff input
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric|min:0|max:999',
            'extra_information' => 'nullable|string|max:255',
            'is_public' => 'nullable|boolean',
        ]);

        // Create a new tariff
        $tariff = Tariff::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'extra_information' => $validatedData['extra_information'],
            'is_public' => $validatedData['is_public'] ?? false,
        ]);

        // Redirect with success message
        return redirect()->route('admin.tariffs')->with('success', 'Tariff created successfully.');
    }

    /**
     * Display the form for editing a tariff.
     *
     * @param \App\Models\Tariff $tariff
     * @return \Illuminate\View\View
     */
    public function editTariffForm(Tariff $tariff)
    {
        return view('admin.tariff.editTariff', compact('tariff'));
    }

    /**
     * Update tariff details.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tariff $tariff
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editTariff(Request $request, Tariff $tariff)
    {
        // Validate updated tariff input
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'price' => 'required|numeric|min:0|max:999',
            'extra_information' => 'nullable|string|max:255',
            'is_public' => 'nullable|boolean',
        ]);

        // Update tariff details
        $tariff->update([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'extra_information' => $validatedData['extra_information'],
            'is_public' => $validatedData['is_public'] ?? false,
        ]);

        // Redirect with success message
        return redirect()->route('admin.tariffs')->with('success', 'Tariff updated successfully.');
    }

    /**
     * Delete a tariff.
     *
     * @param \App\Models\Tariff $tariff
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTariff(Tariff $tariff)
    {
        $tariff->delete();
        session()->flash('success', 'Tariff deleted successfully.');
        return response()->json();
    }

// Address CRUD

    /**
     * Display all addresses with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function viewAllAddresses()
    {
        $addresses = Address::paginate(10);
        return view('admin.address.addresses', compact('addresses'));
    }

    /**
     * Display the form for creating a new address.
     *
     * @return \Illuminate\View\View
     */
    public function createAddressForm()
    {
        return view('admin.address.createAddress');
    }

    /**
     * Create a new address.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAddress(Request $request)
    {
        // Validate address input
        $validatedData = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        // Create a new address
        $address = Address::create([
            'street' => $validatedData['street'],
            'city' => $validatedData['city'],
            'postal_code' => $validatedData['postal_code'],
        ]);

        // Redirect with success message
        return redirect()->route('admin.addresses')->with('success', 'Address created successfully.');
    }

    /**
     * Display the form for editing an address.
     *
     * @param \App\Models\Address $address
     * @return \Illuminate\View\View
     */
    public function editAddressForm(Address $address)
    {
        return view('admin.address.editAddress', ['address' => $address]);
    }

    /**
     * Update address details.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editAddress(Request $request, Address $address)
    {
        // Validate updated address input
        $validatedData = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        // Update address details
        $address->update([
            'street' => $validatedData['street'],
            'city' => $validatedData['city'],
            'postal_code' => $validatedData['postal_code'],
        ]);

        // Redirect with success message
        return redirect()->route('admin.addresses')->with('success', 'Address updated successfully.');
    }

    /**
     * Delete an address.
     *
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAddress(Address $address)
    {
        $address->delete();
        session()->flash('success', 'Address deleted successfully.');
        return response()->json();
    }

    // Client CRUD

    /**
     * Display all clients with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function viewAllClients()
    {
        $clients = Client::paginate(10);
        return view('admin.client.clients', compact('clients'));
    }

    /**
     * Display the form for creating a new client.
     *
     * @return \Illuminate\View\View
     */
    public function createClientForm()
    {
        return view('admin.client.createClient');
    }

    /**
     * Create a new client.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createClient(Request $request)
    {
        // Validate client input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => ['required', new Phone],
        ]);

        // Create a new client
        $client = Client::firstOrCreate([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ]);

        // Redirect with success message
        return redirect()->route('admin.clients')->with('success', 'Client created successfully.');
    }

    /**
     * Display the form for editing a client.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\View\View
     */
    public function editClientForm(Client $client)
    {
        return view('admin.client.editClient', compact('client'));
    }

    /**
     * Update client details.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editClient(Request $request, Client $client)
    {
        // Validate updated client input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email'],
            'phone' => ['required', new Phone],
        ]);

        // Update client details
        $client->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ]);

        // Redirect with success message
        return redirect()->route('admin.clients')->with('success', 'Client updated successfully.');
    }

    /**
     * Delete a client.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteClient(Client $client)
    {
        $client->delete();
        session()->flash('success', 'Client deleted successfully.');
        return response()->json();
    }

    /**
     * Display parcel tracking information with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function parcelTracking()
    {
        $parcelTrackings = ParcelTracking::paginate(10);

        return view('admin.parcel.tracking', compact('parcelTrackings'));
    }
}
