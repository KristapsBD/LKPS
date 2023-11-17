@extends('layouts.admin')

@section('content')
    <div class="max-w-md mx-auto mt-4 bg-white dark:bg-gray-700 p-4 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4 dark:text-gray-200">Create New Vehicle</h2>
        <form action="{{ route('admin.createVehicle') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="registration_number" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Registration Number:</label>
                <input type="text" name="registration_number" id="registration_number" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" required>
            </div>
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Type:</label>
                <select id="type" name="type" class="form-select">
                    <option value="1">Moped</option>
                    <option value="2">Van</option>
                    <option value="3">Truck</option>
                </select>
            </div>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md">Create Vehicle</button>
        </form>
    </div>
@endsection
