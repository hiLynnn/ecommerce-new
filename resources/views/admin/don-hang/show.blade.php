@extends('admin.layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $donHang->id)

@section('header', 'Chi tiết đơn hàng #' . $donHang->id)

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <!-- Header -->
        <div class="py-4 px-4 sm:px-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-medium text-gray-900">Chi tiết đơn hàng #{{ $donHang->id }}</h2>
                <a href="{{ route('admin.don-hang.index') }}" 
                   class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Quay lại
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mx-4 mt-4 px-4 py-2 bg-green-50 border border-green-200 rounded-md">
                <p class="text-sm text-green-600">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-4 mt-4 px-4 py-2 bg-red-50 border border-red-200 rounded-md">
                <p class="text-sm text-red-600">{{ session('error') }}</p>
            </div>
        @endif

        <div class="p-4 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Thông tin đơn hàng -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-base font-medium text-gray-900 mb-4">Thông tin đơn hàng</h3>
                    <dl class="space-y-3">
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Ngày đặt:</dt>
                            <dd class="text-sm text-gray-900">{{ $donHang->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Trạng thái:</dt>
                            <dd>
                                @if($donHang->trang_thai === 'da_huy')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Đã hủy
                                    </span>
                                @else
                                    <form action="{{ route('admin.don-hang.update-trang-thai', $donHang->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="trang_thai" 
                                            class="block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @switch($donHang->trang_thai)
                                                @case('cho_xac_nhan') bg-yellow-50 text-yellow-700 @break
                                                @case('da_xac_nhan') bg-blue-50 text-blue-700 @break
                                                @case('dang_giao') bg-indigo-50 text-indigo-700 @break
                                                @case('da_giao') bg-green-50 text-green-700 @break
                                            @endswitch"
                                            onchange="this.form.submit()">
                                            <option value="cho_xac_nhan" {{ $donHang->trang_thai === 'cho_xac_nhan' ? 'selected' : '' }}>
                                                Chờ xác nhận
                                            </option>
                                            <option value="da_xac_nhan" {{ $donHang->trang_thai === 'da_xac_nhan' ? 'selected' : '' }}>
                                                Đã xác nhận
                                            </option>
                                            <option value="dang_giao" {{ $donHang->trang_thai === 'dang_giao' ? 'selected' : '' }}>
                                                Đang giao
                                            </option>
                                            <option value="da_giao" {{ $donHang->trang_thai === 'da_giao' ? 'selected' : '' }}>
                                                Đã giao
                                            </option>
                                            <option value="da_huy" {{ $donHang->trang_thai === 'da_huy' ? 'selected' : '' }}>
                                                Hủy đơn
                                            </option>
                                        </select>
                                    </form>
                                @endif
                            </dd>
                        </div>
                        <div class="pt-2 border-t border-gray-200">
                            <dt class="text-sm font-medium text-gray-500">Tổng tiền:</dt>
                            <dd class="text-2xl font-bold text-green-600">{{ number_format($donHang->tong_tien) }}đ</dd>
                        </div>
                        @if($donHang->ghi_chu)
                        <div class="pt-2 border-t border-gray-200">
                            <dt class="text-sm font-medium text-gray-500 mb-1">Ghi chú:</dt>
                            <dd class="text-sm text-gray-900 bg-white rounded p-2 border border-gray-200">
                                {{ $donHang->ghi_chu }}
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>

                <!-- Thông tin khách hàng -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-base font-medium text-gray-900 mb-4">Thông tin khách hàng</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tên khách hàng:</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $donHang->nguoiDung->ten }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email:</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $donHang->nguoiDung->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Số điện thoại:</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $donHang->so_dien_thoai }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Địa chỉ giao hàng:</dt>
                            <dd class="mt-1 text-sm text-gray-900 bg-white rounded p-2 border border-gray-200">
                                {{ $donHang->dia_chi_giao }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Chi tiết sản phẩm -->
            <div class="mt-6">
                <h3 class="text-base font-medium text-gray-900 mb-4">Chi tiết sản phẩm</h3>
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sản phẩm</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Đơn giá</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Số lượng</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($donHang->chiTietDonHang as $chiTiet)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <img src="{{ Storage::url($chiTiet->sanPham->anh_dai_dien) }}" 
                                            alt="{{ $chiTiet->sanPham->ten_san_pham }}"
                                            class="h-16 w-16 object-cover rounded">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $chiTiet->sanPham->ten_san_pham }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-right text-sm text-gray-600">
                                    {{ number_format($chiTiet->don_gia) }}đ
                                </td>
                                <td class="px-4 py-3 text-right text-sm text-gray-600">
                                    {{ $chiTiet->so_luong }}
                                </td>
                                <td class="px-4 py-3 text-right text-sm font-medium text-gray-900">
                                    {{ number_format($chiTiet->thanh_tien) }}đ
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-right text-sm font-medium text-gray-900">Tổng cộng:</td>
                                <td class="px-4 py-3 text-right text-lg font-bold text-green-600">
                                    {{ number_format($donHang->tong_tien) }}đ
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 