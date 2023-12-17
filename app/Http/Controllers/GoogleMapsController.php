<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use App\Services\GoogleMapsService;

class GoogleMapsController extends Controller
{

    protected $googleMapsService;

    public function __construct(GoogleMapsService $googleMapsService)
    {
        $this->googleMapsService = $googleMapsService;
    }

    public function index ()
    {
        return view('googlemaps.maps');
    }

    public function generateOptimizedRoute(Request $request)
    {
        $selectedParcelIds = json_decode($request->input('selected_parcels'));
        $waypoints = Parcel::whereIn('parcels.id', $selectedParcelIds)
            ->join('addresses', 'parcels.destination_id', '=', 'addresses.id')
            ->select('addresses.street', 'addresses.city', 'addresses.postal_code')
            ->get()
            ->map(function ($item) {
                return $item->street . '+' . $item->city . '+' . $item->postal_code;
            })
            ->toArray();

        // Set your origin and destination addresses
        $origin = '56.99650445542381, 24.268376560174552';
        $destination = '56.99660445542381, 24.268476560174552';

        // Call the Google Maps service to get the optimized route
        $optimizedRoute = $this->googleMapsService->getOptimizedRoute($origin, $destination, $waypoints);

        // Return the optimized route to the view or handle as needed
        return view('googlemaps.maps', compact('optimizedRoute'));
    }
}
