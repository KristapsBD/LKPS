@extends('layouts.admin')
@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold dark:text-gray-200">Vehicle Management</h2>
        <a href="{{ route('admin.createVehicle') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create Vehicle</a>
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
                    Registration
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($vehicles as $vehicle)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $vehicle->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $vehicle->registration_number }}
                    </td>
                    <td class="px-6 py-4">
                        {{ mapVehicleTypeToString($vehicle->type) }}
                    </td>
                    <td class="flex items-center px-6 py-4">
                        <a href="{{ route('admin.editVehicleForm', $vehicle->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3 delete-element" data-toggle="modal" data-target="#confirmDeleteModal" data-element-id="{{ $vehicle->id }}" data-delete-route="{{ route('admin.deleteVehicle', $vehicle->id) }}">Remove</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Pagination links -->
    <div class="mt-4">
        {{ $vehicles->links() }}
    </div>

    @include('admin.confirmDeleteModal')
@endsection

@section('scripts')
    <script src="{{ asset('js/checkAllFormCheckboxes.js') }}" defer></script>
@endsection
