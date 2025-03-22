@extends('layouts.app')

@section('title', $category->ten_danh_muc)

@section('content')
<div class="bg-white">
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-12 gap-4">
            <!-- Bộ lọc bên trái -->
            <div class="col-span-3 bg-white p-4 rounded-lg shadow">
                <h2 class="text-xl font-bold">Danh mục</h2>
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $category->ten_danh_muc }}</h1>
                <!-- Từ khóa -->
                <div class="mt-4">
                    <h3 class="font-semibold">TỪ KHÓA</h3>
                    <div class="space-y-2">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4">
                            <span>Dưỡng ẩm</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4">
                            <span>Giảm mụn</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4">
                            <span>Dưỡng trắng</span>
                        </label>
                    </div>
                </div>

                <!-- Giá -->
                <div class="mt-4">
                    <h3 class="font-semibold">GIÁ</h3>
                    <div class="flex space-x-2">
                        <input type="number" class="w-20 border p-1 rounded" placeholder="0">
                        <span>-</span>
                        <input type="number" class="w-20 border p-1 rounded" placeholder="100,000,000">
                    </div>
                    <button class="mt-2 w-full bg-red-600 text-white py-2 rounded">Áp dụng</button>
                </div>

                <!-- Thương hiệu (Có thanh cuộn) -->
                <div class="mt-4">
                    <h3 class="font-semibold">THƯƠNG HIỆU</h3>
                    <div class="h-32 overflow-y-auto border rounded p-2 space-y-2">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4">
                            <span>L'Oreal</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4">
                            <span>Maybelline</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4">
                            <span>Innisfree</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4">
                            <span>3CE</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4">
                            <span>MAC</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Nội dung chính bên phải -->
            <div class="col-span-9">
                <!-- Banner -->
                <div class=" p-6 rounded-lg shadow">
                    <img src="/images/banner1.webp" class="w-full h-auto rounded-lg">
                </div>

                <!-- Thanh điều hướng -->
                <div class="flex justify-between mt-4 border-b pb-2">
                    <button class="text-red-600 font-bold">Phổ biến</button>
                    <button>Mới nhất</button>
                    <button>Bán chạy</button>
                    <button>Giá thấp</button>
                    <button>Giá cao</button>
                </div>

                <!-- Danh sách sản phẩm -->
                @if($products->isEmpty())
                <div class="mt-6 text-center">
                    <p class="text-gray-500">Không có sản phẩm nào trong danh mục này.</p>
                </div>
            @else
                <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach($products as $product)
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

                @if($products->hasPages())
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @endif
            @endif
            </div>
        </div>
    </div>

</div>
@endsection
