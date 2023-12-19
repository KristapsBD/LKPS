<!DOCTYPE html>
<html>
<head>
    <!-- Scripts, styles and meta tags -->
    @include('includes.head')
    @yield('head-scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <header>
            <!-- Flash Messages -->
            <div class="p-4 sm:ml-64">
                @include('includes.messages')
            </div>
        </header>
        <!-- Admin Sidebar -->
        @include('includes.sidebar')
        <div class="p-4 sm:ml-64">
            <!-- Main Content -->
            @yield('content')
        </div>
    </div>
    <!-- Admin Scripts -->
    @yield('scripts')
</body>
</html>
