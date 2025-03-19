@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('header', 'Quản lý sản phẩm')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold">Danh sách sản phẩm</h3>
        <a href="{{ route('admin.san-pham.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm sản phẩm
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ảnh</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên sản phẩm</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Danh mục</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($sanPhams as $sanPham)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sanPham->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ Storage::url($sanPham->anh_dai_dien) }}" alt="{{ $sanPham->ten_san_pham }}" 
                            class="h-12 w-12 object-cover rounded">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sanPham->ten_san_pham }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sanPham->danhMuc->ten_danh_muc }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($sanPham->gia) }}đ</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $sanPham->so_luong }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col space-y-1">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $sanPham->hien_thi ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $sanPham->hien_thi ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                            @if($sanPham->noi_bat)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Nổi bật
                            </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('admin.san-pham.show', $sanPham->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-eye"></i> Xem
                        </a>
                        <a href="{{ route('admin.san-pham.edit', $sanPham->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <form action="{{ route('admin.san-pham.destroy', $sanPham->id) }}" method="POST" class="inline">
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
        {{ $sanPhams->links() }}
    </div>
</div>
@endsection 