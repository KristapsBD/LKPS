@extends('layouts.default')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Parcel Tracking') }}
    </h2>
@endsection

@section('content')
    <div class="max-w-md mx-auto my-8">
        <form id="track-form" action="{{ route('parcel.track') }}" method="POST" class="max-w-sm mx-auto">
            @csrf
            <div class="mb-5">
                <label for="tracking_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tracking Code</label>
                <input type="text" id="tracking_code" name="tracking_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Tracking Code" required>
                <p id="validation-error" class="text-red-600 text-xs hidden"></p>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Track Parcel</button>
        </form>

        <div id="tracking-info" class="mt-4">
            <!-- Tracking information will be displayed here dynamically -->
        </div>
    </div>

    <script>
        // Use Ajax to fetch tracking information
        $('#track-form').submit(function (e) {
            e.preventDefault();
            $('#validation-error').addClass('hidden').text();

            var trackingCode = $('#tracking_code').val();

            // Use jQuery Ajax to send a request to the server
            $.ajax({
                url: '{{ route("parcel.track") }}',
                type: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: JSON.stringify({ tracking_code: trackingCode }),
                dataType: 'json',
                success: function (data) {
                    // Update the content dynamically based on the received data
                    $('#tracking-info').html(`
                        <h3 class="text-lg font-semibold dark:text-white">Tracking Information</h3>
                        <p class="font-semibold dark:text-white">Status: ${data.status}</p>
                    `);
                },
                error: function (error) {
                    console.error('Error:', error);
                    $('#validation-error').removeClass('hidden').text(error.responseJSON.message);
                    if (error.status === 404) {
                        $('#tracking-info').html('<p class="dark:text-white">' + error.responseJSON.error + '</p>');

                    } else {
                        $('#tracking-info').html('<p class="dark:text-white">Error retrieving tracking information.</p>');
                    }
                }
            });
        });
    </script>
@endsection
