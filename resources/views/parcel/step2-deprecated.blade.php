@extends('layouts.default')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Step 2 - Sender Information') }}
    </h2>
@endsection

{{--TODO REMOVE STEP 2 ENTIRELY--}}

@section('content')
    <div class="container mx-auto flex flex-col items-center">
        <form method="POST" action="{{ route('parcel.storeStep2') }}" class="mt-4">
            @csrf
            @if (auth()->user()->address)
                <div class="mb-4">
                    <h3 class="text-lg font-semibold dark:text-white">Sender Contact Information</h3>
                    <div class="flex space-x-4">
                        <div class="mb-4">
                            <label for="sender_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input readonly type="text" id="sender_name" name="sender_name" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('sender_name', $step2Data['sender_name'] ?? auth()->user()->name) }}">
                            @error('sender_name')
                                <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="sender_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input readonly type="email" id="sender_email" name="sender_email" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('sender_email', $step2Data['sender_email'] ?? auth()->user()->email) }}">
                            @error('sender_email')
                                <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="sender_phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                            <input readonly type="tel" id="sender_phone" name="sender_phone" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('sender_phone', $step2Data['sender_phone'] ?? auth()->user()->phone) }}">
                            @error('sender_phone')
                                <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold dark:text-white">Source Address Information</h3>
                    <div class="flex space-x-4">
                        <div class="mb-4">
                            <label for="sender_street" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Street</label>
                            <input readonly type="text" id="sender_street" name="sender_street" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('sender_street', $step2Data['sender_street'] ?? optional(auth()->user()->address)['street']) }}">
                            @error('sender_street')
                                <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="sender_city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                            <input readonly type="text" id="sender_city" name="sender_city" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('sender_city', $step2Data['sender_city'] ?? optional(auth()->user()->address)['city']) }}">
                            @error('sender_city')
                                <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="sender_postal_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Postal Code</label>
                            <input readonly type="text" id="sender_postal_code" name="sender_postal_code" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="{{ old('sender_postal_code', $step2Data['sender_postal_code'] ?? optional(auth()->user()->address)['postal_code']) }}">
                            @error('sender_postal_code')
                                <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-between items-start items-end">
                    <a href="{{ route('parcel.step1') }}" class="btn btn-secondary py-2.5 px-5 font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</a>
                    <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">
                        Edit Sender Information
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Next</button>
                </div>
            @else
                <div class="mt-4">
                    <p class="text-red-600 dark:text-red-400">
                        Please set your default address before proceeding.
                    </p>
                    <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">
                        Set Default Address
                    </a>
                </div>
            @endif
        </form>
    </div>
@endsection
