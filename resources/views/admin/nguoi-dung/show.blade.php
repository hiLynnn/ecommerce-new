@extends('admin.layouts.app')

@section('title', 'Chi tiết người dùng')

@section('header', 'Chi tiết người dùng')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold mb-4">Thông tin cơ bản</h3>
            <div class="space-y-4">
                <div>
                    <label class="font-medium">Tên:</label>
                    <p>{{ $nguoiDung->ten }}</p>
                </div>
                <div>
                    <label class="font-medium">Email:</label>
                    <p>{{ $nguoiDung->email }}</p>
                </div>
                <div>
                    <label class="font-medium">Số điện thoại:</label>
                    <p>{{ $nguoiDung->so_dien_thoai }}</p>
                </div>
                <div>
                    <label class="font-medium">Địa chỉ:</label>
                    <p>{{ $nguoiDung->dia_chi }}</p>
                </div>
                <div>
                    <label class="font-medium">Vai trò:</label>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $nguoiDung->vai_tro === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                        {{ $nguoiDung->vai_tro === 'admin' ? 'Quản trị viên' : 'Người dùng' }}
                    </span>
                </div>
                <div>
                    <label class="font-medium">Ngày tạo:</label>
                    <p>{{ $nguoiDung->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
                <div>
                    <label class="font-medium">Cập nhật lần cuối:</label>
                    <p>{{ $nguoiDung->updated_at->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-4">Thống kê đơn hàng</h3>
            <div class="space-y-4">
                <div>
                    <label class="font-medium">Tổng số đơn hàng:</label>
                    <p>{{ $nguoiDung->donHangs->count() }}</p>
                </div>
                @if($nguoiDung->donHangs->count() > 0)
                <div>
                    <label class="font-medium">Đơn hàng gần nhất:</label>
                    <div class="mt-2">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Mã đơn</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Ngày đặt</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Tổng tiền</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($nguoiDung->donHangs->sortByDesc('created_at')->take(5) as $donHang)
                                <tr>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm">#{{ $donHang->id }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm">{{ $donHang->created_at->format('d/m/Y') }}</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm">{{ number_format($donHang->tong_tien) }}đ</td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @switch($donHang->trang_thai)
                                                @case('cho_xac_nhan')
                                                    bg-yellow-100 text-yellow-800
                                                    @break
                                                @case('da_xac_nhan')
                                                    bg-blue-100 text-blue-800
                                                    @break
                                                @case('dang_giao')
                                                    bg-indigo-100 text-indigo-800
                                                    @break
                                                @case('da_giao')
                                                    bg-green-100 text-green-800
                                                    @break
                                                @case('da_huy')
                                                    bg-red-100 text-red-800
                                                    @break
                                            @endswitch
                                        ">
                                            @switch($donHang->trang_thai)
                                                @case('cho_xac_nhan')
                                                    Chờ xác nhận
                                                    @break
                                                @case('da_xac_nhan')
                                                    Đã xác nhận
                                                    @break
                                                @case('dang_giao')
                                                    Đang giao
                                                    @break
                                                @case('da_giao')
                                                    Đã giao
                                                    @break
                                                @case('da_huy')
                                                    Đã hủy
                                                    @break
                                            @endswitch
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-2 mt-6">
        <a href="{{ route('admin.nguoi-dung.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
        <a href="{{ route('admin.nguoi-dung.edit', $nguoiDung->id) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Sửa người dùng
        </a>
    </div>
</div>
@endsection 