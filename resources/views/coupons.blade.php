@extends('layouts.app')

@section('title', 'Tất cả khuyến mãi')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-red-600 mb-6">Tất cả Khuyến Mãi</h1>

    @if($coupons->isEmpty())
        <p class="text-gray-600">Hiện tại không có khuyến mãi nào.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($coupons as $coupon)
                <div class="bg-red-50 shadow-md rounded-lg p-4 border border-gray-200 relative">
                    <!-- Icon/logo -->
                    <div class="w-12 h-12 flex-shrink-0 mb-3">
                        <img src="/images/logo.webp" alt="Logo" class="w-full h-full rounded-full">
                    </div>
                    <!-- Nội dung -->
                    <p class="text-lg font-bold text-red-600">Giảm {{ number_format($coupon->promotions_number) }}K</p>
                    <p class="text-sm text-gray-600">Đơn hàng từ {{ number_format($coupon->promotions_condition) }}K</p>
                    <p class="text-xs text-gray-500">Áp dụng cho tất cả sản phẩm</p>
                    <button class="bg-red-600 text-white text-sm px-3 py-1 rounded mt-3 copy-btn" data-code="{{ $coupon->promotions_code }}">Lưu</button>
                    <span class="absolute top-2 right-3 text-gray-500 text-xs">HSD: {{ date('d/m/Y', strtotime($coupon->promotionsdate_end)) }}</span>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".copy-btn");

        buttons.forEach(button => {
            button.addEventListener("click", function () {
                const couponCode = this.getAttribute("data-code");
                navigator.clipboard.writeText(couponCode);
                alert("Mã khuyến mãi của bạn: " + couponCode);
            });
        });
    });
</script>
@endsection
