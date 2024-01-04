@extends('layouts.default')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Step 1 - Parcel Information') }}
    </h2>
@endsection

@section('content')
    <div class="container mx-auto flex flex-col items-center">
        @if (auth()->user()->address)
            <form method="POST" action="{{ route('parcel.storeStep1') }}" class="mt-4">
                @csrf

                <div class="mb-4">
                    <h3 class="text-lg font-semibold dark:text-white">Parcel Information</h3>
                    <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parcel Size</label>
                    <select id="size" name="size" class="form-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" disabled selected>Select size</option>
                        <option value="s" {{isset($step1Data['size']) && $step1Data['size'] === 's' ? 'selected' : ''}}>Small</option>
                        <option value="m" {{isset($step1Data['size']) && $step1Data['size'] === 'm' ? 'selected' : ''}}>Medium</option>
                        <option value="l" {{isset($step1Data['size']) && $step1Data['size'] === 'l' ? 'selected' : ''}}>Large</option>
                        <option value="xl" {{isset($step1Data['size']) && $step1Data['size'] === 'xl' ? 'selected' : ''}}>Extra Large</option>
                    </select>
                    @error('size')
                        <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parcel Weight (kg)</label>
                    <input type="number" id="weight" name="weight" class="form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="1" max="100" required step="0.01" value="{{ old('weight', $step1Data['weight'] ?? '') }}" placeholder="Enter weight">
                    @error('weight')
                        <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Additional Notes</label>
                    <textarea id="notes" name="notes" rows="4" class="form-textarea p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter additional notes...">{{ old('notes', $step1Data['notes'] ?? '') }}</textarea>
                    @error('notes')
                        <div class="error text-sm text-red-600 dark:text-red-400 space-y-1'">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <a href="{{ route('parcel.cancel') }}" class="btn btn-secondary py-2.5 px-5 me-2 mb-2 font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Next</button>
                </div>
            </form>
        @else
            <div class="mt-4">
                <p class="text-red-600 dark:text-red-400">
                    Please set your default address before proceeding.
                </p>
                <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">
                    Set Default Address
                </a>
            </div>
        @endif
    </div>
@endsection
