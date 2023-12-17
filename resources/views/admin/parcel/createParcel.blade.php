@extends('layouts.admin')

@section('content')
    <div class="container mx-auto flex flex-col items-center">
{{--        <h2 class="text-2xl font-semibold dark:text-gray-200">Parcel Information</h2>--}}
{{--        TODO fix errors display--}}
{{--        TODO fix data placeholder for input fields--}}
{{--        <form method="POST" action="{{ route('admin.createParcel') }}">--}}
{{--            @csrf--}}

{{--            <div class="mb-4">--}}
{{--                <label for="size" class="block text-gray-700 dark:text-gray-300">Parcel Size</label>--}}
{{--                <select id="size" name="size" class="form-select" value="{{ old('size', $step1Data['size'] ?? '') }}">--}}
{{--                    <option value="s">Small</option>--}}
{{--                    <option value="m">Medium</option>--}}
{{--                    <option value="l">Large</option>--}}
{{--                    <option value="xl">Extra Large</option>--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            <div class="mb-4">--}}
{{--                <label for="weight" class="block text-gray-700 dark:text-gray-300">Parcel Weight (kg)</label>--}}
{{--                <input type="number" id="weight" name="weight" class="form-input" min="0" required step="0.01" value="{{ old('weight', $step1Data['weight'] ?? '') }}">--}}
{{--                @error('weight')--}}
{{--                <p class="text-red-500 text-sm">{{ $message }}</p>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="mb-4">--}}
{{--                <label for="notes" class="block text-gray-700 dark:text-gray-300">Additional Notes</label>--}}
{{--                <textarea id="notes" name="notes" class="form-textarea" placeholder="Enter additional notes...">{{ old('notes', $step1Data['notes'] ?? '') }}</textarea>--}}
{{--            </div>--}}

{{--            <div class="mb-4">--}}
{{--                <label for="sender_id" class="block text-gray-700 dark:text-gray-300">Sender ID</label>--}}
{{--                <input type="number" id="sender_id" name="sender_id" class="form-input" min="0" max="100" required value="{{ old('sender_id', '') }}">--}}
{{--            </div>--}}

{{--            <!-- Sender Information -->--}}
{{--            <div class="mt-4">--}}
{{--                <h3 class="text-lg font-semibold dark:text-white">Sender Information</h3>--}}
{{--                <div class="mb-4">--}}
{{--                    <label for="sender_name" class="block dark:text-white">Name</label>--}}
{{--                    <input type="text" id="sender_name" name="sender_name" class="form-input dark:text-black" required value="{{ old('sender_name', $step2Data['sender_name'] ?? auth()->user()->name) }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="sender_email" class="block dark:text-white">Email</label>--}}
{{--                    <input type="email" id="sender_email" name="sender_email" class="form-input dark:text-black" required value="{{ old('sender_email', $step2Data['sender_email'] ?? auth()->user()->email) }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="sender_phone" class="block dark:text-white">Phone</label>--}}
{{--                    <input type="tel" id="sender_phone" name="sender_phone" class="form-input dark:text-black" required value="{{ old('sender_phone', $step2Data['sender_phone'] ?? auth()->user()->phone) }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="sender_address" class="block dark:text-white">Address</label>--}}
{{--                    <textarea id="sender_address" name="sender_address" class="form-textarea dark:text-black" required placeholder="Enter address">{{ old('sender_address', $step2Data['sender_address'] ?? auth()->user()->address) }}</textarea>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Parcel Dropoff Information -->--}}
{{--            <div class="mt-4">--}}
{{--                <h3 class="text-lg font-semibold dark:text-white">Parcel Dropoff Information</h3>--}}
{{--                <div class="mb-4">--}}
{{--                    <label for="dropoff_date" class="block dark:text-white">Dropoff Date</label>--}}
{{--                    <input type="date" id="dropoff_date" name="dropoff_date" class="form-input dark:text-black" required value="{{ old('dropoff_date', $step2Data['dropoff_date'] ?? '') }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="dropoff_time_from" class="block dark:text-white">Dropoff Time From</label>--}}
{{--                    <input type="time" id="dropoff_time_from" name="dropoff_time_from" class="form-input dark:text-black" required value="{{ old('dropoff_time_from', $step2Data['dropoff_time_from'] ?? '') }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="dropoff_time_to" class="block dark:text-white">Dropoff Time To</label>--}}
{{--                    <input type="time" id="dropoff_time_to" name="dropoff_time_to" class="form-input dark:text-black" required value="{{ old('dropoff_time_to', $step2Data['dropoff_time_to'] ?? '') }}">--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Receiver Information -->--}}
{{--            <div class="mt-4">--}}
{{--                <h3 class="text-lg font-semibold dark:text-white">Receiver Information</h3>--}}
{{--                <div class="mb-4">--}}
{{--                    <label for="receiver_name" class="block dark:text-white">Name</label>--}}
{{--                    <input type="text" id="receiver_name" name="receiver_name" class="form-input dark:text-black" required value="{{ old('receiver_name', $step3Data['receiver_name'] ?? '') }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="receiver_email" class="block dark:text-white">Email</label>--}}
{{--                    <input type="email" id="receiver_email" name="receiver_email" class="form-input dark:text-black" required value="{{ old('receiver_email', $step3Data['receiver_email'] ?? '') }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="receiver_phone" class="block dark:text-white">Phone</label>--}}
{{--                    <input type="tel" id="receiver_phone" name="receiver_phone" class="form-input dark:text-black" required value="{{ old('receiver_phone', $step3Data['receiver_phone'] ?? '') }}">--}}
{{--                </div>--}}

{{--                <div class="mb-4">--}}
{{--                    <label for="receiver_address" class="block dark:text-white">Address</label>--}}
{{--                    <textarea id="receiver_address" name="receiver_address" class="form-textarea dark:text-black" required placeholder="Enter address">{{ old('receiver_address', $step3Data['receiver_address'] ?? '') }}</textarea>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="mb-4">--}}
{{--                <label for="receiver_id" class="block text-gray-700 dark:text-gray-300">Receiver ID</label>--}}
{{--                <input type="number" id="receiver_id" name="receiver_id" class="form-input" min="0" max="100" required value="{{ old('receiver_id', '') }}">--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a New Parcel</h2>
            <form method="POST" action="{{ route('admin.createParcel') }}">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div>
                        <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                        <select id="size" name="size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled selected>Select size</option>
                            <option value="s" {{ old('size') == 's' ? 'selected' : '' }}>Small</option>
                            <option value="m" {{ old('size') == 'm' ? 'selected' : '' }}>Medium</option>
                            <option value="l" {{ old('size') == 'l' ? 'selected' : '' }}>Large</option>
                            <option value="xl" {{ old('size') == 'xl' ? 'selected' : '' }}>Extra Large</option>
                        </select>
                        </select>
                        @error('size')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parcel Weight (kg)</label>
                        <input type="number" name="weight" id="weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" min="1" max="100" required step="0.01" placeholder="Enter weight">
                        @error('weight')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="sender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sender</label>
                        <select id="sender" name="sender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled selected>Select a sender</option>
                            @foreach($users as $sender)
                                <option value="{{ $sender->id }}" {{ old('sender') == $sender->id ? 'selected' : '' }}>{{ $sender->name }}, {{ $sender->email }}, {{ $sender->phone }}</option>
                            @endforeach
                        </select>
                        @error('sender')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="source" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Source Address</label>
                        <select id="source" name="source" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled selected>Select a source</option>
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}" {{ old('source') == $address->id ? 'selected' : '' }}>{{ $address->street }}, {{ $address->city }}, {{ $address->post_code }}</option>
                            @endforeach
                        </select>
                        @error('source')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="receiver" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Receiver</label>
                        <select id="receiver" name="receiver" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled selected>Select a receiver</option>
                            @foreach($clients as $receiver)
                                <option value="{{ $receiver->id }}" {{ old('receiver') == $receiver->id ? 'selected' : '' }}>{{ $receiver->name }}, {{ $receiver->phone }}</option>
                            @endforeach
                        </select>
                        @error('receiver')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="destination" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destination Address</label>
                        <select id="destination" name="destination" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled selected>Select a destination</option>
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}" {{ old('destination') == $address->id ? 'selected' : '' }}>{{ $address->street }}, {{ $address->city }}, {{ $address->post_code }}</option>
                            @endforeach
                        </select>
                        @error('destination')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="tariff" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tariff</label>
                        <select id="tariff" name="tariff" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled selected>Select a tariff</option>
                            @foreach($tariffs as $tariff)
                                <option value="{{ $tariff->id }}" {{ old('tariff') == $tariff->id ? 'selected' : '' }}>{{ $tariff->name }}, {{ $tariff->extra_information }}</option>
                            @endforeach
                        </select>
                        @error('tariff')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="vehicle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle</label>
                        <select id="vehicle" name="vehicle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" disabled selected>Select a vehicle</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ old('vehicle') == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->registration_number }}, {{ mapVehicleTypeToString($vehicle->type) }}</option>
                            @endforeach
                        </select>
                        @error('vehicle')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes</label>
                        <textarea id="notes" name="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Parcel notes here...">{{ old('notes') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                    Add Parcel
                </button>
            </form>
        </div>
    </section>
@endsection
