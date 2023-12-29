<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use App\Models\Parcel;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourierController extends Controller
{
    public function index()
    {
        return view('courier.dashboard');
    }

    // Parcel Methods
    public function viewAllParcels()
    {
        $user = Auth::user();
        $parcels = $user->deliverableParcels()->orderBy('id', 'asc')->paginate(10);
        return view('courier.parcel.parcels', compact('parcels'));
    }

    public function editParcelForm(Parcel $parcel)
    {
        return view('courier.parcel.editParcel', compact('parcel' ));
    }

    public function editParcel(Request $request, Parcel $parcel)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:2,3,4,5',
        ]);

        $oldStatus = $parcel->status;
        $parcel->update([
            'status' => $validatedData['status']
        ]);
        $parcel->save();

        event(new \App\Events\ParcelStatusUpdated($parcel, $oldStatus));

        return redirect()->route('courier.parcels')->with('success', 'Parcel status updated successfully.');
    }
}
