@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold dark:text-gray-200">Edit Parcel</h2>
        <form action="{{ route('admin.editParcel', $parcel->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="size" class="block text-gray-700 dark:text-gray-300">Parcel Size</label>
                <select id="size" name="size" class="form-select" value="{{ $parcel->size }}">
                    <option value="s">Small</option>
                    <option value="m">Medium</option>
                    <option value="l">Large</option>
                    <option value="xl">Extra Large</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="weight" class="block text-gray-700 dark:text-gray-300">Parcel Weight (kg)</label>
                <input type="number" id="weight" name="weight" class="form-input" min="0" max="100" required value="{{ $parcel->weight }}">
            </div>

            <div class="mb-4">
                <label for="notes" class="block text-gray-700 dark:text-gray-300">Additional Notes</label>
                <textarea id="notes" name="notes" class="form-textarea" placeholder="Enter additional notes...">{{ $parcel->notes }}</textarea>
            </div>

            <div class="mb-4">
                <label for="sender_id" class="block text-gray-700 dark:text-gray-300">Sender ID</label>
                <input type="number" id="sender_id" name="sender_id" class="form-input" min="0" max="100" required value="{{ $parcel->sender_id }}">
            </div>

            <!-- Parcel Dropoff Information -->
{{--            <div class="mt-4">--}}
{{--                <h3 class="text-lg font-semibold dark:text-white">Parcel Dropoff Information</h3>--}}
{{--                <div class="mb-4">--}}
{{--                    <label for="dropoff_date" class="block dark:text-white">Dropoff Date</label>--}}
{{--                    <input type="date" id="dropoff_date" name="dropoff_date" class="form-input dark:text-black" required value="{{ $parcel->dropoff_date }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="dropoff_time_from" class="block dark:text-white">Dropoff Time From</label>--}}
{{--                    <input type="time" id="dropoff_time_from" name="dropoff_time_from" class="form-input dark:text-black" required value="{{ $parcel->dropoff_time_from }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="dropoff_time_to" class="block dark:text-white">Dropoff Time To</label>--}}
{{--                    <input type="time" id="dropoff_time_to" name="dropoff_time_to" class="form-input dark:text-black" required value="{{ $parcel->dropoff_time_to }}">--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            TODO: Fill out correct placeholders for receiver info--}}
            <div class="mb-4">
                <label for="receiver_id" class="block text-gray-700 dark:text-gray-300">Receiver ID</label>
                <input type="number" id="receiver_id" name="receiver_id" class="form-input" min="0" max="100" required value="{{ $parcel->receiver_id }}">
            </div>
{{--            <!-- Receiver Information -->--}}
{{--            <div class="mt-4">--}}
{{--                <h3 class="text-lg font-semibold dark:text-white">Receiver Information</h3>--}}
{{--                <div class="mb-4">--}}
{{--                    <label for="receiver_name" class="block dark:text-white">Name</label>--}}
{{--                    <input type="text" id="receiver_name" name="receiver_name" class="form-input dark:text-black" required value="{{ '' }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="receiver_email" class="block dark:text-white">Email</label>--}}
{{--                    <input type="email" id="receiver_email" name="receiver_email" class="form-input dark:text-black" required value="{{ '' }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="receiver_phone" class="block dark:text-white">Phone</label>--}}
{{--                    <input type="tel" id="receiver_phone" name="receiver_phone" class="form-input dark:text-black" required value="{{ '' }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="receiver_address" class="block dark:text-white">Address</label>--}}
{{--                    <textarea id="receiver_address" name="receiver_address" class="form-textarea dark:text-black" required placeholder="Enter address">{{ '' }}</textarea>--}}
{{--                </div>--}}
{{--            </div>--}}

            <button type="submit" class="w-full px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:ring focus:ring-indigo-200 focus:outline-none">Save</button>
        </form>
    </div>
@endsection
