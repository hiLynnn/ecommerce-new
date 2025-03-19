@extends('admin.layouts.app')

@section('title', 'Thêm danh mục')

@section('header', 'Thêm danh mục mới')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('admin.danh-muc.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="ten_danh_muc" class="form-label required">Tên danh mục</label>
                <input type="text" name="ten_danh_muc" id="ten_danh_muc" class="form-input @error('ten_danh_muc') border-red-500 @enderror" 
                    value="{{ old('ten_danh_muc') }}" required>
                @error('ten_danh_muc')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="mo_ta" class="form-label">Mô tả</label>
                <textarea name="mo_ta" id="mo_ta" rows="3" class="form-input @error('mo_ta') border-red-500 @enderror">{{ old('mo_ta') }}</textarea>
                @error('mo_ta')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="hien_thi" class="form-checkbox" value="1" {{ old('hien_thi', true) ? 'checked' : '' }}>
                    <span class="ml-2">Hiển thị</span>
                </label>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.danh-muc.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Lưu danh mục
                </button>
            </div>
        </form>
    </div>
@endsection 