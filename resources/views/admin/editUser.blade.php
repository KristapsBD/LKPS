@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold dark:text-gray-200">Edit User</h2>
    <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block font-medium dark:text-gray-100">Name:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:outline-none">
        </div>
        <div class="mb-4">
            <label for="email" class="block font-medium dark:text-gray-100">Email:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:outline-none">
        </div>
        <button type="submit" class="w-full px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:ring focus:ring-indigo-200 focus:outline-none">Save</button>
    </form>
</div>
@endsection
