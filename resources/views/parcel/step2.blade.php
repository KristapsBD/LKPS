@extends('layouts.default')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Step 2 - Receiver Information') }}
    </h2>
@endsection

@section('content')
    <div class="container mx-auto flex flex-col items-center">
        <form method="POST" action="{{ route('parcel.storeStep2') }}" class="mt-4">
            @csrf
            <!-- Receiver Information -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold dark:text-white">Receiver Contact Information</h3>
                <div class="flex space-x-4">
                    <div class="mb-4">
                        <label for="receiver_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" id="receiver_name" name="receiver_name" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('receiver_name', $step2Data['receiver_name'] ?? '') }}">
                        @error('receiver_name')
                            <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="receiver_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="receiver_email" name="receiver_email" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('receiver_email', $step2Data['receiver_email'] ?? '') }}">
                        @error('receiver_email')
                        <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="receiver_phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                        <input type="tel" id="receiver_phone" name="receiver_phone" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('receiver_phone', $step2Data['receiver_phone'] ?? '') }}">
                        @error('receiver_phone')
                            <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h3 class="text-lg font-semibold dark:text-white">Destination Address Information</h3>
                <div class="flex space-x-4">
                    <div class="mb-4">
                        <label for="receiver_street" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Street</label>
                        <input type="text" id="receiver_street" name="receiver_street" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('receiver_street', $step2Data['receiver_street'] ?? '') }}">
                        @error('receiver_street')
                            <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="receiver_city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                        <input type="text" id="receiver_city" name="receiver_city" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('receiver_city', $step2Data['receiver_city'] ?? '') }}">
                        @error('receiver_city')
                            <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="receiver_postal_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Postal Code</label>
                        <input type="text" id="receiver_postal_code" name="receiver_postal_code" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('receiver_postal_code', $step2Data['receiver_postal_code'] ?? '') }}">
                        @error('receiver_postal_code')
                            <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
{{--                <div class="mb-4">--}}
{{--                    <label for="receiver_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>--}}
{{--                    <textarea id="receiver_address" name="receiver_address" class="form-textarea bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required placeholder="Enter address">{{ old('receiver_address', $step2Data['receiver_address'] ?? '') }}</textarea>--}}
{{--                </div>--}}
            </div>

            <div class="mt-4 flex justify-between items-start">
                <a href="{{ route('parcel.step1') }}" class="btn btn-secondary py-2.5 px-5 me-2 mb-2 font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Next</button>
            </div>
        </form>
    </div>
@endsection
