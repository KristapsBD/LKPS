@extends('layouts.admin')
@section('content')
    <script src="{{ asset('js/admin.js') }}"></script>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold dark:text-gray-200">All Registered Users</h2>
            <a href="{{ route('admin.createUser') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Create User</a>
        </div>
        <table class="table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 dark:text-gray-100">ID</th>
                    <th class="px-4 py-2 dark:text-gray-100">Name</th>
                    <th class="px-4 py-2 dark:text-gray-100">Email</th>
                    <th class="px-4 py-2 dark:text-gray-100">Phone</th>
                    <th class="px-4 py-2 dark:text-gray-100">Role</th>
                    <th class="px-4 py-2 dark:text-gray-100">Address ID</th>
                    <th class="px-4 py-2 dark:text-gray-100">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border px-4 py-2 dark:text-gray-100">{{ $user->id }}</td>
                        <td class="border px-4 py-2 dark:text-gray-100">{{ $user->name }}</td>
                        <td class="border px-4 py-2 dark:text-gray-100">{{ $user->email }}</td>
                        <td class="border px-4 py-2 dark:text-gray-100">{{ $user->phone }}</td>
                        <td class="border px-4 py-2 dark:text-gray-100">{{ mapUserRoleToString($user->role) }}</td>
                        <td class="border px-4 py-2 dark:text-gray-100">{{ $user->address_id }}</td>
                        <td class="border px-4 py-2 dark:text-gray-100">
                            <a href="{{ route('admin.editUserForm', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                            <button
                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-1.5 px-4 rounded mr-2 delete-element"
                                data-toggle="modal"
                                data-target="#confirmDeleteModal"
                                data-element-id="{{ $user->id }}"
                                data-delete-route="{{ route('admin.deleteUser', $user->id) }}"
                            >
                            Delete
                        </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination links -->
        <div class="mt-4 pagination">
            {{ $users->links() }}
        </div>
    </div>
@include('admin.confirmDeleteModal')
@endsection
