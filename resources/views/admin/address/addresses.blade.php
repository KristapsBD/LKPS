@extends('layouts.admin')
@section('content')
    <script src="{{ asset('js/admin.js') }}"></script>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold dark:text-gray-200">All Addresses</h2>
            <a href="{{ route('admin.createAddress') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create Address</a>
        </div>
        <table class="table-auto">
            <thead>
            <tr>
                <th class="px-4 py-2 dark:text-gray-100">ID</th>
                <th class="px-4 py-2 dark:text-gray-100">Street</th>
                <th class="px-4 py-2 dark:text-gray-100">City</th>
                <th class="px-4 py-2 dark:text-gray-100">Postode</th>
                <th class="px-4 py-2 dark:text-gray-100">County</th>
                <th class="px-4 py-2 dark:text-gray-100">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($addresses as $address)
                <tr>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $address->id }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $address->street }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $address->city }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $address->postal_code }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $address->county }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">
                        <a href="{{ route('admin.editAddressForm', $address->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                        <button
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1.5 px-4 rounded mr-2 delete-element"
                            data-toggle="modal"
                            data-target="#confirmDeleteModal"
                            data-element-id="{{ $address->id }}"
                            data-delete-route="{{ route('admin.deleteAddress', $address->id) }}"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('admin.confirmDeleteModal')
@endsection
