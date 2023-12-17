@extends('layouts.admin')

@section('content')
    <div class="max-w-md mx-auto mt-4 bg-white dark:bg-gray-700 p-4 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4 dark:text-gray-200">Create New Tariff</h2>
        <form action="{{ route('admin.createTariff') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Name') }}:</label>
                <input type="text" name="name" id="name" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" required>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Price') }}:</label>
                <input type="number" name="price" id="price" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" required step="0.01">
            </div>
            <div class="mb-4">
                <label for="extra_information" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Extra Information') }}:</label>
                <textarea name="extra_information" id="extra_information" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400"></textarea>
            </div>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md">Create Tariff</button>
        </form>
    </div>
@endsection
