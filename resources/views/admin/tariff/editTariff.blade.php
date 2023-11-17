@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold dark:text-gray-200">Edit Tariff</h2>
        <form action="{{ route('admin.editTariff', $tariff->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Name') }}:</label>
                <input type="text" name="name" id="name" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" value="{{ $tariff->name }}" required>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Price') }}:</label>
                <input type="number" name="price" id="price" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" value="{{ $tariff->price }}" required step="0.01">
            </div>
            <div class="mb-4">
                <label for="extra_information" class="block text-sm font-medium text-gray-600 dark:text-gray-300">{{ __('Extra Information') }}:</label>
                <textarea name="extra_information" id="extra_information" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400">{{ $tariff->extra_information }}</textarea>
            </div>
            <button type="submit" class="w-full px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:ring focus:ring-indigo-200 focus:outline-none">Save</button>
        </form>
    </div>
@endsection
