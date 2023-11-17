@extends('layouts.admin')

@section('content')
    <div class="container mx-auto flex flex-col items-center">
        <h2 class="text-2xl font-semibold dark:text-gray-200">Parcel Information</h2>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('admin.createParcel') }}">
            @csrf

            <div class="mb-4">
                <label for="size" class="block text-gray-700 dark:text-gray-300">Parcel Size</label>
                <select id="size" name="size" class="form-select" value="{{ old('size', $step1Data['size'] ?? '') }}">
                    <option value="s">Small</option>
                    <option value="m">Medium</option>
                    <option value="l">Large</option>
                    <option value="xl">Extra Large</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="weight" class="block text-gray-700 dark:text-gray-300">Parcel Weight (kg)</label>
                <input type="number" id="weight" name="weight" class="form-input" min="0" max="100" required value="{{ old('weight', $step1Data['weight'] ?? '') }}">
            </div>

            <div class="mb-4">
                <label for="notes" class="block text-gray-700 dark:text-gray-300">Additional Notes</label>
                <textarea id="notes" name="notes" class="form-textarea" placeholder="Enter additional notes...">{{ old('notes', $step1Data['notes'] ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="sender_id" class="block text-gray-700 dark:text-gray-300">Sender ID</label>
                <input type="number" id="sender_id" name="sender_id" class="form-input" min="0" max="100" required value="{{ old('sender_id', $step1Data['sender_id'] ?? '') }}">
            </div>

{{--            <!-- Sender Information -->--}}
{{--            <div class="mt-4">--}}
{{--                <h3 class="text-lg font-semibold dark:text-white">Sender Information</h3>--}}
{{--                <div class="mb-4">--}}
{{--                    <label for="sender_name" class="block dark:text-white">Name</label>--}}
{{--                    <input type="text" id="sender_name" name="sender_name" class="form-input dark:text-black" required value="{{ old('sender_name', $step2Data['sender_name'] ?? auth()->user()->name) }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="sender_email" class="block dark:text-white">Email</label>--}}
{{--                    <input type="email" id="sender_email" name="sender_email" class="form-input dark:text-black" required value="{{ old('sender_email', $step2Data['sender_email'] ?? auth()->user()->email) }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="sender_phone" class="block dark:text-white">Phone</label>--}}
{{--                    <input type="tel" id="sender_phone" name="sender_phone" class="form-input dark:text-black" required value="{{ old('sender_phone', $step2Data['sender_phone'] ?? auth()->user()->phone) }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="sender_address" class="block dark:text-white">Address</label>--}}
{{--                    <textarea id="sender_address" name="sender_address" class="form-textarea dark:text-black" required placeholder="Enter address">{{ old('sender_address', $step2Data['sender_address'] ?? auth()->user()->address) }}</textarea>--}}
{{--                </div>--}}
{{--            </div>--}}

            <!-- Parcel Dropoff Information -->
            <div class="mt-4">
                <h3 class="text-lg font-semibold dark:text-white">Parcel Dropoff Information</h3>
                <div class="mb-4">
                    <label for="dropoff_date" class="block dark:text-white">Dropoff Date</label>
                    <input type="date" id="dropoff_date" name="dropoff_date" class="form-input dark:text-black" required value="{{ old('dropoff_date', $step2Data['dropoff_date'] ?? '') }}">
                </div>

                <div class="mb-4">
                    <label for="dropoff_time_from" class="block dark:text-white">Dropoff Time From</label>
                    <input type="time" id="dropoff_time_from" name="dropoff_time_from" class="form-input dark:text-black" required value="{{ old('dropoff_time_from', $step2Data['dropoff_time_from'] ?? '') }}">
                </div>

                <div class="mb-4">
                    <label for="dropoff_time_to" class="block dark:text-white">Dropoff Time To</label>
                    <input type="time" id="dropoff_time_to" name="dropoff_time_to" class="form-input dark:text-black" required value="{{ old('dropoff_time_to', $step2Data['dropoff_time_to'] ?? '') }}">
                </div>
            </div>

            <!-- Receiver Information -->
            <div class="mt-4">
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

                <div class="mb-4">
                    <label for="receiver_address" class="block dark:text-white">Address</label>
                    <textarea id="receiver_address" name="receiver_address" class="form-textarea dark:text-black" required placeholder="Enter address">{{ old('receiver_address', $step3Data['receiver_address'] ?? '') }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Next</button>
            </div>
        </form>
    </div>
@endsection
