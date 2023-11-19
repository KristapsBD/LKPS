<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="flex flex-col items-center mt-8">
        <!-- Display the total payable amount -->
        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
            Total: {{ $parcel->tariff->price ?? 0 }}€
        </h3>

        <!-- Payment methods section -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <!-- Stripe payment method -->
            <form action="{{ route('stripe.session') }}" method="POST">
                @csrf
                <input type="hidden" name="payment_provider" value="stripe">
                <button type="submit" class="flex flex-col items-center justify-center payment-method-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <img src="{{ asset('images/stripe.svg') }}" alt="Stripe Logo" class="h-10 w-10 mb-2">
                    <p>Checkout with Stripe</p>
                </button>
            </form>

{{--TODO implement paypal integration--}}
{{--            <!-- PayPal payment method -->--}}
{{--            <form action="{{ route('stripe.session') }}" method="POST">--}}
{{--                @csrf--}}
{{--                <input type="hidden" name="payment_provider" value="paypal">--}}
{{--                <button type="submit" class="payment-method-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">--}}
{{--                    <img src="{{ asset('images/paypal.svg') }}" alt="PayPal Logo" class="h-10 w-10 mb-2">--}}
{{--                    Checkout with PayPal--}}
{{--                </button>--}}
{{--            </form>--}}
        </div>
    </div>
</x-app-layout>
