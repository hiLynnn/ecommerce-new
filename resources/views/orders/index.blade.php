@extends('layouts.app')

@section('title', 'Đơn hàng của tôi')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="px-4 py-6 sm:px-6">
        <h1 class="text-2xl font-semibold text-gray-900">Đơn hàng của tôi</h1>
    </div>

    @if($orders->isEmpty())
        <div class="border-t border-gray-200 px-4 py-6 sm:px-6 text-center">
            <p class="text-gray-500">Bạn chưa có đơn hàng nào.</p>
            <div class="mt-6">
                <a href="{{ route('home') }}" class="text-blue-600 font-medium hover:text-blue-500">
                    Tiếp tục mua sắm
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        </div>
    @else
        <div class="border-t border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mã đơn hàng
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ngày đặt
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tổng tiền
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Trạng thái
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Chi tiết</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #{{ $order->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($order->tong_tien) }}đ
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($order->trang_thai == 'cho_xac_nhan') bg-yellow-100 text-yellow-800
                                        @elseif($order->trang_thai == 'da_xac_nhan') bg-blue-100 text-blue-800
                                        @elseif($order->trang_thai == 'dang_giao') bg-indigo-100 text-indigo-800
                                        @elseif($order->trang_thai == 'da_giao') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        @if($order->trang_thai == 'cho_xac_nhan')
                                            Chờ xác nhận
                                        @elseif($order->trang_thai == 'da_xac_nhan')
                                            Đã xác nhận
                                        @elseif($order->trang_thai == 'dang_giao')
                                            Đang giao
                                        @elseif($order->trang_thai == 'da_giao')
                                            Đã giao
                                        @else
                                            Đã hủy
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-900">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if($orders->hasPages())
            <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
                {{ $orders->links() }}
            </div>
        @endif
    @endif
</div>
@endsection 