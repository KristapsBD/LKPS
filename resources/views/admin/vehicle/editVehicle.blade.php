@extends('layouts.admin')

@section('content')
    <div class="container mx-auto flex flex-col items-center">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Vehicle</h2>
                <form action="{{ route('admin.editVehicle', $vehicle->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="registration_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Registration Number</label>
                            <input type="text" name="registration_number" id="registration_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('registration_number') ?? $vehicle->registration_number }}" placeholder="Enter Registration Number" required autofocus>
                            @error('registration_number')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                            <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value="" disabled selected>Select type</option>
                                <option value="1" {{ (old('type') == '1' || $vehicle->type == 1) ? 'selected' : '' }}>Moped</option>
                                <option value="2" {{ (old('type') == '2' || $vehicle->type == 2) ? 'selected' : '' }}>Van</option>
                                <option value="3" {{ (old('type') == '3' || $vehicle->type == 3) ? 'selected' : '' }}>Truck</option>
                            </select>
                            @error('type')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value="" disabled selected>Select status</option>
                                <option value="0" {{ (old('status') == '0' || $vehicle->status == 0) ? 'selected' : '' }}>Out Of Order</option>
                                <option value="1" {{ (old('status') == '1' || $vehicle->status == 1) ? 'selected' : '' }}>Operational</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2">
                            <label for="current_driver" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Driver (optional)</label>
                            <select id="current_driver" name="current_driver" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled selected>Select a driver</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ (old('current_driver') == $driver->id || ($vehicle->current_driver && $vehicle->current_driver->id == $driver->id)) ? 'selected' : '' }}>
                                        {{ $driver->name }}, {{ $driver->phone }}
                                    </option>
                                @endforeach
                            </select>
                            @error('current_driver')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Save Vehicle
                    </button>
                </form>
            </div>
        </section>
    </div>
@endsection
