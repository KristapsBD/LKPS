<x-app-layout>
    <div class="container mx-auto flex flex-col items-center">
        <h2 class="text-2xl font-semibold dark:text-gray-200">Parcel Information</h2>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('parcel.storeStep1') }}">
            @csrf

            <div class="mb-4">
                <label for="size" class="block text-gray-700 dark:text-gray-300">Parcel Size</label>
                <select id="size" name="size" class="form-select" value="{{ old('size', $step1Data['size'] ?? '') }}">
                    <option value="s">Small</option>
                    <option value="m">Medium</option>
                    <option value="l">Large</option>
                    <option value="xl">Extra Large</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="weight" class="block text-gray-700 dark:text-gray-300">Parcel Weight (kg)</label>
                <input type="number" id="weight" name="weight" class="form-input" min="0" max="100" required value="{{ old('weight', $step1Data['weight'] ?? '') }}">
            </div>

            <div class="mb-4">
                <label for="notes" class="block text-gray-700 dark:text-gray-300">Additional Notes</label>
                <textarea id="notes" name="notes" class="form-textarea" placeholder="Enter additional notes...">{{ old('notes', $step1Data['notes'] ?? '') }}</textarea>
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Next</button>
            </div>
        </form>
    </div>
</x-app-layout>
