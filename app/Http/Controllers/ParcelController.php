<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcel;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

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
            'notes' => 'nullable|string',
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
            'sender_name' => 'required|string',
            'sender_email' => 'required|email',
            'sender_phone' => 'required|string',
//            'sender_address' => 'required|string',
            'sender_street' => 'required|string',
            'sender_city' => 'required|string',
            'sender_postal_code' => 'required|string',
            'sender_county' => 'required|string',
            'dropoff_date' => 'required|date',
            'dropoff_time_from' => 'required|date_format:H:i',
            'dropoff_time_to' => 'required|date_format:H:i',
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
            'receiver_name' => 'required|string',
            'receiver_email' => 'required|email',
            'receiver_phone' => 'required|string',
//            'receiver_address' => 'required|string',
            'receiver_street' => 'required|string',
            'receiver_city' => 'required|string',
            'receiver_postal_code' => 'required|string',
            'receiver_county' => 'required|string',
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
        // TODO: Implement function for user to change sender info OR remove unused code
        $step1Data = $request->session()->get('step1Data', []);
        $step2Data = $request->session()->get('step2Data', []);
        $step3Data = $request->session()->get('step3Data', []);

        $sender = Auth::user();

        $receiver = Client::create([
            'name' => $step3Data['receiver_name'],
            'email' => $step3Data['receiver_email'],
            'phone' => $step3Data['receiver_phone'],
        ]);

        $parcel = new Parcel([
            'size' => $step1Data['size'],
            'weight' => $step1Data['weight'],
            'notes' => $step1Data['notes'],
            'status' => 0,
        ]);

        $parcel->sender()->associate($sender);
        $parcel->receiver()->associate($receiver);
        $tariff = getTariffIdBySize($parcel->size);
        $parcel->tariff()->associate($tariff);

        $parcel->save();

        $request->session()->put('parcel', $parcel);

        return redirect()->route('stripe.payment');
//        return redirect()->route('stripe.payment', ['parcelId' => $parcel->id]);
        return view('payment', compact('parcel'));
    }

    public function  cancel(Request $request)
    {
        $request->session()->forget(['step1Data', 'step2Data', 'step3Data']);

        return redirect()->route('dashboard');
    }

    public function parcelHistory()
    {
        // Retrieve the authenticated user's parcel history
        $user = Auth::user();
        $parcels = $user->parcels;

        return view('parcel.history', compact('parcels'));
    }
}
