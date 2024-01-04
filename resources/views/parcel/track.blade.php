@extends('layouts.default')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Parcel Tracking') }}
    </h2>
@endsection

@section('content')
    <div class="max-w-md mx-auto my-8">
        <form id="track-form" action="{{ route('parcel.track') }}" method="POST" class="max-w-md mx-auto">
            @csrf
            <div class="mb-5">
                <label for="tracking_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tracking Code</label>
                <input type="text" id="tracking_code" name="tracking_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Tracking Code" required>
                <p id="validation-error" class="text-red-600 text-xs hidden"></p>
            </div>
            <button type="submit" class="text-white grow-0 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Track Parcel</button>
        </form>

        <div id="tracking-card" class="hidden mt-4 max-w-md bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <img class="rounded-t-lg" src="{{ asset('/images/courier_tracking.jpg')  }}" alt="Tracking page photo" />
            </a>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Your Parcel Tracking Information:</h5>
                </a>
                <div id="tracking-info" class="mt-4">
                    <!-- Tracking information will be displayed here dynamically -->
                </div>
            </div>
        </div>

        <div id="tracking-error" class="mt-4 hidden">
            <!-- Tracking error will be displayed here dynamically -->
        </div>
    </div>

    <script>
        // Use Ajax to fetch tracking information
        $('#track-form').submit(function (e) {
            e.preventDefault();

            // Hide any previous validation and tracking errors
            $('#validation-error').addClass('hidden');
            $('#tracking-error').addClass('hidden');

            var trackingCode = $('#tracking_code').val();

            // Perform an Ajax request to fetch tracking information
            $.ajax({
                url: '{{ route("parcel.track") }}',
                type: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                // Data to be sent in the request body, formatted as JSON
                data: JSON.stringify({ tracking_code: trackingCode }),
                dataType: 'json',
                success: function (data) {
                    // Show the tracking card and update tracking information
                    $('#tracking-card').removeClass('hidden');
                    $('#tracking-info').html(`<p class="font-semibold dark:text-white">Status: ${data.status}</p>`);
                },
                error: function (error) {
                    console.error('Error:', error);

                    // Hide the tracking card and display error messages
                    $('#tracking-card').addClass('hidden');

                    // Show custom error based on error status
                    if (error.status === 422) {
                        $('#validation-error').removeClass('hidden').text(error.responseJSON.message);
                    } else if (error.status === 404) {
                        $('#tracking-error').removeClass('hidden');
                        $('#tracking-error').html('<p class="dark:text-white">' + error.responseJSON.error + '</p>');
                    } else {
                        $('#tracking-error').removeClass('hidden');
                        $('#tracking-error').html('<p class="dark:text-white">Error retrieving tracking information.</p>');
                    }
                }
            });
        });
    </script>
@endsection
