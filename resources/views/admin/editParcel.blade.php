@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl mb-4">{{ __('Edit Parcel') }}</h2>

        <form method="POST" action="{{ route('admin.parcels.update', $parcel) }}" class="bg-white dark:bg-gray-800 p-4 rounded shadow-md">
            @csrf
            @method('PUT')

            <!-- Display the parcel details and allow for editing -->
            <div class="mb-4">
                <label for="parcel_size" class="block text-sm font-medium text-gray-700 dark:text-white">{{ __('Parcel Size') }}</label>
                <input type="text" name="parcel_size" id="parcel_size" value="{{ old('parcel_size', $parcel->size) }}" class="form-input">
            </div>

            <!-- Add more fields for Parcel Weight, Additional Notes, Sender, Receiver, etc. -->

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Update Parcel') }}</button>
        </form>
    </div>
@endsection
