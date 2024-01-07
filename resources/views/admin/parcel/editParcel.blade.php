@extends('layouts.admin')

@section('content')
    <div class="container mx-auto flex flex-col items-center">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Parcel</h2>
                <form method="POST" action="{{ route('admin.editParcel', $parcel->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div>
                            <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                            <select id="size" name="size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled selected>Select a size</option>
                                <option value="s" {{ (old('size') == 's' || $parcel->size == 's') ? 'selected' : '' }}>Small</option>
                                <option value="m" {{ (old('size') == 'm' || $parcel->size == 'm') ? 'selected' : '' }}>Medium</option>
                                <option value="l" {{ (old('size') == 'l' || $parcel->size == 'l') ? 'selected' : '' }}>Large</option>
                                <option value="xl" {{ (old('size') == 'xl' || $parcel->size == 'xl') ? 'selected' : '' }}>Extra Large</option>
                            </select>
                            @error('size')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parcel Weight (kg)</label>
                            <input type="number" name="weight" id="weight" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" min="1" max="100" required step="0.01" value="{{ old('weight') ?: $parcel->weight  }}" placeholder="Enter weight">
                            @error('weight')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="sender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sender</label>
                            <select id="sender" name="sender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled selected>Select a sender</option>
                                @foreach($formData['users'] as $sender)
                                    <option value="{{ $sender->id }}" {{ (old('sender') == $sender->id || $parcel->sender->id == $sender->id) ? 'selected' : '' }}>{{ $sender->name }}, {{ $sender->email }}, {{ $sender->phone }}</option>
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
                                @foreach($formData['addresses'] as $address)
                                    <option value="{{ $address->id }}" {{ (old('source') == $address->id || $parcel->source->id == $address->id) ? 'selected' : '' }}>{{ $address->street }}, {{ $address->city }}, {{ $address->postal_code }}</option>
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
                                @foreach($formData['clients'] as $receiver)
                                    <option value="{{ $receiver->id }}" {{ (old('receiver') == $receiver->id || $parcel->receiver->id == $receiver->id) ? 'selected' : '' }}>{{ $receiver->name }}, {{ $receiver->email }}, {{ $receiver->phone }}</option>
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
                                @foreach($formData['addresses'] as $address)
                                    <option value="{{ $address->id }}" {{ (old('destination') == $address->id || $parcel->destination->id == $address->id) ? 'selected' : '' }}>{{ $address->street }}, {{ $address->city }}, {{ $address->postal_code }}</option>
                                @endforeach
                            </select>
                            @error('destination')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled selected>Select a status</option>
                                <option value="0" {{ (old('status') == '0' || $parcel->status == 0) ? 'selected' : '' }}>Unpaid</option>
                                <option value="1" {{ (old('status') == '1' || $parcel->status == 1) ? 'selected' : '' }}>Processing</option>
                                <option value="2" {{ (old('status') == '2' || $parcel->status == 2) ? 'selected' : '' }}>In Transit</option>
                                <option value="3" {{ (old('status') == '3' || $parcel->status == 3) ? 'selected' : '' }}>Out For Delivery</option>
                                <option value="4" {{ (old('status') == '4' || $parcel->status == 4) ? 'selected' : '' }}>Delivered</option>
                                <option value="5" {{ (old('status') == '5' || $parcel->status == 5) ? 'selected' : '' }}>On Hold</option>
                            </select>
                            @error('status')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="vehicle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle</label>
                            <select id="vehicle" name="vehicle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled selected>Select a vehicle</option>
                                @foreach($formData['vehicles'] as $vehicle)
                                    <option value="{{ optional($vehicle)->id }}" {{ (old('vehicle') == optional($vehicle)->id || optional($parcel->vehicle)->id == optional($vehicle)->id) ? 'selected' : '' }}>
                                        {{ optional($vehicle)->registration_number }}, {{ optional($vehicle) ? mapVehicleTypeToString($vehicle->type) : 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="tariff" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tariff</label>
                            <select id="tariff" name="tariff" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled selected>Select a tariff</option>
                                @foreach($formData['tariffs'] as $tariff)
                                    <option value="{{ $tariff->id }}" {{ (old('tariff') == $tariff->id || $parcel->tariff->id == $tariff->id) ? 'selected' : '' }}>{{ $tariff->name }}: {{ $tariff->extra_information }}</option>
                                @endforeach
                            </select>
                            @error('tariff')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes</label>
                            <textarea id="notes" name="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Parcel notes here...">{{ old('notes') ?: $parcel->notes }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Save Parcel
                    </button>
                </form>
            </div>
        </section>
    </div>
@endsection
