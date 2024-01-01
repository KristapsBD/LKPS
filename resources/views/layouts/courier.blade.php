<!DOCTYPE html>
<html>
<head>
    <!-- Scripts, styles and meta tags -->
    @include('includes.head')
    @yield('head-scripts')
</head>
<body>
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <header>
        <!-- Flash Messages -->
        <div class="p-4 sm:ml-64">
            @include('includes.messages')
        </div>
    </header>
    <!-- Courier Sidebar -->
    @include('includes.sidebar-courier')
    <div class="p-4 sm:ml-64">
        <!-- Main Content -->
        @yield('content')
    </div>
</div>
<!-- Courier Scripts -->
@yield('scripts')
</body>
</html>
