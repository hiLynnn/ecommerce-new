@extends('admin.layouts.app')

@section('title', 'Thêm Banner')

@section('header', 'Thêm Banner Mới')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="image" class="form-label required">Hình ảnh</label>
                <input type="file" name="image" id="image" class="form-input @error('image') border-red-500 @enderror" required>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="position" class="form-label required">Vị trí hiển thị</label>
                <select name="position" id="position" class="form-input @error('position') border-red-500 @enderror">
                    <option value="1">Banner lớn</option>
                    <option value="2">Banner nhỏ</option>
                </select>
                @error('position')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="active" class="form-checkbox" value="1" {{ old('active', true) ? 'checked' : '' }}>
                    <span class="ml-2">Hiển thị</span>
                </label>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Lưu Banner
                </button>
            </div>
        </form>
    </div>
@endsection
