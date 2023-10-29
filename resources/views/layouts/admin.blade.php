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
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                <p class="font-bold">Success</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        <h1 class="text-2xl font-bold p-4 dark:text-gray-200">Welcome to the Admin Panel</h1>
        <div class="flex">
            <div class="w-1/4 bg-gray-200 dark:bg-gray-800 p-4">
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
                    <!-- Add more sidebar links for other functionalities -->
                </ul>
            </div>
            <div class="w-3/4 p-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
