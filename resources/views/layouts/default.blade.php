<!doctype html>
<html>
<head>
    <!-- Scripts, styles and meta tags -->
    @include('includes.head')
</head>
<body>
    <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="flex-1">
        <header>
            <!-- Flash Messages -->
            @include('includes.messages')
            <!-- Navigatior Bar -->
            @include('includes.navigation')
            <!-- Page Heading -->
            @hasSection('header')
                <div class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </div>
            @endif
        </header>
        <!-- Main Page Content -->
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </div>
        <!-- Page Footer -->
        @include('includes.footer')
    </div>
</body>
</html>
