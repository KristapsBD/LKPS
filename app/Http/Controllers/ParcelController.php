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
        $step1Data = session('step1Data');

        return view('parcel.step1', compact('step1Data'));
    }

    public function storeStep1(Request $request)
    {
        $this->validate($request, [
            'parcel_size' => 'required|in:s,m,l,xl',
            'parcel_weight' => 'required|numeric|min:0|max:100',
            'additional_notes' => 'nullable|string',
        ]);

        $request->session()->put('step1Data', $request->all());

        return redirect()->route('parcel.step2');
    }

    public function step2()
    {
        $step2Data = session('step2Data');

        return view('parcel.step2', compact('step2Data'));
    }

    public function storeStep2(Request $request)
    {
        $this->validate($request, [
            'sender_name' => 'required|string',
            'sender_email' => 'required|email',
            'sender_phone' => 'required|string',
            'sender_address' => 'required|string',
            'dropoff_date' => 'required|date',
            'dropoff_time_from' => 'required|date_format:H:i',
            'dropoff_time_to' => 'required|date_format:H:i',
        ]);

        $request->session()->put('step2Data', $request->all());

        return redirect()->route('parcel.step3');
    }

    public function step3()
    {
        $step3Data = session('step3Data');

        return view('parcel.step3', compact('step3Data'));
    }

    public function storeStep3(Request $request)
    {
        $this->validate($request, [
            'receiver_name' => 'required|string',
            'receiver_email' => 'required|email',
            'receiver_phone' => 'required|string',
            'receiver_address' => 'required|string',
        ]);

        $request->session()->put('step3Data', $request->all());

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
        $step1Data = $request->session()->get('step1Data');
        $step2Data = $request->session()->get('step2Data');
        $step3Data = $request->session()->get('step3Data');
        $alreadyRegistered = false;

        if (Auth::check()) {
            $user = Auth::user();

            if ($step2Data['sender_email'] === $user->email) {
                $sender = $user;
                $alreadyRegistered = true;
            } else {
                $sender = Client::create([
                    'name' => $step2Data['sender_name'],
                    'email' => $step2Data['sender_email'],
                    'phone' => $step2Data['sender_phone'],
                ]);
            }
        } else {
            $sender = Client::create([
                'name' => $step2Data['sender_name'],
                'email' => $step2Data['sender_email'],
                'phone' => $step2Data['sender_phone'],
            ]);
        }

        $receiver = Client::create([
            'name' => $step3Data['receiver_name'],
            'email' => $step3Data['receiver_email'],
            'phone' => $step3Data['receiver_phone'],
        ]);

        $parcel = new Parcel([
            'parcel_size' => $step1Data['parcel_size'],
            'parcel_weight' => $step1Data['parcel_weight'],
            'additional_notes' => $step1Data['additional_notes'],
        ]);

        if($alreadyRegistered){
            $parcel->user()->associate($sender);
        } else {
            $parcel->client()->associate($sender);
        }

        $parcel->save();

        $request->session()->forget(['step1Data', 'step2Data', 'step3Data']);

        return redirect()->route('home')->with('success', 'Parcel created successfully.');
    }

    public function success()
    {
        return view('parcel.success');
    }

    public function parcelHistory()
    {
        // Retrieve the authenticated user's parcel history
        $user = Auth::user();
        $parcels = $user->parcels;

        return view('parcel.history', compact('parcels'));
    }
}
