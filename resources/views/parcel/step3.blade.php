<x-app-layout>
    <div class="container mx-auto flex flex-col items-center">
        <h2 class="text-2xl font-semibold dark:text-white">Receiver Information</h2>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('parcel.storeStep3') }}" class="mt-4">
            @csrf

            <!-- Receiver Information -->
            <div class="mt-4">
                <h3 class="text-lg font-semibold dark:text-white">Receiver Information</h3>
                <div class="mb-4">
                    <label for="receiver_name" class="block dark:text-white">Name</label>
                    <input type="text" id="receiver_name" name="receiver_name" class="form-input dark:text-black" required value="{{ old('receiver_name', $step3Data['receiver_name'] ?? '') }}">
                </div>

                <div class="mb-4">
                    <label for="receiver_email" class="block dark:text-white">Email</label>
                    <input type="email" id="receiver_email" name="receiver_email" class="form-input dark:text-black" required value="{{ old('receiver_email', $step3Data['receiver_email'] ?? '') }}">
                </div>

                <div class="mb-4">
                    <label for="receiver_phone" class="block dark:text-white">Phone</label>
                    <input type="tel" id="receiver_phone" name="receiver_phone" class="form-input dark:text-black" required value="{{ old('receiver_phone', $step3Data['receiver_phone'] ?? '') }}">
                </div>

                <div class="mb-4">
                    <label for="receiver_address" class="block dark:text-white">Address</label>
                    <textarea id="receiver_address" name="receiver_address" class="form-textarea dark:text-black" required placeholder="Enter address">{{ old('receiver_address', $step3Data['receiver_address'] ?? '') }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Next</button>
            </div>
        </form>
    </div>
</x-app-layout>
