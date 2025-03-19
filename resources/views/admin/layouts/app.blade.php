<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('build/assets/app-bOPDhkW8.css') }}">
    <script src="{{ asset('build/assets/app-DspuE8pW.js') }}"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-sm border-r border-gray-200">
            <div class="p-4 border-b border-gray-200">
                <h1 class="text-xl font-semibold text-gray-900">Admin Panel</h1>
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'text-blue-700 bg-blue-50' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.danh-muc.index') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.danh-muc.*') ? 'text-blue-700 bg-blue-50' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Danh mục
                </a>
                <a href="{{ route('admin.san-pham.index') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.san-pham.*') ? 'text-blue-700 bg-blue-50' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Sản phẩm
                </a>
                <a href="{{ route('admin.don-hang.index') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.don-hang.*') ? 'text-blue-700 bg-blue-50' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Đơn hàng
                </a>
                <a href="{{ route('admin.nguoi-dung.index') }}"
                    class="flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.nguoi-dung.*') ? 'text-blue-700 bg-blue-50' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Người dùng
                </a>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <h1 class="text-2xl font-semibold text-gray-900 mb-6">@yield('header')</h1>
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>
