<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function payment(Request $request)
    {
        $parcel = $request->session()->get('parcel', []);

        return view('payment', compact('parcel'));
    }

    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $parcel = $request->session()->get('parcel', []);

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => [
                            'name' => 'LKPS Send Parcel',
                        ],
                        'unit_amount'  => $parcel->tariff->price * 100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url'  => route('stripe.payment'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        $parcel = $request->session()->get('parcel', []);

        if ($parcel instanceof Parcel) {
            $parcel->status = '1';
            $parcel->save();

            event(new \App\Events\ParcelStatusUpdated($parcel));
        } else {
            return redirect()->route('dashboard')->with('error', 'Something went wrong.');
        }

        $request->session()->forget(['step1Data', 'step2Data', 'step3Data', 'parcel']);
        return redirect()->route('dashboard')->with('success', 'Parcel created successfully.');
    }
}
