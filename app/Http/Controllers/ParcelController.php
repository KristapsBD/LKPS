<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use App\Rules\Phone;
use Illuminate\Http\Request;
use App\Models\Parcel;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ParcelController extends Controller
{
    public function step1()
    {
        $step1Data = session('step1Data') ?? [];

        return view('parcel.step1', compact('step1Data'));
    }

    public function storeStep1(Request $request)
    {
        $validatedData = $this->validate($request, [
            'size' => 'required|in:s,m,l,xl',
            'weight' => 'required|numeric|min:0|max:100',
            'notes' => 'nullable|string|max:255',
        ]);

        $request->session()->put('step1Data', $validatedData);
        return redirect()->route('parcel.step2');
    }

    public function step2()
    {
        $step2Data = session('step2Data') ?? [];

        return view('parcel.step2', compact('step2Data'));
    }

    public function storestep2(Request $request)
    {
        $validatedData = $this->validate($request, [
            'receiver_name' => 'required|string|max:255',
            'receiver_email' => 'required|email|max:255',
            'receiver_phone' => ['required', new Phone],
            'receiver_street' => 'required|string|max:255',
            'receiver_city' => 'required|string|max:255',
            'receiver_postal_code' => 'required|string|max:10',
        ]);

        $request->session()->put('step2Data', $validatedData);

        return redirect()->route('parcel.step3');
    }

    public function step3(Request $request)
    {
        $step1Data = $request->session()->get('step1Data', []);
        $userData = [
            'sender_name' => auth()->user()->name,
            'sender_email' => auth()->user()->email,
            'sender_phone' => auth()->user()->phone,
            'sender_street' => auth()->user()->address->street ?? '',
            'sender_city' => auth()->user()->address->city ?? '',
            'sender_postal_code' => auth()->user()->address->postal_code ?? '',
        ];
        $step2Data = $request->session()->get('step2Data', []);

        return view('parcel.step3', [
            'step1Data' => $step1Data,
            'userData' => $userData,
            'step2Data' => $step2Data,
        ]);
    }

    public function storeAllData(Request $request)
    {
        $step1Data = $request->session()->get('step1Data', []);
        $userData = $request->session()->get('userData', []);
        $step2Data = $request->session()->get('step2Data', []);

        $sender = auth()->user();

        $senderAddress = auth()->user()->address;

        $receiver = Client::firstOrCreate([
            'name' => $step2Data['receiver_name'],
            'email' => $step2Data['receiver_email'],
            'phone' => $step2Data['receiver_phone'],
        ]);

        $receiverAddress = Address::firstOrCreate([
            'street' => $step2Data['receiver_street'],
            'city' => $step2Data['receiver_city'],
            'postal_code' => $step2Data['receiver_postal_code'],
        ]);

        $parcel = new Parcel([
            'size' => $step1Data['size'],
            'weight' => $step1Data['weight'],
            'notes' => $step1Data['notes'],
            'status' => 0,
        ]);

        $parcel->sender()->associate($sender);
        $parcel->source()->associate($senderAddress);
        $parcel->receiver()->associate($receiver);
        $parcel->destination()->associate($receiverAddress);
        $tariff = getTariffIdBySize($parcel->size);
        $parcel->tariff()->associate($tariff);
        // TODO consider adding default vehicle association like with tariff above
        $request->session()->put('parcel', $parcel);

        return redirect()->route('stripe.payment');
    }

    public function  cancel(Request $request)
    {
        $request->session()->forget(['step1Data', 'step2Data']);

        return redirect()->route('dashboard');
    }

    public function parcelHistory()
    {
        $user = Auth::user();
        $parcels = $user->parcels()->paginate(10);

        return view('parcel.history', compact('parcels'));
    }

    public function paymentHistory()
    {
        $user = Auth::user();

        // Load parcels with their associated payments and receivers
        $parcels = $user->parcels()->with('payment')->paginate(10);

        return view('payment.history', compact('parcels'));
    }

    public function trackingView()
    {
        return view('parcel.track');
    }

    public function track(Request $request)
    {
        $request->validate([
            'tracking_code' => 'required|string|min:10|max:10',
        ]);

        $parcel = Parcel::where('tracking_code', $request->input('tracking_code'))->first();

        if (!$parcel) {
            return response()->json(['error' => 'Tracking code not found'], 404);
        }

        $trackingInfo = [
            'status' => mapParcelStatusToValue($parcel->status),
        ];

        return response()->json($trackingInfo, 200);
    }
}
