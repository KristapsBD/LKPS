<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourierController extends Controller
{
    /**
     * Display the courier dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $parcelCount = $user->deliverableParcels()->count();
        return view('courier.dashboard', compact('parcelCount'));
    }

    // Parcel Methods

    /**
     * Display all parcels assigned to the current courier with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function viewAllParcels()
    {
        $user = Auth::user();
        $parcels = $user->deliverableParcels()->orderBy('id', 'asc')->paginate(10);
        return view('courier.parcel.parcels', compact('parcels'));
    }

    /**
     * Display the form for editing a specific parcel.
     *
     * @param \App\Models\Parcel $parcel
     * @return \Illuminate\View\View
     */
    public function editParcelForm(Parcel $parcel)
    {
        return view('courier.parcel.editParcel', compact('parcel'));
    }

    /**
     * Update the status of a specific parcel.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Parcel $parcel
     * @return \Illuminate\Http\RedirectResponse
     */
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
