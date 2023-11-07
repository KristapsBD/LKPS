@extends('layouts.admin')
@section('content')
<script src="{{ asset('js/admin.js') }}"></script>
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold dark:text-gray-200">All Registered Users</h2>
        <a href="{{ route('admin.createUser') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create User</a>
    </div>
    <table class="w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 dark:text-gray-100">ID</th>
                <th class="px-4 py-2 dark:text-gray-100">Name</th>
                <th class="px-4 py-2 dark:text-gray-100">Email</th>
                <th class="px-4 py-2 dark:text-gray-100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $user->id }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $user->name }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">{{ $user->email }}</td>
                    <td class="border px-4 py-2 dark:text-gray-100">
                        <a href="{{ route('admin.editUserForm', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                        <button
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1.5 px-4 rounded mr-2 delete-user"
                            data-toggle="modal"
                            data-target="#confirmDeleteModal"
                            data-user-id="{{ $user->id }}"
                            data-delete-route="{{ route('admin.deleteUser', $user->id) }}"
                        >
                        Delete
                    </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="fixed z-10 inset-0 overflow-y-auto" id="confirmDeleteModal" style="display: none;">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This is the modal container -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-gray-700 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200" id="confirmDeleteModalLabel">Confirm Delete</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500 dark:text-gray-300">Are you sure you want to delete this user?</p>
                </div>
            </div>
            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" id="confirmDelete">Confirm Delete</button>
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-gray-600 sm:mt-0 sm:w-auto sm:text-sm" data-dismiss="modal" id="cancelDelete">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection
