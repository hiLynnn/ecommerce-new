@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa Banner')

@section('header', 'Chỉnh sửa Banner')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="image" class="form-label required">Hình ảnh</label>
                <input type="file" name="image" id="image" class="form-input @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner hiện tại" class="w-48 h-auto rounded">
                </div>
            </div>

            <div class="mb-4">
                <label for="position" class="form-label required">Vị trí hiển thị</label>
                <select name="position" id="position" class="form-input @error('position') border-red-500 @enderror">
                    <option value="1" {{ $banner->position == 1 ? 'selected' : '' }}>Banner lớn</option>
                    <option value="2" {{ $banner->position == 2 ? 'selected' : '' }}>Banner nhỏ</option>
                </select>
                @error('position')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="active" class="form-checkbox" value="1" {{ $banner->active ? 'checked' : '' }}>
                    <span class="ml-2">Hiển thị</span>
                </label>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Cập nhật Banner
                </button>
            </div>
        </form>
    </div>
@endsection
