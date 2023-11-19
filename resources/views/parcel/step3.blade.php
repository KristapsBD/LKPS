<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Step 3 - Receiver Information') }}
        </h2>
    </x-slot>

    <div class="container mx-auto flex flex-col items-center">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('parcel.storeStep3') }}" class="mt-4">
            @csrf

            <!-- Receiver Information -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold dark:text-white">Receiver Information</h3>
                <div class="mb-4">
                    <label for="receiver_name" class="block dark:text-white">Name</label>
                    <input type="text" id="receiver_name" name="receiver_name" class="form-input dark:text-black" required value="{{ old('receiver_name', $step3Data['receiver_name'] ?? '') }}">
                </div>

                <div class="mb-4">
                    <label for="receiver_email" class="block dark:text-white">Email</label>
                    <input type="email" id="receiver_email" name="receiver_email" class="form-input dark:text-black" required value="{{ old('receiver_email', $step3Data['receiver_email'] ?? '') }}">
                </div>

                <div class="mb-4">
                    <label for="receiver_phone" class="block dark:text-white">Phone</label>
                    <input type="tel" id="receiver_phone" name="receiver_phone" class="form-input dark:text-black" required value="{{ old('receiver_phone', $step3Data['receiver_phone'] ?? '') }}">
                </div>

{{--                <div class="mb-4">--}}
{{--                    <label for="receiver_address" class="block dark:text-white">Address</label>--}}
{{--                    <textarea id="receiver_address" name="receiver_address" class="form-textarea dark:text-black" required placeholder="Enter address">{{ old('receiver_address', $step3Data['receiver_address'] ?? '') }}</textarea>--}}
{{--                </div>--}}
            </div>

            <div class="mb-4">
                <label for="receiver_street" class="block dark:text-white">Street</label>
                <input type="text" id="receiver_street" name="receiver_street" class="form-input dark:text-black" required value="{{ old('receiver_street', $step2Data['receiver_street'] ?? auth()->user()->address['street']) }}">
            </div>

            <div class="mb-4">
                <label for="receiver_city" class="block dark:text-white">City</label>
                <input type="text" id="receiver_city" name="receiver_city" class="form-input dark:text-black" required value="{{ old('receiver_city', $step2Data['receiver_city'] ?? auth()->user()->address['city']) }}">
            </div>

            <div class="mb-4">
                <label for="receiver_postal_code" class="block dark:text-white">Postal Code</label>
                <input type="text" id="receiver_postal_code" name="receiver_postal_code" class="form-input dark:text-black" required value="{{ old('receiver_postal_code', $step2Data['receiver_postal_code'] ?? auth()->user()->address['postal_code']) }}">
            </div>

            <div class="mb-4">
                <label for="receiver_county" class="block dark:text-white">County</label>
                <input type="text" id="receiver_county" name="receiver_county" class="form-input dark:text-black" required value="{{ old('receiver_county', $step2Data['receiver_county'] ?? auth()->user()->address['county']) }}">
            </div>

            <div class="mt-4">
                <a href="{{ route('parcel.step2') }}" class="btn btn-secondary py-2.5 px-5 me-2 mb-2 font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Next</button>
            </div>
        </form>
    </div>
</x-app-layout>
