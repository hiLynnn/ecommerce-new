@extends('admin.layouts.app')

@section('title', 'Chi tiết sản phẩm')

@section('header', 'Chi tiết sản phẩm')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold mb-4">Thông tin cơ bản</h3>
            <div class="space-y-4">
                <div>
                    <label class="font-medium">Tên sản phẩm:</label>
                    <p>{{ $sanPham->ten_san_pham }}</p>
                </div>
                <div>
                    <label class="font-medium">Danh mục:</label>
                    <p>{{ $sanPham->danhMuc->ten_danh_muc }}</p>
                </div>
                <div>
                    <label class="font-medium">Giá:</label>
                    <p>{{ number_format($sanPham->gia) }}đ</p>
                </div>
                <div>
                    <label class="font-medium">Số lượng:</label>
                    <p>{{ $sanPham->so_luong }}</p>
                </div>
                <div>
                    <label class="font-medium">Trạng thái:</label>
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
                </div>
                <div>
                    <label class="font-medium">Mô tả:</label>
                    <p class="whitespace-pre-line">{{ $sanPham->mo_ta }}</p>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-4">Hình ảnh</h3>
            <div class="space-y-4">
                <div>
                    <label class="font-medium">Ảnh đại diện:</label>
                    <img src="{{ Storage::url($sanPham->anh_dai_dien) }}" alt="{{ $sanPham->ten_san_pham }}" 
                        class="mt-2 w-full h-64 object-cover rounded">
                </div>

                @if($sanPham->anhPhu->count() > 0)
                <div>
                    <label class="font-medium">Ảnh phụ:</label>
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        @foreach($sanPham->anhPhu as $anhPhu)
                        <img src="{{ Storage::url($anhPhu->duong_dan) }}" alt="{{ $sanPham->ten_san_pham }}" 
                            class="w-full h-32 object-cover rounded">
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-2 mt-6">
        <a href="{{ route('admin.san-pham.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
        <a href="{{ route('admin.san-pham.edit', $sanPham->id) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Sửa sản phẩm
        </a>
    </div>
</div>
@endsection 