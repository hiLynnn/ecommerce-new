<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/app-bOPDhkW8.css') }}">
    <script src="{{ asset('build/assets/app-DspuE8pW.js') }}"></script>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}"
                        class="text-xl font-bold text-gray-900 hover:text-blue-600 transition-colors duration-200">
                        {{ config('app.name') }}
                    </a>
                </div>

                <!-- Search -->
                <div class="flex-1 max-w-lg mx-8">
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <input type="text" name="q" value="{{ request('q') }}" class="form-input pl-10"
                            placeholder="Tìm kiếm sản phẩm...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </form>
                </div>

                <!-- Navigation -->
                <nav class="flex items-center space-x-6">
                    <a href="{{ route('cart') }}" class="header-nav-link">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        @if (app('cart')->count() > 0)
                            <span class="cart-badge">
                                {{ app('cart')->count() }}
                            </span>
                        @endif
                    </a>

                    @auth
                        <div class="relative" x-data="{ open: false }" @click.away="open = false"
                            @keydown.escape.window="open = false">
                            <button @click="open = !open" class="flex items-center space-x-2 header-nav-link"
                                :aria-expanded="open">
                                <span>{{ Auth::user()->ten }}</span>
                                <svg class="h-5 w-5 transition-transform duration-200"
                                    :class="{ 'transform rotate-180': open }" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95" class="dropdown-menu"
                                style="display: none;">
                                <a href="{{ route('profile') }}" class="dropdown-item">
                                    <i class="fas fa-user-circle mr-2"></i>
                                    Thông tin tài khoản
                                </a>
                                <a href="{{ route('orders') }}" class="dropdown-item">
                                    <i class="fas fa-shopping-bag mr-2"></i>
                                    Đơn hàng của tôi
                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item w-full text-left">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="header-nav-link">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Đăng nhập
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary">
                            <i class="fas fa-user-plus mr-2"></i>
                            Đăng ký
                        </a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Categories -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="category-nav">
                @foreach ($categories as $category)
                    <a href="{{ route('category', $category->slug) }}"
                        class="category-link {{ request()->is('danh-muc/' . $category->slug) ? 'category-link-active' : 'text-gray-700 hover:text-gray-900' }}">
                        {{ $category->ten_danh_muc }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="alert alert-success">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-auto">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="footer-title">Về chúng tôi</h3>
                    <p class="mt-4 text-base text-gray-500">
                        {{ config('app.name') }} - Nơi mua sắm tin cậy cho mọi người.
                    </p>
                </div>
                <div>
                    <h3 class="footer-title">Liên kết</h3>
                    <ul class="mt-4 space-y-4">
                        <li>
                            <a href="#" class="footer-link">
                                Chính sách bảo mật
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link">
                                Điều khoản sử dụng
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-title">Liên hệ</h3>
                    <ul class="mt-4 space-y-4">
                        <li class="flex items-center">
                            <i class="fas fa-phone text-gray-400 w-6"></i>
                            <span class="ml-3 footer-link">
                                0123.456.789
                            </span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-gray-400 w-6"></i>
                            <span class="ml-3 footer-link">
                                support@example.com
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-200 pt-8">
                <p class="text-base text-gray-400 text-center">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
