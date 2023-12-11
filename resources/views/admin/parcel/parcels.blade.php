@extends('layouts.admin')
@section('content')
    <form id="generate-route-form" action="{{ route('admin.generateRoute') }}" method="POST">
        @csrf
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold dark:text-gray-200">Parcel Management</h2>
            <div>
                <button type="button" onclick="generateRoute()" id='generate-route-button' class="disabled:bg-gray-500 disabled:hover:bg-gray-700 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4" disabled>Generate Route</button>
                <a href="{{ route('admin.createParcel') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-[11px] px-4 rounded">Create Parcel</a>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Weight
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Notes
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sender
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Receiver
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Vehicle
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tariff
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($parcels as $parcel)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input value="{{ $parcel->id }}" id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $parcel->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $parcel->weight }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $parcel->notes }}
                        </td>
                        <td class="px-6 py-4">
                            {{ mapParcelStatusToValue($parcel->status) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $parcel->sender->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $parcel->receiver->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $parcel->vehicle->registration_number ?? "Not Assigned" }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $parcel->tariff->name ?? "Not Asigned" }}
                        </td>
                        <td class="flex items-center px-6 py-4">
                            <a href="{{ route('admin.editParcelForm', $parcel->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3 delete-element" data-toggle="modal" data-target="#confirmDeleteModal" data-element-id="{{ $parcel->id }}" data-delete-route="{{ route('admin.deleteParcel', $parcel->id) }}">Remove</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Hidden input field to store selected parcel IDs -->
        <input type="hidden" id="selected-parcels" name="selected_parcels" value="">
    </form>
    <!-- Pagination links -->
    <div class="mt-4">
        {{ $parcels->links() }}
    </div>

    @include('admin.confirmDeleteModal')
@endsection

@section('scripts')
    <script src="{{ asset('js/checkAllFormCheckboxes.js') }}" defer></script>
    <script>
        function generateRoute() {
            var selectedParcels = [];

            // Iterate over localStorage to find checkboxes that are checked
            Object.keys(localStorage).forEach(function (key) {
                if (key.startsWith('checkbox-') && localStorage.getItem(key) === 'true') {
                    // Extract the ID from the key and push it to the selectedParcels array
                    var parcelId = key.replace('checkbox-', '');
                    selectedParcels.push(parcelId);
                }
            });

            // Update the hidden input field with selected parcel IDs
            document.getElementById('selected-parcels').value = JSON.stringify(selectedParcels);

            // Clear local storage for checkboxes after form submission
            clearLocalStorageWithPrefix('checkbox-');

            // Clear local storage for the button state after form submission
            localStorage.removeItem('isButtonEnabled');

            // Submit the form
            document.getElementById('generate-route-form').submit();
        }

        function clearLocalStorageWithPrefix(prefix) {
            Object.keys(localStorage)
                .filter(key => key.startsWith(prefix))
                .forEach(key => localStorage.removeItem(key));
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get a reference to the "Generate Route" link
            var generateRouteButton = document.getElementById('generate-route-button');

            // Get all checkboxes
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');

            // Retrieve the button state from local storage on page load
            var isButtonEnabled = localStorage.getItem('isButtonEnabled') === 'true';
            generateRouteButton.disabled = !isButtonEnabled;

            // Attach an event listener to each checkbox
            checkboxes.forEach(function(checkbox) {
                // Load checkbox state from local storage on page load
                var checkboxKey = 'checkbox-' + checkbox.value;
                var isChecked = localStorage.getItem(checkboxKey) === 'true';
                checkbox.checked = isChecked;

                checkbox.addEventListener('change', function() {
                    // Save checkbox state to local storage
                    localStorage.setItem(checkboxKey, checkbox.checked);

                    // Enable or disable the "Generate Route" link based on checkbox status
                    generateRouteButton.disabled = !Array.from(checkboxes).some(checkbox => checkbox.checked);

                    // Update the button state based on checkbox changes
                    // Check if at least one checkbox is checked in localStorage
                    var isAnyCheckboxChecked = Object.keys(localStorage).some(function (key) {
                        console.log('testing '+ key);
                        console.log(key.startsWith('checkbox-'));
                        console.log(localStorage.getItem(key) === 'true');
                        return key.startsWith('checkbox-') && localStorage.getItem(key) === 'true';
                    });

                    localStorage.setItem('isButtonEnabled', isAnyCheckboxChecked);

                    generateRouteButton.disabled = !(localStorage.getItem('isButtonEnabled') === 'true');
                });
            });
        });
    </script>
@endsection
