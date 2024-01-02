@extends('layouts.default')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Step 4 - Payment') }}
    </h2>
@endsection

@section('content')
    <div class="flex flex-col items-center justify-center mt-8">
        <!-- Display the total payable amount -->
        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
            Total: {{ calculateTotal($parcel) }}€
        </h3>

        <!-- Payment methods section -->

        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Select payment method</h3>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <!-- Stripe payment method -->
            <form action="{{ route('stripe.session') }}" method="POST">
                @csrf
                <input type="hidden" name="payment_provider" value="stripe">
                <button type="submit" class="w-full flex flex-col items-center justify-center payment-method-button py-2 px-4 mb-2 font-medium text-white focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-blue-100 hover:text-black-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-blue-500 dark:text-white dark:border-gray-600 dark:hover:text-white dark:hover:bg-blue-700">
                    <img src="{{ asset('images/stripe.svg') }}" alt="Stripe Logo" class="h-10 w-10 mb-2">
                    <p>Checkout With Stripe</p>
                </button>
            </form>

            {{--TODO implement paypal & bank transfer integration--}}
            <!-- PayPal payment method -->
            <form action="{{ route('stripe.session') }}" method="POST">
                @csrf
                <input type="hidden" name="payment_provider" value="paypal">
                <button disabled type="submit" class="w-full flex flex-col items-center justify-center payment-method-button py-2 px-4 mb-2 font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <img src="{{ asset('images/paypal.svg') }}" alt="PayPal Logo" class="h-10 w-10 mb-2">
                    Checkout With PayPal
                </button>
            </form>

            <form action="{{ route('stripe.session') }}" method="POST">
                @csrf
                <input type="hidden" name="payment_provider" value="card">
                <button disabled type="submit" class="w-full flex flex-col items-center justify-center payment-method-button py-2 px-4 mb-2 font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <div class="flex">
                        <img src="{{ asset('images/visa.svg') }}" alt="Visa Logo" class="h-10 w-10 mb-2 mr-1">
                        <img src="{{ asset('images/mastercard.svg') }}" alt="Matercard Logo" class="h-10 w-10 mb-2">
                    </div>
                    Checkout With Card
                </button>
            </form>

            <!-- Crypto payment method -->
            <form action="{{ route('stripe.session') }}" method="POST">
                @csrf
                <input type="hidden" name="payment_provider" value="crypto">
                <button disabled type="submit" class="w-full flex flex-col items-center justify-center payment-method-button py-2 px-4 mb-2 font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <img src="{{ asset('images/btc.svg') }}" alt="Bitcoin Logo" class="h-10 w-10 mb-2">
                    Checkout With Crypto
                </button>
            </form>
        </div>
        <a href="{{ route('parcel.step3') }}" class="btn btn-secondary py-2.5 px-5 mb-2 mt-4 font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back To Overview</a>
    </div>
@endsection
