@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<!-- Banner -->
<div class="grid grid-cols-3 gap-4">
    <!-- Banner lớn có Swiper -->
    <div class="col-span-2">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="/images/banner1.webp" class="w-full h-auto rounded-lg">
                </div>
                <div class="swiper-slide">
                    <img src="/images/banner2.webp" class="w-full h-auto rounded-lg">
                </div>
                <div class="swiper-slide">
                    <img src="/images/banner3.webp" class="w-full h-auto rounded-lg">
                </div>
            </div>
            <!-- Nút điều hướng -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Banner nhỏ bên phải -->
    <div class="flex flex-col gap-4">
        <img src="/images/banner1.webp" class="w-full h-auto rounded-lg">
        <img src="/images/banner2.webp" class="w-full h-auto rounded-lg">
    </div>
</div>

<div class="flex gap-4 mt-8">
    <!-- Coupon 1 -->
    <div class="flex items-center bg-red-50 p-4 rounded-lg shadow relative w-64 border">
        <!-- Icon -->
        <div class="w-12 h-12 flex-shrink-0">
            <img src="/images/logo.webp" alt="Logo" class="w-full h-full rounded-full">
        </div>
        <!-- Nội dung -->
        <div class="ml-3 flex-1">
            <p class="font-bold text-lg">Giảm 25K</p>
            <p class="text-sm text-gray-600">Đơn hàng từ 399K</p>
            <p class="text-xs text-gray-500">Áp dụng cho tất cả sản phẩm</p>
            <button class="bg-red-600 text-white text-sm px-3 py-1 rounded mt-2">Lưu</button>
        </div>
        <!-- Điều kiện -->
        <span class="absolute top-2 right-3 text-gray-500 text-xs">Điều kiện</span>
    </div>

    <!-- Coupon 2 -->
    <div class="flex items-center bg-red-50 p-4 rounded-lg shadow relative w-64 border">
        <!-- Icon -->
        <div class="w-12 h-12 flex-shrink-0">
            <img src="/images/logo.webp" alt="Logo" class="w-full h-full rounded-full">
        </div>
        <!-- Nội dung -->
        <div class="ml-3 flex-1">
            <p class="font-bold text-lg">Giảm 15K</p>
            <p class="text-sm text-gray-600">Đơn hàng từ 299K</p>
            <p class="text-xs text-gray-500">Áp dụng cho tất cả sản phẩm</p>
            <button class="bg-red-600 text-white text-sm px-3 py-1 rounded mt-2">Lưu</button>
        </div>
        <!-- Điều kiện -->
        <span class="absolute top-2 right-3 text-gray-500 text-xs">Điều kiện</span>
    </div>
</div>

<!-- Xem tất cả -->
<div class="mt-3 text-center">
    <a href="#" class="text-red-600 font-semibold uppercase">XEM TẤT CẢ</a>
</div>

<div class="bg-white p-6">
    <!-- Flash Deal Header -->
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-red-600 flex items-center">
            FLASH <span class="text-yellow-500 mx-1">⚡</span> DEAL
        </h2>
        <!-- Countdown -->
        <div class="flex gap-2 text-white font-bold">
            <div id="hours" class="bg-black px-3 py-1 rounded">00</div> :
            <div id="minutes" class="bg-black px-3 py-1 rounded">00</div> :
            <div id="seconds" class="bg-black px-3 py-1 rounded">00</div>
        </div>
        <a href="#" class="text-red-500 font-semibold">XEM TẤT CẢ DEAL +</a>
    </div>

    <!-- Swiper Container -->
    <div class="flash-deal-swiper mt-4">
        <div class="swiper-wrapper">
            <div class="swiper-slide bg-white border rounded-lg shadow p-3">
                <img src="/images/sp1.webp" class="w-full rounded-lg" />
                <h3 class="text-sm font-semibold mt-2">Son Thỏi 3CE Cashmere</h3>
                <p class="text-red-600 font-bold">309,000₫</p>
                <p class="text-gray-400 text-xs line-through">448,000₫</p>
                <p class="text-green-600 text-xs">-31%</p>
            </div>

            <div class="swiper-slide bg-white border rounded-lg shadow p-3">
                <img src="/images/sp2.webp" class="w-full rounded-lg" />
                <h3 class="text-sm font-semibold mt-2">Son Tint Romand</h3>
                <p class="text-red-600 font-bold">179,000₫</p>
                <p class="text-gray-400 text-xs line-through">199,000₫</p>
                <p class="text-green-600 text-xs">-10%</p>
            </div>
        </div>
        <!-- Nút điều hướng -->
        <div class="flash-deal-prev swiper-button-prev"></div>
        <div class="flash-deal-next swiper-button-next"></div>
    </div>
</div>


<!-- Featured Products -->
<div class="mt-12">
    <h2 class="text-2xl font-bold text-gray-900">Sản phẩm nổi bật</h2>
    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        @foreach($featuredProducts as $product)
            <div class="w-full max-w-xs bg-white rounded-lg shadow-md overflow-hidden group">
                <div class="relative">
                    <img src="{{ Storage::url($product->anh_dai_dien) }}"
                        alt="{{ $product->ten_san_pham }}"
                        class="w-full h-56 object-cover transition-opacity duration-300 group-hover:opacity-0">
                    <img src="/images/sp2.webp?text=Hover1"
                        alt="{{ $product->ten_san_pham }} Hover"
                        class="absolute top-0 left-0 w-full h-56 object-cover opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                </div>
                <div class="p-4">
                    <a class="text-sm font-semibold" href="{{ route('products.show', $product->slug) }}">
                        {{ $product->ten_san_pham }}
                    </a>
                    <div class="flex items-center mt-2">
                        <span class="text-red-500 font-bold text-lg">{{ number_format($product->gia * 0.85) }}đ</span>
                        <span class="text-gray-400 text-sm line-through ml-2">{{ number_format($product->gia) }}đ</span>
                        <span class="ml-auto bg-green-500 text-white text-xs px-2 py-1 rounded">-15%</span>
                    </div>
                    <p class="text-gray-500 text-sm mt-1">40,7k đã bán</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- New Products -->
<div class="mt-12">
    <h2 class="text-2xl font-bold text-gray-900">Sản phẩm mới</h2>
    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        @foreach($newProducts as $product)
            <div class="w-full max-w-xs bg-white rounded-lg shadow-md overflow-hidden group">
                <div class="relative">
                    <img src="{{ Storage::url($product->anh_dai_dien) }}"
                        alt="{{ $product->ten_san_pham }}"
                        class="w-full h-56 object-cover transition-opacity duration-300 group-hover:opacity-0">
                    <img src="/images/sp2.webp?text=Hover1"
                        alt="{{ $product->ten_san_pham }} Hover"
                        class="absolute top-0 left-0 w-full h-56 object-cover opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                </div>
                <div class="p-4">
                    <a class="text-sm font-semibold" href="{{ route('products.show', $product->slug) }}">
                        {{ $product->ten_san_pham }}
                    </a>
                    <div class="flex items-center mt-2">
                        <span class="text-red-500 font-bold text-lg">{{ number_format($product->gia * 0.85) }}đ</span>
                        <span class="text-gray-400 text-sm line-through ml-2">{{ number_format($product->gia) }}đ</span>
                        <span class="ml-auto bg-green-500 text-white text-xs px-2 py-1 rounded">-15%</span>
                    </div>
                    <p class="text-gray-500 text-sm mt-1">40,7k đã bán</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Categories -->
<div class="mt-12">
    <h2 class="text-2xl font-bold text-gray-900">Danh mục sản phẩm</h2>
    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
        @foreach($categories as $category)
        <a href="{{ route('category', $category->slug) }}" class="group">
            <div class="w-full aspect-w-3 aspect-h-2 bg-gray-200 rounded-lg overflow-hidden">
                @if($category->anh_dai_dien)
                    <img src="{{ Storage::url($category->anh_dai_dien) }}"
                         alt="{{ $category->ten_danh_muc }}"
                         class="w-full h-full object-center object-cover group-hover:opacity-75">
                @endif
                <div class="flex items-end p-4 bg-gradient-to-t from-black/60">
                    <div>
                        <h3 class="text-lg font-medium text-white">{{ $category->ten_danh_muc }}</h3>
                        <p class="mt-1 text-sm text-gray-300">{{ $category->san_phams_count }} sản phẩm</p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>


<!-- Khởi tạo Swiper -->
<script>
     var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    // === COUNTDOWN TIMER ===
  function startCountdown(duration) {
      let timeLeft = duration;

      function updateCountdown() {
          let hours = Math.floor(timeLeft / 3600);
          let minutes = Math.floor((timeLeft % 3600) / 60);
          let seconds = timeLeft % 60;

          document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
          document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
          document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');

          if (timeLeft > 0) {
              timeLeft--;
          } else {
              clearInterval(timerInterval);
          }
      }

      updateCountdown();
      let timerInterval = setInterval(updateCountdown, 1000);
  }

  // Set thời gian Flash Deal kết thúc sau 2 giờ (7200 giây)
  startCountdown(7200);

  // === SWIPER INITIALIZATION ===
  var flashDealSwiper = new Swiper('.flash-deal-swiper', {
      slidesPerView: 4,
      spaceBetween: 10,
      navigation: {
          nextEl: '.flash-deal-next',
          prevEl: '.flash-deal-prev',
      },
  });
</script>
@endsection
