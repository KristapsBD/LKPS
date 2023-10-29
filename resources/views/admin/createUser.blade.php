@extends('layouts.admin')

@section('content')
    <div class="max-w-md mx-auto mt-4 bg-white dark:bg-gray-700 p-4 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4 dark:text-gray-200">Create New User</h2>
        <form action="{{ route('admin.createUser') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Name:</label>
                <input type="text" name="name" id="name" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Email:</label>
                <input type="email" name="email" id="email" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" required>
                @error('email')
                    <p class="text-red-600 text-xs">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Password:</label>
                <input type="password" name="password" id="password" class="border rounded-md px-3 py-2 w-full focus:ring focus:ring-indigo-400" required>
            </div>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md">Create User</button>
        </form>
    </div>
@endsection
