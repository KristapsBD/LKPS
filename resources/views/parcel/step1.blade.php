<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Step 1 - Parcel Information') }}
        </h2>
    </x-slot>

    <div class="container mx-auto flex flex-col items-center">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('parcel.storeStep1') }}" class="mt-4">
            @csrf

            <div class="mb-4">
                <h3 class="text-lg font-semibold dark:text-white">Parcel Information</h3>
                <label for="size" class="block dark:text-white">Parcel Size</label>
                <select id="size" name="size" class="form-select">
                    <option value="s" {{isset($step1Data['size']) && $step1Data['size'] === 's' ? 'selected' : ''}}>Small</option>
                    <option value="m" {{isset($step1Data['size']) && $step1Data['size'] === 'm' ? 'selected' : ''}}>Medium</option>
                    <option value="l" {{isset($step1Data['size']) && $step1Data['size'] === 'l' ? 'selected' : ''}}>Large</option>
                    <option value="xl" {{isset($step1Data['size']) && $step1Data['size'] === 'xl' ? 'selected' : ''}}>Extra Large</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="weight" class="block dark:text-white">Parcel Weight (kg)</label>
                <input type="number" id="weight" name="weight" class="form-input" min="1" max="100" required value="{{ old('weight', $step1Data['weight'] ?? '') }}">
            </div>

            <div class="mb-4">
                <label for="notes" class="block dark:text-white">Additional Notes</label>
                <textarea id="notes" name="notes" class="form-textarea" placeholder="Enter additional notes...">{{ old('notes', $step1Data['notes'] ?? '') }}</textarea>
            </div>

            <div class="mt-4">
                <a href="{{ route('parcel.cancel') }}" class="btn btn-secondary py-2.5 px-5 me-2 mb-2 font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Next</button>
            </div>
        </form>
    </div>
</x-app-layout>
