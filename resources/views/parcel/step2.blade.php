@extends('layouts.default')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Step 2 - Sender Information') }}
    </h2>
@endsection

@section('content')
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
        <form method="POST" action="{{ route('parcel.storeStep2') }}" class="mt-4">
            @csrf

            <!-- Sender Information -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold dark:text-white">Sender Information</h3>
                <div class="mb-4">
                    <label for="sender_name" class="block dark:text-white">Name</label>
                    <input type="text" id="sender_name" name="sender_name" class="form-input dark:text-black" required value="{{ old('sender_name', $step2Data['sender_name'] ?? auth()->user()->name) }}">
                </div>

                <div class="mb-4">
                    <label for="sender_email" class="block dark:text-white">Email</label>
                    <input type="email" id="sender_email" name="sender_email" class="form-input dark:text-black" required value="{{ old('sender_email', $step2Data['sender_email'] ?? auth()->user()->email) }}">
                </div>

                <div class="mb-4">
                    <label for="sender_phone" class="block dark:text-white">Phone</label>
                    <input type="tel" id="sender_phone" name="sender_phone" class="form-input dark:text-black" required value="{{ old('sender_phone', $step2Data['sender_phone'] ?? auth()->user()->phone) }}">
                </div>

{{--                <div class="mb-4">--}}
{{--                    <label for="sender_address" class="block dark:text-white">Address</label>--}}
{{--                    <textarea id="sender_address" name="sender_address" class="form-textarea dark:text-black" required placeholder="Enter address">{{ old('sender_address', $step2Data['sender_address'] ?? auth()->user()->address['street']) }}</textarea>--}}
{{--                </div>--}}

                <div class="mb-4">
                    <label for="sender_street" class="block dark:text-white">Street</label>
                    <input type="text" id="sender_street" name="sender_street" class="form-input dark:text-black" required value="{{ old('sender_street', $step2Data['sender_street'] ?? auth()->user()->address['street']) }}">
                </div>

                <div class="mb-4">
                    <label for="sender_city" class="block dark:text-white">City</label>
                    <input type="text" id="sender_city" name="sender_city" class="form-input dark:text-black" required value="{{ old('sender_city', $step2Data['sender_city'] ?? auth()->user()->address['city']) }}">
                </div>

                <div class="mb-4">
                    <label for="sender_postal_code" class="block dark:text-white">Postal Code</label>
                    <input type="text" id="sender_postal_code" name="sender_postal_code" class="form-input dark:text-black" required value="{{ old('sender_postal_code', $step2Data['sender_postal_code'] ?? auth()->user()->address['postal_code']) }}">
                </div>

            </div>

{{--            TODO: Implement dropoff functionality--}}
            <!-- Parcel Dropoff Information -->
{{--            <div class="mt-4">--}}
{{--                <h3 class="text-lg font-semibold dark:text-white">Parcel Dropoff Information</h3>--}}
{{--                <div class="mb-4">--}}
{{--                    <label for="dropoff_date" class="block dark:text-white">Dropoff Date</label>--}}
{{--                    <input type="date" id="dropoff_date" name="dropoff_date" class="form-input dark:text-black" required value="{{ old('dropoff_date', $step2Data['dropoff_date'] ?? '') }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="dropoff_time_from" class="block dark:text-white">Dropoff Time From</label>--}}
{{--                    <input type="time" id="dropoff_time_from" name="dropoff_time_from" class="form-input dark:text-black" required value="{{ old('dropoff_time_from', $step2Data['dropoff_time_from'] ?? '') }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="dropoff_time_to" class="block dark:text-white">Dropoff Time To</label>--}}
{{--                    <input type="time" id="dropoff_time_to" name="dropoff_time_to" class="form-input dark:text-black" required value="{{ old('dropoff_time_to', $step2Data['dropoff_time_to'] ?? '') }}">--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="mt-4">
                <a href="{{ route('parcel.step1') }}" class="btn btn-secondary py-2.5 px-5 me-2 mb-2 font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Next</button>
            </div>
        </form>
    </div>
@endsection
