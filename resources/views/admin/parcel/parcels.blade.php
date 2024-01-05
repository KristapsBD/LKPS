@extends('layouts.admin')
@section('content')
    <form id="parcel-select-form" action="" method="POST">
        @csrf
        <h2 class="text-2xl font-semibold dark:text-gray-200 mb-4">Parcel Management</h2>
        <div class="flex flex-col sm:flex-row mb-4">
            <a href="{{ route('admin.importForm') }}" class="mb-2 sm:mb-0 sm:mr-4">
                <button type="button" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Import Parcels</button>
            </a>
            <button type="button" onclick="submitForm('export-selected')" id="generate-route-button" class="disabled:bg-gray-500 disabled:hover:bg-gray-700 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 sm:mb-0 sm:mr-4" disabled>
                Export Parcels
            </button>
            <button type="button" onclick="submitForm('generate-route')" id="export-parcels-button" class="disabled:bg-gray-500 disabled:hover:bg-gray-700 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 sm:mb-0 sm:mr-4" disabled>
                Generate Route
            </button>
            <a href="{{ route('admin.createParcel') }}">
                <button type="button" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create Parcel</button>
            </a>
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
                                <input value="{{ $parcel->id }}" id="checkbox-table-search-{{ $parcel->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-{{ $parcel->id }}" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $parcel->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $parcel->weight }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Str::words($parcel->notes, 5) }}
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
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <a href="{{ route('admin.editParcelForm', $parcel->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3 delete-element" data-toggle="modal" data-target="#confirmDeleteModal" data-element-id="{{ $parcel->id }}" data-delete-route="{{ route('admin.deleteParcel', $parcel->id) }}">Remove</a>
                            </div>
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
    <script src="{{ asset('js/cancelModal.js') }}" defer></script>
    <script src="{{ asset('js/checkAllFormCheckboxes.js') }}" defer></script>
    <script src="{{ asset('js/updateButtonState.js') }}" defer></script>
    <script src="{{ asset('js/submitForm.js') }}" defer></script>
@endsection
