@extends('layouts.courier')

@section('content')
    <div class="container mx-auto flex flex-col items-center">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Parcel</h2>
                <form method="POST" action="{{ route('courier.editParcel', $parcel->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled selected>Select a status</option>
                                <option value="2" {{ (old('status') == '2' || $parcel->status == 2) ? 'selected' : '' }}>In Transit</option>
                                <option value="3" {{ (old('status') == '3' || $parcel->status == 3) ? 'selected' : '' }}>Out For Delivery</option>
                                <option value="4" {{ (old('status') == '4' || $parcel->status == 4) ? 'selected' : '' }}>Delivered</option>
                                <option value="5" {{ (old('status') == '5' || $parcel->status == 5) ? 'selected' : '' }}>On Hold</option>
                            </select>
                            @error('status')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
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
