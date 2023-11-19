<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function payment()
    {
        return view('payment');
    }

    public function session()
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => [
                            'name' => 'LKPS Send Parcel',
                        ],
                        'unit_amount'  => 500,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url'  => route('parcel.payment'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        return "Yay, It works!!!";
    }
}
