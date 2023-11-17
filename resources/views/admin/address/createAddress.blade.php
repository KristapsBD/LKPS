@extends('layouts.admin')

@section('content')
    <div class="max-w-md mx-auto mt-4 bg-white dark:bg-gray-700 p-4 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4 dark:text-gray-200">Create New Address</h2>
        <form action="{{ route('admin.createAddress') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="street" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Street:</label>
                <input type="text" name="street" id="street" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" required>
            </div>
            <div class="mb-4">
                <label for="city" class="block text-sm font-medium text-gray-600 dark:text-gray-300">City:</label>
                <input type="text" name="city" id="city" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" required>
            </div>
            <div class="mb-4">
                <label for="postal_code" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Postal Code:</label>
                <input type="text" name="postal_code" id="postal_code" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" required>
            </div>
            <div class="mb-4">
                <label for="county" class="block text-sm font-medium text-gray-600 dark:text-gray-300">County:</label>
                <input type="text" name="county" id="county" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" required>
            </div>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md">Create Address</button>
        </form>
    </div>
@endsection
