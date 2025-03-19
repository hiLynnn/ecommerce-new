@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="px-4 py-6 sm:px-6">
        <h1 class="text-2xl font-semibold text-gray-900">Giỏ hàng</h1>
    </div>

    @if(app('cart')->count() > 0)
        <div class="border-t border-gray-200">
            <ul role="list" class="divide-y divide-gray-200">
                @foreach(app('cart')->content() as $item)
                    <li class="flex py-6 px-4 sm:px-6">
                        <div class="flex-shrink-0">
                            <img src="{{ Storage::url($item['image']) }}" 
                                 alt="{{ $item['name'] }}" 
                                 class="w-24 h-24 rounded-md object-center object-cover sm:w-32 sm:h-32">
                        </div>

                        <div class="ml-6 flex-1 flex flex-col">
                            <div class="flex">
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm">
                                        <a href="{{ route('products.show', $item['slug']) }}" class="font-medium text-gray-700 hover:text-gray-800">
                                            {{ $item['name'] }}
                                        </a>
                                    </h4>
                                </div>

                                <div class="ml-4 flex-shrink-0">
                                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-500">
                                            Xóa
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="mt-4 flex-1 flex items-end justify-between">
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PUT')
                                    <label for="quantity-{{ $item['id'] }}" class="sr-only">Số lượng</label>
                                    <select id="quantity-{{ $item['id'] }}" 
                                            name="quantity" 
                                            class="max-w-full rounded-md border border-gray-300 py-1.5 text-base leading-5 font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            onchange="this.form.submit()">
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </form>

                                <div class="ml-4">
                                    <span class="text-sm font-medium text-gray-900">{{ number_format($item['price'] * $item['quantity']) }}đ</span>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
            <div class="flex justify-between text-base font-medium text-gray-900">
                <p>Tổng tiền</p>
                <p>{{ number_format(app('cart')->total()) }}đ</p>
            </div>
            <p class="mt-0.5 text-sm text-gray-500">Phí vận chuyển sẽ được tính ở bước tiếp theo.</p>
            <div class="mt-6">
                <a href="{{ route('orders.create') }}" class="flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700">
                    Tiến hành đặt hàng
                </a>
            </div>
            <div class="mt-6 flex justify-center text-sm text-center text-gray-500">
                <p>
                    hoặc
                    <a href="{{ route('home') }}" class="text-blue-600 font-medium hover:text-blue-500">
                        Tiếp tục mua sắm
                        <span aria-hidden="true"> &rarr;</span>
                    </a>
                </p>
            </div>
        </div>
    @else
        <div class="px-4 py-6 sm:px-6 text-center">
            <p class="text-gray-500">Giỏ hàng của bạn đang trống.</p>
            <div class="mt-6">
                <a href="{{ route('home') }}" class="text-blue-600 font-medium hover:text-blue-500">
                    Tiếp tục mua sắm
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        </div>
    @endif
</div>
@endsection 