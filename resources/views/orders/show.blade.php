@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->id)

@section('content')
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-4 py-6 sm:px-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-900">
                    Chi tiết đơn hàng #{{ $order->id }}
                </h1>
                <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                @if ($order->trang_thai == 'cho_xac_nhan') bg-yellow-100 text-yellow-800
                @elseif($order->trang_thai == 'da_xac_nhan') bg-blue-100 text-blue-800
                @elseif($order->trang_thai == 'dang_giao') bg-indigo-100 text-indigo-800
                @elseif($order->trang_thai == 'da_giao') bg-green-100 text-green-800
                @else bg-red-100 text-red-800 @endif">
                    @if ($order->trang_thai == 'cho_xac_nhan')
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
            </div>
        </div>

        <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Ngày đặt hàng</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Số điện thoại</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $order->so_dien_thoai }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Địa chỉ giao hàng</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $order->dia_chi_giao }}</dd>
                </div>

                @if ($order->ghi_chu)
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Ghi chú</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $order->ghi_chu }}</dd>
                    </div>
                @endif
            </dl>
        </div>

        <div class="border-t border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sản phẩm
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Giá
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Số lượng
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Thành tiền
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($order->chiTietDonHang as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-md object-center object-cover"
                                                src="{{ Storage::url($item->sanPham->anh_dai_dien) }}"
                                                alt="{{ $item->sanPham->ten_san_pham }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $item->sanPham->ten_san_pham }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ number_format($item->don_gia) }}đ
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->so_luong }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ number_format($item->don_gia * $item->so_luong) }}đ
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <th scope="row" colspan="3"
                                class="px-6 py-3 text-right text-sm font-semibold text-gray-900">
                                Tổng tiền
                            </th>
                            <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($order->tong_tien) }}đ
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
            <div class="flex justify-between">
                <a href="{{ route('orders') }}" class="text-blue-600 hover:text-blue-500">
                    &larr; Quay lại danh sách đơn hàng
                </a>

                @if ($order->trang_thai == 'cho_xac_nhan')
                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="text-red-600 hover:text-red-500">
                            Hủy đơn hàng
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
