@extends('layouts.app')

@section('title', 'Đặt hàng')

@section('content')
<div class="bg-white">
    <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Đặt hàng</h1>

        @if(app('cart')->count() == 0)
            <div class="mt-6 text-center">
                <p class="text-gray-500">Giỏ hàng của bạn đang trống.</p>
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-500">
                        Tiếp tục mua sắm
                        <span aria-hidden="true"> &rarr;</span>
                    </a>
                </div>
            </div>
        @else
            <form action="{{ route('orders.store') }}" method="POST" class="mt-12">
                @csrf

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <h2 class="text-lg font-medium text-gray-900">Thông tin giao hàng</h2>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="dia_chi_giao" class="block text-sm font-medium text-gray-700">
                            Địa chỉ giao hàng
                        </label>
                        <div class="mt-1">
                            <input type="text" 
                                   name="dia_chi_giao" 
                                   id="dia_chi_giao" 
                                   value="{{ old('dia_chi_giao', auth()->user()->dia_chi) }}"
                                   class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('dia_chi_giao')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <label for="so_dien_thoai" class="block text-sm font-medium text-gray-700">
                            Số điện thoại
                        </label>
                        <div class="mt-1">
                            <input type="text" 
                                   name="so_dien_thoai" 
                                   id="so_dien_thoai" 
                                   value="{{ old('so_dien_thoai', auth()->user()->so_dien_thoai) }}"
                                   class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('so_dien_thoai')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-6">
                        <label for="ghi_chu" class="block text-sm font-medium text-gray-700">
                            Ghi chú
                        </label>
                        <div class="mt-1">
                            <textarea name="ghi_chu" 
                                      id="ghi_chu" 
                                      rows="3"
                                      class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border border-gray-300 rounded-md">{{ old('ghi_chu') }}</textarea>
                        </div>
                        @error('ghi_chu')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-10">
                    <h2 class="text-lg font-medium text-gray-900">Đơn hàng của bạn</h2>

                    <div class="mt-4">
                        <div class="flow-root">
                            <ul role="list" class="-my-6 divide-y divide-gray-200">
                                @foreach(app('cart')->content() as $item)
                                    <li class="py-6 flex">
                                        <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                                            <img src="{{ Storage::url($item['image']) }}" 
                                                 alt="{{ $item['name'] }}" 
                                                 class="w-full h-full object-center object-cover">
                                        </div>

                                        <div class="ml-4 flex-1 flex flex-col">
                                            <div>
                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <h3>{{ $item['name'] }}</h3>
                                                    <p class="ml-4">{{ number_format($item['price'] * $item['quantity']) }}đ</p>
                                                </div>
                                            </div>
                                            <div class="flex-1 flex items-end justify-between text-sm">
                                                <p class="text-gray-500">Số lượng: {{ $item['quantity'] }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 py-6">
                        <div class="flex justify-between text-base font-medium text-gray-900">
                            <p>Tổng tiền</p>
                            <p>{{ number_format(app('cart')->total()) }}đ</p>
                        </div>
                        <p class="mt-0.5 text-sm text-gray-500">Phí vận chuyển sẽ được tính sau.</p>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700">
                            Đặt hàng
                        </button>
                    </div>

                    <div class="mt-6 flex justify-center text-sm text-center text-gray-500">
                        <p>
                            hoặc
                            <a href="{{ route('cart') }}" class="text-blue-600 font-medium hover:text-blue-500">
                                Quay lại giỏ hàng
                                <span aria-hidden="true"> &rarr;</span>
                            </a>
                        </p>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection 