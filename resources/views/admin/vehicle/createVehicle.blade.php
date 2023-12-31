@extends('layouts.admin')

@section('content')
    <div class="container mx-auto flex flex-col items-center">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add New Vehicle</h2>
                <form method="POST" action="{{ route('admin.createVehicle') }}">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="registration_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Registration Number</label>
                            <input type="text" name="registration_number" id="registration_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('registration_number') }}" placeholder="Enter Registration Number" required autofocus>
                            @error('registration_number')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                            <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value="" disabled selected>Select type</option>
                                <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Moped</option>
                                <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Van</option>
                                <option value="3" {{ old('type') == '3' ? 'selected' : '' }}>Truck</option>
                            </select>
                            @error('type')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="current_driver" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Driver (optional)</label>
                            <select id="current_driver" name="current_driver" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled selected>Select a driver</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ old('current_driver') == $driver->id ? 'selected' : '' }}>{{ $driver->name }}, {{ $driver->phone }}</option>
                                @endforeach
                            </select>
                            @error('current_driver')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Add Vehicle
                    </button>
                </form>
            </div>
        </section>
    </div>
@endsection
