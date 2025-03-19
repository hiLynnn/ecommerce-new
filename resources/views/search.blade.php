@extends('layouts.app')

@section('title', 'Tìm kiếm: ' . $query)

@section('content')
<div class="bg-white">
    <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">
            Kết quả tìm kiếm cho "{{ $query }}"
        </h1>

        @if($products->isEmpty())
            <div class="mt-6 text-center">
                <p class="text-gray-500">Không tìm thấy sản phẩm nào phù hợp.</p>
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-500">
                        Quay lại trang chủ
                        <span aria-hidden="true"> &rarr;</span>
                    </a>
                </div>
            </div>
        @else
            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($products as $product)
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

            @if($products->hasPages())
                <div class="mt-8">
                    {{ $products->appends(['q' => $query])->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection 