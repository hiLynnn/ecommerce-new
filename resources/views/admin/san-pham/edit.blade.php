@extends('admin.layouts.app')

@section('title', 'Sửa sản phẩm')

@section('header', 'Sửa sản phẩm')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <form action="{{ route('admin.san-pham.update', $sanPham->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="mb-4">
                    <label for="ten_san_pham" class="form-label required">Tên sản phẩm</label>
                    <input type="text" name="ten_san_pham" id="ten_san_pham" class="form-input @error('ten_san_pham') border-red-500 @enderror" 
                        value="{{ old('ten_san_pham', $sanPham->ten_san_pham) }}" required>
                    @error('ten_san_pham')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="danh_muc_id" class="form-label required">Danh mục</label>
                    <select name="danh_muc_id" id="danh_muc_id" class="form-input @error('danh_muc_id') border-red-500 @enderror" required>
                        <option value="">Chọn danh mục</option>
                        @foreach($danhMucs as $danhMuc)
                            <option value="{{ $danhMuc->id }}" {{ old('danh_muc_id', $sanPham->danh_muc_id) == $danhMuc->id ? 'selected' : '' }}>
                                {{ $danhMuc->ten_danh_muc }}
                            </option>
                        @endforeach
                    </select>
                    @error('danh_muc_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="gia" class="form-label required">Giá</label>
                    <input type="number" name="gia" id="gia" class="form-input @error('gia') border-red-500 @enderror" 
                        value="{{ old('gia', $sanPham->gia) }}" min="0" step="1000" required>
                    @error('gia')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="so_luong" class="form-label required">Số lượng</label>
                    <input type="number" name="so_luong" id="so_luong" class="form-input @error('so_luong') border-red-500 @enderror" 
                        value="{{ old('so_luong', $sanPham->so_luong) }}" min="0" required>
                    @error('so_luong')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <div class="mb-4">
                    <label for="mo_ta" class="form-label">Mô tả</label>
                    <textarea name="mo_ta" id="mo_ta" rows="5" class="form-input @error('mo_ta') border-red-500 @enderror">{{ old('mo_ta', $sanPham->mo_ta) }}</textarea>
                    @error('mo_ta')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="anh_dai_dien" class="form-label">Ảnh đại diện</label>
                    <div class="flex items-center space-x-4">
                        <img src="{{ Storage::url($sanPham->anh_dai_dien) }}" alt="{{ $sanPham->ten_san_pham }}" 
                            class="h-20 w-20 object-cover rounded">
                        <input type="file" name="anh_dai_dien" id="anh_dai_dien" class="form-input @error('anh_dai_dien') border-red-500 @enderror" 
                            accept="image/*">
                    </div>
                    @error('anh_dai_dien')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="anh_phu" class="form-label">Ảnh phụ</label>
                    <input type="file" name="anh_phu[]" id="anh_phu" class="form-input @error('anh_phu.*') border-red-500 @enderror" 
                        accept="image/*" multiple>
                    <p class="text-sm text-gray-500 mt-1">Có thể chọn nhiều ảnh. Mỗi ảnh tối đa 2MB</p>
                    @error('anh_phu.*')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if($sanPham->anhPhu->count() > 0)
                <div class="mb-4">
                    <label class="form-label">Ảnh phụ hiện tại</label>
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        @foreach($sanPham->anhPhu as $anhPhu)
                        <div class="relative group">
                            <img src="{{ Storage::url($anhPhu->duong_dan) }}" alt="{{ $sanPham->ten_san_pham }}" 
                                class="w-full h-32 object-cover rounded">
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <label class="text-white cursor-pointer">
                                    <input type="checkbox" name="xoa_anh_phu[]" value="{{ $anhPhu->id }}" class="hidden">
                                    <i class="fas fa-trash"></i> Xóa
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="hien_thi" class="form-checkbox" value="1" {{ old('hien_thi', $sanPham->hien_thi) ? 'checked' : '' }}>
                        <span class="ml-2">Hiển thị</span>
                    </label>
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="noi_bat" class="form-checkbox" value="1" {{ old('noi_bat', $sanPham->noi_bat) ? 'checked' : '' }}>
                        <span class="ml-2">Sản phẩm nổi bật</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.san-pham.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Cập nhật
            </button>
        </div>
    </form>
</div>
@endsection 