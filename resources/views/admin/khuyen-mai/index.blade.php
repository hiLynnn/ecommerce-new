@extends('admin.layouts.app')

@section('title', 'Quản lý mã giảm giá')

@section('header', 'Danh sách mã giảm giá')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold">Danh sách mã giảm giá</h3>
            <div>
                <a href="{{route('admin.khuyen-mai.create') }}" class="btn btn-primary mr-2">
                    <i class="fas fa-plus"></i> Thêm mã
                </a>
            </div>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('message'))
            <div class="alert alert-danger">{{ Session::get('message') }}</div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tên mã</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bắt đầu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kết thúc</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mã</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Số lượng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Điều kiện</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mức giảm</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hành động</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $coupon->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $coupon->promotions_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $coupon->promotionsdate_start }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $coupon->promotionsdate_end }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $coupon->promotions_code }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $coupon->promotions_times }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs font-semibold rounded-full
                                    {{ $coupon->promotions_condition == 1 ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $coupon->promotions_condition == 1 ? 'Phần trăm' : 'Tiền mặt' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $coupon->promotions_condition == 1 ? $coupon->promotions_number.'%' : number_format($coupon->promotions_number).' VNĐ' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs font-semibold rounded-full
                                    {{ $coupon->promotionsdate_end >= $today ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $coupon->promotionsdate_end >= $today ? 'Còn hạn' : 'Hết hạn' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <form action="{{ route('admin.khuyen-mai.destroy', $coupon->id ) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $coupons->links() }}
        </div>
    </div>
@endsection
