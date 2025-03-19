@extends('admin.layouts.app')

@section('title', 'Sửa người dùng')

@section('header', 'Sửa người dùng')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <form action="{{ route('admin.nguoi-dung.update', $nguoiDung->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="mb-4">
                    <label for="ten" class="form-label required">Tên</label>
                    <input type="text" name="ten" id="ten" class="form-input @error('ten') border-red-500 @enderror" 
                        value="{{ old('ten', $nguoiDung->ten) }}" required>
                    @error('ten')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label required">Email</label>
                    <input type="email" name="email" id="email" class="form-input @error('email') border-red-500 @enderror" 
                        value="{{ old('email', $nguoiDung->email) }}" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="mat_khau" class="form-label">Mật khẩu mới</label>
                    <input type="password" name="mat_khau" id="mat_khau" class="form-input @error('mat_khau') border-red-500 @enderror">
                    <p class="text-sm text-gray-500 mt-1">Để trống nếu không muốn thay đổi mật khẩu</p>
                    @error('mat_khau')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <div class="mb-4">
                    <label for="so_dien_thoai" class="form-label required">Số điện thoại</label>
                    <input type="text" name="so_dien_thoai" id="so_dien_thoai" class="form-input @error('so_dien_thoai') border-red-500 @enderror" 
                        value="{{ old('so_dien_thoai', $nguoiDung->so_dien_thoai) }}" required>
                    @error('so_dien_thoai')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="dia_chi" class="form-label required">Địa chỉ</label>
                    <textarea name="dia_chi" id="dia_chi" rows="3" class="form-input @error('dia_chi') border-red-500 @enderror" required>{{ old('dia_chi', $nguoiDung->dia_chi) }}</textarea>
                    @error('dia_chi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="vai_tro" class="form-label required">Vai trò</label>
                    <select name="vai_tro" id="vai_tro" class="form-input @error('vai_tro') border-red-500 @enderror" required
                        {{ $nguoiDung->isAdmin() && \App\Models\NguoiDung::where('vai_tro', 'admin')->count() <= 1 ? 'disabled' : '' }}>
                        <option value="user" {{ old('vai_tro', $nguoiDung->vai_tro) === 'user' ? 'selected' : '' }}>Người dùng</option>
                        <option value="admin" {{ old('vai_tro', $nguoiDung->vai_tro) === 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                    </select>
                    @if($nguoiDung->isAdmin() && \App\Models\NguoiDung::where('vai_tro', 'admin')->count() <= 1)
                        <p class="text-sm text-gray-500 mt-1">Không thể thay đổi vai trò của admin cuối cùng</p>
                    @endif
                    @error('vai_tro')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.nguoi-dung.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Cập nhật
            </button>
        </div>
    </form>
</div>
@endsection 