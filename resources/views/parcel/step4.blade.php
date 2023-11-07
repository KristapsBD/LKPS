<x-app-layout>
    <div class="container mx-auto p-4 flex flex-col items-center">
        <h2 class="text-2xl font-semibold dark:text-white">Parcel Overview</h2>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('parcel.storeAllData') }}">
            @csrf
            <!-- Parcel Overview Section -->
            <section class="mt-4">
                <h3 class="text-lg font-semibold dark:text-white">Parcel Information</h3>
                <div class="mb-4">
                    <label class="block dark:text-white">Parcel Size:</label>
                    <span class="dark:text-white">{{ $step1Data ? $step1Data['size'] : '' }}</span>
                </div>

                <div class="mb-4">
                    <label class="block dark:text-white">Parcel Weight (kg):</label>
                    <span class="dark:text-white">{{ $step1Data ? $step1Data['weight'] : '' }}</span>
                </div>

                <div class="mb-4">
                    <label class="block dark:text-white">Additional Notes:</label>
                    <span class="dark:text-white">{{ $step1Data ? $step1Data['notes'] : 'N/A' }}</span>
                </div>
            </section>

            <!-- Sender Information Section -->
            <section class="mt-4">
                <h3 class="text-lg font-semibold dark:text-white">Sender Information</h3>
                <div class="mb-4">
                    <label class="block dark:text-white">Name:</label>
                    <span class="dark:text-white">{{ $step2Data ? $step2Data['sender_name'] : '' }}</span>
                </div>

                <div class="mb-4">
                    <label class="block dark:text-white">Email:</label>
                    <span class="dark:text-white">{{ $step2Data ? $step2Data['sender_email'] : '' }}</span>
                </div>

                <div class="mb-4">
                    <label class="block dark:text-white">Phone:</label>
                    <span class="dark:text-white">{{ $step2Data ? $step2Data['sender_phone'] : '' }}</span>
                </div>

                <div class="mb-4">
                    <label class="block dark:text-white">Address:</label>
                    <span class="dark:text-white">{{ $step2Data ? $step2Data['sender_address'] : '' }}</span>
                </div>
            </section>

            <!-- Parcel Pickup Information Section -->
            <section class="mt-4">
                <h3 class="text-lg font-semibold dark:text-white">Parcel Pickup Information</h3>
                <div class="mb-4">
                    <label class="block dark:text-white">Pickup Date:</label>
                    <span class="dark:text-white">{{ $step2Data ? $step2Data['dropoff_date'] : '' }}</span>
                </div>

                <div class="mb-4">
                    <label class="block dark:text-white">Pickup Time From:</label>
                    <span class="dark:text-white">{{ $step2Data ? $step2Data['dropoff_time_from'] : '' }}</span>
                </div>

                <div class="mb-4">
                    <label class="block dark:text-white">Pickup Time To:</label>
                    <span class="dark:text-white">{{ $step2Data ? $step2Data['dropoff_time_to'] : '' }}</span>
                </div>
            </section>

            <!-- Receiver Information Section -->
            <section class="mt-4">
                <h3 class="text-lg font-semibold dark:text-white">Receiver Information</h3>
                <div class="mb-4">
                    <label class="block dark:text-white">Name:</label>
                    <span class="dark:text-white">{{ $step3Data ? $step3Data['receiver_name'] : '' }}</span>
                </div>

                <div class="mb-4">
                    <label class="block dark:text-white">Email:</label>
                    <span class="dark:text-white">{{ $step3Data ? $step3Data['receiver_email'] : '' }}</span>
                </div>

                <div class="mb-4">
                    <label class="block dark:text-white">Phone:</label>
                    <span class="dark:text-white">{{ $step3Data ? $step3Data['receiver_phone'] : '' }}</span>
                </div>

                <div class="mb-4">
                    <label class="block dark:text-white">Address:</label>
                    <span class="dark:text-white">{{ $step3Data ? $step3Data['receiver_address'] : '' }}</span>
                </div>
            </section>

            <!-- Edit Options and Confirmation Button -->
            <div class="mt-4 space-x-4">
                <a href="{{ route('parcel.step1') }}" class="hover:underline">
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit Parcel Info
                    </button>
                </a>
                <a href="{{ route('parcel.step2') }}" class="hover:underline">
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit Sender Info
                    </button>
                </a>
                <a href="{{ route('parcel.step3') }}" class="hover:underline">
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Edit Receiver Info
                    </button>
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Confirm</button>
            </div>
        </form>
    </div>
</x-app-layout>
