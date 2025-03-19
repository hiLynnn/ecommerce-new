@extends('layouts.app')

@section('title', $product->ten_san_pham)

@section('content')
<div class="bg-white">
    <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
            <!-- Image gallery -->
            <div class="flex flex-col">
                <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                    <img src="{{ Storage::url($product->anh_dai_dien) }}" 
                         alt="{{ $product->ten_san_pham }}" 
                         class="w-full h-full object-center object-cover">
                </div>

                @if($product->anhPhu->count() > 0)
                    <div class="mt-4 grid grid-cols-4 gap-4">
                        @foreach($product->anhPhu as $image)
                            <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                                <img src="{{ Storage::url($image->duong_dan) }}" 
                                     alt="{{ $product->ten_san_pham }}" 
                                     class="w-full h-full object-center object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product info -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->ten_san_pham }}</h1>

                <div class="mt-3">
                    <h2 class="sr-only">Thông tin sản phẩm</h2>
                    <p class="text-3xl text-gray-900">{{ number_format($product->gia) }}đ</p>
                </div>

                <div class="mt-6">
                    <h3 class="sr-only">Mô tả</h3>
                    <div class="text-base text-gray-700 space-y-6">
                        {!! nl2br(e($product->mo_ta)) !!}
                    </div>
                </div>

                <form action="{{ route('cart.add') }}" method="POST" class="mt-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="mt-10 flex sm:flex-col1">
                        <div class="max-w-xs">
                            <label for="quantity" class="sr-only">Số lượng</label>
                            <select id="quantity" 
                                    name="quantity" 
                                    class="rounded-md border border-gray-300 py-1.5 text-base leading-5 font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit" 
                                class="ml-4 flex-1 bg-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Thêm vào giỏ hàng
                        </button>
                    </div>
                </form>

                <section class="mt-12">
                    <h3 class="text-sm font-medium text-gray-900">Danh mục</h3>
                    <div class="mt-4">
                        <a href="{{ route('category', $product->danhMuc->slug) }}" 
                           class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $product->danhMuc->ten_danh_muc }}
                        </a>
                    </div>
                </section>
            </div>
        </div>

        @if($relatedProducts->count() > 0)
            <section class="mt-16">
                <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Sản phẩm liên quan</h2>

                <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="group relative">
                            <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75">
                                <img src="{{ Storage::url($relatedProduct->anh_dai_dien) }}" 
                                     alt="{{ $relatedProduct->ten_san_pham }}"
                                     class="w-full h-full object-center object-cover">
                            </div>
                            <div class="mt-4 flex justify-between">
                                <div>
                                    <h3 class="text-sm text-gray-700">
                                        <a href="{{ route('products.show', $relatedProduct->id) }}">
                                            {{ $relatedProduct->ten_san_pham }}
                                        </a>
                                    </h3>
                                </div>
                                <p class="text-sm font-medium text-gray-900">{{ number_format($relatedProduct->gia) }}đ</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>
@endsection 