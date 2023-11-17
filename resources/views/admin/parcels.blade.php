@extends('layouts.admin')
@section('content')
    <script src="{{ asset('js/admin.js') }}"></script>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold dark:text-gray-200">All Parcels</h2>
            <a href="{{ route('admin.createParcel') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create Parcel</a>
        </div>
        <table class="table-auto">
            <thead>
            <tr>
                <th class="px-4 py-2 dark:text-gray-100">ID</th>
                <th class="px-4 py-2 dark:text-gray-100">Weight</th>
                <th class="px-4 py-2 dark:text-gray-100">Notes</th>
                <th class="px-4 py-2 dark:text-gray-100">Sender ID</th>
                <th class="px-4 py-2 dark:text-gray-100">Receiver ID</th>
                <th class="px-4 py-2 dark:text-gray-100">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($parcels as $parcel)
                <tr>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $parcel->id }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $parcel->weight }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $parcel->notes }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $parcel->sender_id }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $parcel->receiver_id }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">
                        <a href="{{ route('admin.editParcelForm', $parcel->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                        <button
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1.5 px-4 rounded mr-2 delete-element"
                            data-toggle="modal"
                            data-target="#confirmDeleteModal"
                            data-element-id="{{ $parcel->id }}"
                            data-delete-route="{{ route('admin.deleteParcel', $parcel->id) }}"
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
