@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<!-- Banner -->
<div class="relative bg-gray-900 rounded-xl overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/banner.jpg') }}" alt="Banner" class="w-full h-full object-cover opacity-75">
    </div>
    <div class="relative py-24 px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
            Chào mừng đến với {{ config('app.name') }}
        </h1>
        <p class="mt-6 text-xl text-gray-300 max-w-3xl">
            Khám phá hàng ngàn sản phẩm chất lượng với giá cả hợp lý.
        </p>
    </div>
</div>

<!-- Featured Products -->
<div class="mt-12">
    <h2 class="text-2xl font-bold text-gray-900">Sản phẩm nổi bật</h2>
    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        @foreach($featuredProducts as $product)
        <div class="group relative">
            <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75">
                <img src="{{ Storage::url($product->anh_dai_dien) }}" 
                     alt="{{ $product->ten_san_pham }}"
                     class="w-full h-full object-center object-cover">
            </div>
            <div class="mt-4 flex justify-between">
                <div>
                    <h3 class="text-sm text-gray-700">
                        <a href="{{ route('products.show', $product->slug) }}">
                            {{ $product->ten_san_pham }}
                        </a>
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $product->danhMuc->ten_danh_muc }}</p>
                </div>
                <p class="text-sm font-medium text-gray-900">{{ number_format($product->gia) }}đ</p>
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
        <div class="group relative">
            <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75">
                <img src="{{ Storage::url($product->anh_dai_dien) }}" 
                     alt="{{ $product->ten_san_pham }}"
                     class="w-full h-full object-center object-cover">
            </div>
            <div class="mt-4 flex justify-between">
                <div>
                    <h3 class="text-sm text-gray-700">
                        <a href="{{ route('products.show', $product->slug) }}">
                            {{ $product->ten_san_pham }}
                        </a>
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $product->danhMuc->ten_danh_muc }}</p>
                </div>
                <p class="text-sm font-medium text-gray-900">{{ number_format($product->gia) }}đ</p>
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
@endsection 