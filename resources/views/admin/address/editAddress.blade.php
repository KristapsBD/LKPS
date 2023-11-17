@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold dark:text-gray-200">Edit Address</h2>
        <form action="{{ route('admin.editAddress', $address->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="street" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Street:</label>
                <input type="text" name="street" id="street" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" value="{{ $address->street }}" required>
            </div>
            <div class="mb-4">
                <label for="city" class="block text-sm font-medium text-gray-600 dark:text-gray-300">City:</label>
                <input type="text" name="city" id="city" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" value="{{ $address->city }}" required>
            </div>
            <div class="mb-4">
                <label for="postal_code" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Postal Code:</label>
                <input type="text" name="postal_code" id="postal_code" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" value="{{ $address->postal_code }}" required>
            </div>
            <div class="mb-4">
                <label for="county" class="block text-sm font-medium text-gray-600 dark:text-gray-300">County:</label>
                <input type="text" name="county" id="county" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" value="{{ $address->county }}" required>
            </div>
            <button type="submit" class="w-full px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:ring focus:ring-indigo-200 focus:outline-none">Save</button>
        </form>
    </div>
@endsection
