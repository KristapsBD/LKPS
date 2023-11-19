<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Admin Panel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <div x-data="{ showMessage: true }" x-show="showMessage">
            @if (session('success'))
                <div class="flex items-top bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                    <div>
                        <p class="font-bold">Success</p>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button type="button" @click="showMessage = false" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-green-100 dark:text-green-400 dark:hover:bg-green-50" data-dismiss-target="#alert-success" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <h1 class="text-2xl font-bold p-4 dark:text-gray-200">Welcome to the Admin Panel</h1>
        <div class="flex">
            <div class="w-1/6 h-screen bg-gray-200 dark:bg-gray-800 p-4">
                <ul class="space-y-2">
                    <li>
                        <a class="block text-blue-600 hover:underline dark:text-gray-100" href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="block text-blue-600 hover:underline dark:text-gray-100" href="{{ route('admin.users') }}">
                            View All Users
                        </a>
                    </li>
                    <li>
                        <a class="block text-blue-600 hover:underline dark:text-gray-100" href="{{ route('admin.parcels') }}">
                            View All Parcels
                        </a>
                    </li>
                    <li>
                        <a class="block text-blue-600 hover:underline dark:text-gray-100" href="{{ route('admin.vehicles') }}">
                            View All Vehicles
                        </a>
                    </li>
                    <li>
                        <a class="block text-blue-600 hover:underline dark:text-gray-100" href="{{ route('admin.addresses') }}">
                            View All Addresses
                        </a>
                    </li>
                    <li>
                        <a class="block text-blue-600 hover:underline dark:text-gray-100" href="{{ route('admin.tariffs') }}">
                            View All Tariffs
                        </a>
                    </li>
                </ul>
            </div>
            <div class="w-3/4 p-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
