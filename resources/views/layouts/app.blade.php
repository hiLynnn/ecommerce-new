<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Skin Food</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/app-bOPDhkW8.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="{{ asset('build/assets/app-DspuE8pW.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>


</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                {{-- <div class="flex-shrink-0">
                    <a href="{{ route('home') }}"
                        class="w-12 text-xl font-bold text-gray-900 hover:text-blue-600 transition-colors duration-200 block">
                        <img src="/images/logo.webp" alt="skin food">
                    </a>
                </div> --}}

                <!-- Search -->
                {{-- <div class="flex-1 max-w-lg mx-8 relative" x-data="{ open: false }">
                    <!-- Ô tìm kiếm -->
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <input type="text" name="q" @focus="open = true" @click.away="open = false"
                            class="form-input pl-10 w-full border-gray-300 rounded-lg focus:ring focus:ring-red-300"
                            placeholder="Tìm kiếm sản phẩm...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </form>

                    <!-- Dropdown gợi ý -->
                    <div x-show="open" class="absolute w-full bg-white shadow-lg rounded-lg mt-2 p-4 border border-gray-200 z-50">
                        <!-- Từ khóa phổ biến -->
                        <div class="mb-3">
                            <h4 class="text-gray-700 font-semibold mb-2">Từ khóa phổ biến</h4>
                            <div class="flex flex-wrap gap-1">
                                <a href="/tim-kiem?q=romand" class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-100">romand</a>
                                <a href="/tim-kiem?q=son" class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-100">son</a>
                                <a href="/tim-kiem?q=mặt nạ" class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-100">mặt nạ</a>
                                <a href="/tim-kiem?q=kem chống nắng" class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-100">kem chống nắng</a>
                            </div>
                        </div>

                        <!-- Thương hiệu nổi bật -->
                        <div class="mb-3">
                            <h4 class="text-gray-700 font-semibold mb-2">Thương hiệu nổi bật</h4>
                            <div class="grid grid-cols-4 gap-2">
                                <a href="/collections/merzy">
                                    <img class="w-20 h-20 border rounded-lg" src="/images/merzy.webp" alt="Merzy">
                                </a>
                                <a href="/collections/romand">
                                    <img class="w-20 h-20 border rounded-lg" src="/images/rom.webp" alt="Romand">
                                </a>
                                <a href="/collections/loreal">
                                    <img class="w-20 h-20 border rounded-lg" src="/images/lore.webp" alt="L'Oreal">
                                </a>
                                <a href="/collections/zeesea">
                                    <img class="w-20 h-20 border rounded-lg" src="/images/zeesea.webp" alt="Zeesea">
                                </a>
                            </div>
                        </div>

                        <!-- Danh mục nổi bật -->
                        <div>
                            <h4 class="text-gray-700 font-semibold mb-2">Danh mục nổi bật</h4>
                            <div class="flex flex-wrap gap-2">
                                <a href="/collections/chuong-trinh-khuyen-mai" class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-100">DEAL KHỦNG CHIỀU NÀNG</a>
                                <a href="/collections/mua-la-co-qua" class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-100">MUA LÀ CÓ QUÀ</a>
                                <a href="/collections/flash-sale-1" class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-100">FLASHSALE</a>
                                <a href="/collections/best-seller-skincare" class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-100">SKINCARE</a>
                            </div>
                        </div>
                    </div>
                </div> --}}



                <!-- Navigation -->
                {{-- <nav class="flex items-center space-x-6">
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
                        <a href="{{ route('register') }}">
                            <i class="fas fa-user-plus mr-2"></i>
                            Đăng ký
                        </a>
                    @endauth
                </nav> --}}
            </div>
        </div>
    </header>

    <!-- Categories -->
    {{-- <nav class="flex items-center justify-center space-x-6 border-b px-4 py-2 bg-white relative">
        <!-- Icon Menu -->
        <button class="text-2xl">
            &#9776;
        </button>

        <!-- Menu Items -->
        <ul class="flex items-center space-x-6 text-sm font-semibold">
            <!-- Dropdown danh mục -->
            <li x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="cursor-pointer flex items-center">
                    DANH MỤC SẢN PHẨM
                </button>

                <!-- Menu Dropdown -->
                <div x-show="open" @click.away="open = false"
                    class="absolute left-0 mt-2 w-64 bg-white shadow-lg rounded-lg p-2 z-50 border">
                    <ul class="space-y-2">
                        @foreach ($categories as $category)
                            <li class="cursor-pointer">
                                <a href="{{ route('category', $category->slug) }}"
                                    class="flex items-center space-x-2 p-2 hover:bg-gray-100 category-link {{ request()->is('danh-muc/' . $category->slug) ? 'category-link-active' : 'text-gray-700 hover:text-gray-900' }}">
                                    <img src="/images/icon.webp" alt="Icon" class="w-6 h-6"> <span>{{ $category->ten_danh_muc }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            @foreach ($categories as $category)
                <li class="cursor-pointer">
                    <a href="{{ route('category', $category->slug) }}"
                        class="flex items-center space-x-2 p-2 hover:bg-gray-100 category-link {{ request()->is('danh-muc/' . $category->slug) ? 'category-link-active' : 'text-gray-700 hover:text-gray-900' }}">
                        <span>{{ $category->ten_danh_muc }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav> --}}



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
    <footer class="bg-[#212121] text-white py-8">
        <div class="container mx-auto px-8">
            <div class="grid grid-cols-4 gap-8">
                <!-- Thông tin liên hệ -->
                <div>
                    <h2 class="font-semibold text-lg mb-3">THÔNG TIN LIÊN HỆ</h2>
                    <p>Hotline: 1900636510 (8:00-21:00)</p>
                    <p>• Hợp tác kinh doanh hàng hóa: <br> <a href="mailto:sales@thegioiskinfood.com" class="text-gray-300">sales@thegioiskinfood.com</a></p>
                    <p>• Hợp tác truyền thông/ Quảng cáo: <br> <a href="mailto:marketing@thegioiskinfood.com" class="text-gray-300">marketing@thegioiskinfood.com</a></p>
                    <p>• Tuyển dụng: <a href="mailto:tuyendung@thegioiskinfood.com" class="text-gray-300">tuyendung@thegioiskinfood.com</a></p>
                </div>

                <!-- Danh mục -->
                <div>
                    <h2 class="font-semibold text-lg mb-3">DANH MỤC</h2>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Túi Mù</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Deal khủng chiều nàng</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">New</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Chăm sóc da</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Trang điểm</a></li>
                    </ul>
                </div>

                <!-- Về chúng tôi -->
                <div>
                    <h2 class="font-semibold text-lg mb-3">VỀ CHÚNG TÔI</h2>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">Sơ đồ website</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Chứng chỉ đại lý chính hãng</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Phương thức thanh toán</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Chính sách đổi trả</a></li>
                    </ul>
                </div>

                <!-- Kết nối với chúng tôi -->
                <div>
                    <h2 class="font-semibold text-lg mb-3">KẾT NỐI VỚI CHÚNG TÔI</h2>
                    <div class="flex space-x-4 mb-4">
                        <a href="#">
                            <svg width="10" height="20" viewBox="0 0 10 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.17476 6.87981V4.40638C6.17476 3.72371 6.71803 3.16967 7.38742 3.16967H8.60009V0.0778809H6.17476C4.16538 0.0778809 2.53677 1.73879 2.53677 3.78802V6.87981H0.11145V9.97159H2.53677V19.8653H6.17476V9.97159H8.60009L9.81275 6.87981H6.17476Z" fill="white"></path>
                            </svg>
                        </a>
                        <a href="#">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.3496 5.89545C19.3042 4.84407 19.1374 4.12125 18.8986 3.49492C18.6522 2.83009 18.2732 2.23486 17.7766 1.74004C17.2914 1.23753 16.7039 0.847054 16.0596 0.599723C15.4419 0.356167 14.7368 0.186145 13.7059 0.139789C12.6672 0.0895075 12.3375 0.0778809 9.70323 0.0778809C7.06896 0.0778809 6.73923 0.0895075 5.70444 0.135863C4.6735 0.182219 3.96474 0.352392 3.35074 0.595797C2.69868 0.847055 2.11503 1.2336 1.62984 1.74004C1.1371 2.23486 0.754363 2.83401 0.511694 3.49115C0.272874 4.12125 0.106159 4.84014 0.0607044 5.89153C0.0114006 6.95077 0 7.28703 0 9.97355C0 12.6601 0.0114006 12.9963 0.0568549 14.0517C0.102309 15.103 0.269172 15.8259 0.507992 16.4522C0.754363 17.117 1.1371 17.7122 1.62984 18.2071C2.11503 18.7096 2.70253 19.1001 3.34689 19.3474C3.96474 19.5909 4.66965 19.761 5.70074 19.8073C6.73538 19.8538 7.06525 19.8653 9.69953 19.8653C12.3338 19.8653 12.6635 19.8538 13.6983 19.8073C14.7293 19.761 15.438 19.5909 16.052 19.3474C17.356 18.8332 18.3869 17.7819 18.8911 16.4522C19.1297 15.8221 19.2966 15.103 19.3421 14.0517C19.3875 12.9963 19.3989 12.6601 19.3989 9.97355C19.3989 7.28703 19.3951 6.95077 19.3496 5.89545ZM17.6024 13.9743C17.5606 14.9407 17.4014 15.4626 17.2688 15.8105C16.9428 16.6725 16.2719 17.3567 15.4266 17.6891C15.0855 17.8244 14.5701 17.9868 13.6262 18.0292C12.6028 18.0757 12.2959 18.0872 9.70708 18.0872C7.11826 18.0872 6.80748 18.0757 5.7878 18.0292C4.84022 17.9868 4.32852 17.8244 3.98739 17.6891C3.56676 17.5306 3.18387 17.2793 2.8731 16.9508C2.55092 16.6299 2.30455 16.2434 2.14908 15.8144C2.01642 15.4665 1.85726 14.9407 1.81565 13.9783C1.77005 12.9346 1.7588 12.6214 1.7588 9.98126C1.7588 7.34109 1.77005 7.02415 1.81565 5.98439C1.85726 5.01802 2.01642 4.49617 2.14908 4.14828C2.30455 3.71915 2.55092 3.32882 2.87695 3.01173C3.19142 2.68317 3.57046 2.43191 3.99124 2.27351C4.33237 2.13822 4.84791 1.9759 5.79165 1.93332C6.81503 1.88696 7.12211 1.87534 9.71078 1.87534C12.3035 1.87534 12.6104 1.88696 13.6301 1.93332C14.5776 1.9759 15.0893 2.13822 15.4305 2.27351C15.8511 2.43191 16.234 2.68317 16.5448 3.01173C16.8669 3.3326 17.1133 3.71915 17.2688 4.14828C17.4014 4.49617 17.5606 5.02179 17.6024 5.98439C17.6478 7.02808 17.6592 7.34109 17.6592 9.98126C17.6592 12.6214 17.6478 12.9307 17.6024 13.9743Z" fill="white"></path>
                                <path d="M9.70339 4.89062C6.9517 4.89062 4.71912 7.16734 4.71912 9.97375C4.71912 12.7802 6.9517 15.0569 9.70339 15.0569C12.4552 15.0569 14.6877 12.7802 14.6877 9.97375C14.6877 7.16734 12.4552 4.89062 9.70339 4.89062ZM9.70339 13.2711C7.91824 13.2711 6.47021 11.7945 6.47021 9.97375C6.47021 8.15304 7.91824 6.67645 9.70339 6.67645C11.4887 6.67645 12.9366 8.15304 12.9366 9.97375C12.9366 11.7945 11.4887 13.2711 9.70339 13.2711Z" fill="white"></path>
                                <path d="M16.0489 4.68936C16.0489 5.34469 15.5278 5.87604 14.8851 5.87604C14.2425 5.87604 13.7214 5.34469 13.7214 4.68936C13.7214 4.03389 14.2425 3.50269 14.8851 3.50269C15.5278 3.50269 16.0489 4.03389 16.0489 4.68936Z" fill="white"></path>
                            </svg>
                        </a>
                        <a href="#">
                            <svg id="Capa_1" enable-background="new 0 0 512 512" height="21" viewBox="0 0 512 512" width="21" fill="#fff" xmlns="http://www.w3.org/2000/svg"><g><path d="m480.32 128.39c-29.22 0-56.18-9.68-77.83-26.01-24.83-18.72-42.67-46.18-48.97-77.83-1.56-7.82-2.4-15.89-2.48-24.16h-83.47v228.08l-.1 124.93c0 33.4-21.75 61.72-51.9 71.68-8.75 2.89-18.2 4.26-28.04 3.72-12.56-.69-24.33-4.48-34.56-10.6-21.77-13.02-36.53-36.64-36.93-63.66-.63-42.23 33.51-76.66 75.71-76.66 8.33 0 16.33 1.36 23.82 3.83v-62.34-22.41c-7.9-1.17-15.94-1.78-24.07-1.78-46.19 0-89.39 19.2-120.27 53.79-23.34 26.14-37.34 59.49-39.5 94.46-2.83 45.94 13.98 89.61 46.58 121.83 4.79 4.73 9.82 9.12 15.08 13.17 27.95 21.51 62.12 33.17 98.11 33.17 8.13 0 16.17-.6 24.07-1.77 33.62-4.98 64.64-20.37 89.12-44.57 30.08-29.73 46.7-69.2 46.88-111.21l-.43-186.56c14.35 11.07 30.04 20.23 46.88 27.34 26.19 11.05 53.96 16.65 82.54 16.64v-60.61-22.49c.02.02-.22.02-.24.02z"></path></g></svg>
                        </a>
                        <a href="#">
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.51953 0C1.86268 0 0.519531 1.34314 0.519531 3V17.4805C0.519531 19.1374 1.86268 20.4805 3.51953 20.4805H18.0001C19.6569 20.4805 21.0001 19.1374 21.0001 17.4805V3C21.0001 1.34315 19.6569 0 18.0001 0H3.51953ZM11.1325 8.84267C10.9091 8.88766 10.7729 9.051 10.6422 9.22553C9.96121 8.61176 9.20938 8.57237 8.46857 9.0284C7.57515 9.56901 7.24285 10.4474 7.35726 11.4778C7.46616 12.4295 7.86383 13.2122 8.83366 13.5387C9.4383 13.7415 9.99942 13.6682 10.4952 13.2515C10.6259 13.1446 10.664 13.1671 10.7567 13.2853C10.9365 13.5274 11.247 13.6119 11.5193 13.505C11.7863 13.4205 11.9715 13.1615 11.9715 12.8687C11.9824 11.7426 11.9878 10.6164 11.9715 9.49024C11.9659 9.0398 11.5628 8.75261 11.1325 8.84267ZM8.94245 11.9621C8.80077 11.765 8.72456 11.5285 8.71363 11.2808C8.70822 10.4869 9.12766 10.0082 9.72698 10.0476C9.98297 10.0533 10.2227 10.1828 10.3752 10.4024C10.6803 10.8303 10.6803 11.5342 10.3752 11.9621C10.3208 12.0353 10.2608 12.0973 10.1954 12.148C9.79777 12.452 9.23665 12.3676 8.94245 11.9621ZM16.6019 8.74691C15.2944 8.78629 14.3738 9.86739 14.4174 11.3146C14.3955 12.7222 15.5233 13.7865 16.9451 13.6401C18.2471 13.505 19.0915 12.497 19.0479 11.0725C19.0043 9.66477 17.991 8.70182 16.6019 8.74691ZM16.0189 11.9677C15.8555 11.7369 15.7737 11.4609 15.7847 11.1794C15.7847 10.4756 16.1987 10.0138 16.7871 10.0476C17.0431 10.0533 17.2828 10.1885 17.4353 10.4024C17.7459 10.8303 17.7459 11.5511 17.4299 11.979C17.3809 12.0353 17.3319 12.0916 17.2719 12.1367C16.8796 12.4519 16.3185 12.3732 16.0189 11.9677ZM13.9392 11.0668C13.9386 10.7758 13.938 10.4849 13.938 10.194C13.938 9.9 13.9386 9.60539 13.9392 9.31058V9.30995V9.30931V9.30924V9.30917C13.9404 8.72357 13.9416 8.13715 13.9381 7.55315C13.9381 7.10271 13.6602 6.82122 13.2462 6.82682C12.843 6.82682 12.5761 7.10841 12.5707 7.54195C12.5671 7.71815 12.5683 7.89191 12.5695 8.06648L12.5695 8.0667C12.5701 8.15421 12.5707 8.24193 12.5707 8.33026V12.8067C12.5707 13.1614 12.7777 13.4599 13.0501 13.533C13.1155 13.5499 13.1862 13.5555 13.2516 13.5555C13.6384 13.5443 13.9434 13.2121 13.938 12.8123C13.9416 12.2305 13.9404 11.6486 13.9392 11.0668ZM5.14216 12.1861H5.14176H5.14135C4.873 12.1867 4.60073 12.1873 4.32285 12.1873C4.41008 12.0635 4.46453 11.9902 4.52449 11.917C5.23813 10.988 5.95176 10.0532 6.66539 9.11287C6.87245 8.83697 7.07941 8.56108 7.21017 8.24009C7.35726 7.86843 7.19924 7.51376 6.82883 7.38421C6.65998 7.33912 6.49112 7.31663 6.31675 7.32223C5.34702 7.31663 4.37198 7.31663 3.40226 7.32223C3.26609 7.32223 3.12992 7.33912 2.99917 7.37291C2.79221 7.42359 2.62876 7.59813 2.57973 7.81215C2.50894 8.12743 2.69955 8.44842 3.0101 8.52159C3.14085 8.54978 3.27702 8.56667 3.41319 8.56667C3.70738 8.56947 4.00291 8.56947 4.29843 8.56947C4.59396 8.56947 4.88948 8.56947 5.18368 8.57227C5.20089 8.57374 5.21886 8.5717 5.23698 8.56965C5.28772 8.56389 5.3397 8.55799 5.37981 8.62855C5.33078 8.69053 5.28174 8.7581 5.23271 8.82568C4.38833 9.92937 3.54394 11.0387 2.70497 12.1423C2.49791 12.4183 2.38901 12.7222 2.54153 13.0601C2.69404 13.398 3.00458 13.4656 3.32054 13.4825C3.50311 13.4945 3.68297 13.4922 3.86399 13.4899L3.8641 13.4899C3.93687 13.489 4.00981 13.4881 4.0832 13.4881C4.30461 13.4881 4.52568 13.4884 4.74657 13.4888L4.7478 13.4888H4.74812H4.74825C5.40731 13.4899 6.06481 13.4909 6.72535 13.4825C7.19382 13.4768 7.4444 13.1784 7.39537 12.7335C7.35175 12.3788 7.11751 12.1929 6.68715 12.1873C6.17881 12.1836 5.66815 12.1848 5.14247 12.1861H5.14216Z" fill="white"></path>
                            </svg>
                        </a>
                    </div>
                    <p>Hệ thống cửa hàng</p>
                    <img src="/images/cong-chung.webp" class="w-32 mt-2">
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center border-t border-gray-700 mt-6 pt-4 text-gray-400 text-sm">
                Copyright © thegioiskinfood 2025 - All rights reserved
            </div>
        </div>
    </footer>


    @stack('scripts')
</body>

</html>
