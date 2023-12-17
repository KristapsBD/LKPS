@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold dark:text-gray-200">Edit Vehicle</h2>
        <form action="{{ route('admin.editVehicle', $vehicle->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="registration_number" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Registration Number:</label>
                <input type="text" name="registration_number" id="registration_number" value="{{ $vehicle->registration_number }}" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" required>
            </div>
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Type:</label>
                <select id="type" name="type" class="form-select" value="{{ $vehicle->type }}">
                    <option value="1">Moped</option>
                    <option value="2">Van</option>
                    <option value="3">Truck</option>
                </select>
            </div>
            <button type="submit" class="w-full px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:ring focus:ring-indigo-200 focus:outline-none">Save</button>
        </form>
    </div>
@endsection
