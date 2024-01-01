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

    public function storeStep2(Request $request)
    {
        $validatedData = $this->validate($request, [
            'sender_name' => 'required|string|max:255',
            'sender_email' => ['required', Rule::unique('users', 'email')->ignore(Auth::user()->id)],
            'sender_phone' => ['required', new Phone, Rule::unique('users', 'phone')->ignore(Auth::user()->id)],
            'sender_street' => 'required|string|max:255',
            'sender_city' => 'required|string|max:255',
            'sender_postal_code' => 'required|string|max:10',
        ]);

        $request->session()->put('step2Data', $validatedData);

        return redirect()->route('parcel.step3');
    }

    public function step3()
    {
        $step3Data = session('step3Data') ?? [];

        return view('parcel.step3', compact('step3Data'));
    }

    public function storeStep3(Request $request)
    {
        $validatedData = $this->validate($request, [
            'receiver_name' => 'required|string|max:255',
            'receiver_email' => 'required|email|max:255',
            'receiver_phone' => ['required', new Phone],
            'receiver_street' => 'required|string|max:255',
            'receiver_city' => 'required|string|max:255',
            'receiver_postal_code' => 'required|string|max:10',
        ]);

        $request->session()->put('step3Data', $validatedData);

        return redirect()->route('parcel.step4');
    }

    public function step4(Request $request)
    {
        $step1Data = $request->session()->get('step1Data', []);
        $step2Data = $request->session()->get('step2Data', []);
        $step3Data = $request->session()->get('step3Data', []);

        return view('parcel.step4', [
            'step1Data' => $step1Data,
            'step2Data' => $step2Data,
            'step3Data' => $step3Data,
        ]);
    }

    public function storeAllData(Request $request)
    {
        $step1Data = $request->session()->get('step1Data', []);
        $step2Data = $request->session()->get('step2Data', []);
        $step3Data = $request->session()->get('step3Data', []);

        $sender = User::firstOrCreate([
            'name' => $step2Data['sender_name'],
            'email' => $step2Data['sender_email'],
            'phone' => $step2Data['sender_phone'],
        ]);

        $senderAddress = Address::firstOrCreate([
            'street' => $step2Data['sender_street'],
            'city' => $step2Data['sender_city'],
            'postal_code' => $step2Data['sender_postal_code'],
        ]);

        $receiver = Client::firstOrCreate([
            'name' => $step3Data['receiver_name'],
            'email' => $step3Data['receiver_email'],
            'phone' => $step3Data['receiver_phone'],
        ]);

        $receiverAddress = Address::firstOrCreate([
            'street' => $step3Data['receiver_street'],
            'city' => $step3Data['receiver_city'],
            'postal_code' => $step3Data['receiver_postal_code'],
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
        $request->session()->forget(['step1Data', 'step2Data', 'step3Data']);

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
