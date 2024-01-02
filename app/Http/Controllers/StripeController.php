<?php

namespace App\Http\Controllers;

use App\Events\ParcelCreationEvent;
use App\Events\ParcelStatusUpdated;
use App\Models\Parcel;
use App\Models\Payment;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function payment(Request $request)
    {
        $parcel = $request->session()->get('parcel', []);

        return view('payment.payment', compact('parcel'));
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
                        'unit_amount'  => calculateTotal($parcel) * 100,
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

        $oldStatus = $parcel->status;

        if ($parcel instanceof Parcel) {
            $parcel->status = '1';
            $parcel->save();

            event(new ParcelCreationEvent($parcel));
//            event(new ParcelStatusUpdated($parcel, $oldStatus));

            $payment = new Payment([
                'sum' => calculateTotal($parcel),
                'status' => 1,
            ]);

            $payment->parcel()->associate($parcel);
            $payment->save();
        } else {
            return redirect()->route('dashboard')->with('error', 'Something went wrong. Please try again.');
        }

        $request->session()->forget(['step1Data', 'step2Data', 'parcel']);
        return redirect()->route('dashboard')->with('success', 'Parcel created successfully.');
    }
}
