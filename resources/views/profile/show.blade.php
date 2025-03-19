@extends('layouts.app')

@section('title', 'Thông tin tài khoản')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="px-4 py-6 sm:px-6">
        <h1 class="text-2xl font-semibold text-gray-900">Thông tin tài khoản</h1>
    </div>

    <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label for="ten" class="block text-sm font-medium text-gray-700">Họ tên</label>
                    <input type="text" 
                           name="ten" 
                           id="ten" 
                           value="{{ old('ten', auth()->user()->ten) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('ten')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', auth()->user()->email) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="so_dien_thoai" class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                    <input type="text" 
                           name="so_dien_thoai" 
                           id="so_dien_thoai" 
                           value="{{ old('so_dien_thoai', auth()->user()->so_dien_thoai) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('so_dien_thoai')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="dia_chi" class="block text-sm font-medium text-gray-700">Địa chỉ</label>
                    <textarea name="dia_chi" 
                              id="dia_chi" 
                              rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('dia_chi', auth()->user()->dia_chi) }}</textarea>
                    @error('dia_chi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h2 class="text-lg font-medium text-gray-900">Đổi mật khẩu</h2>
                    <p class="mt-1 text-sm text-gray-500">Để trống nếu không muốn thay đổi mật khẩu.</p>

                    <div class="mt-6 space-y-6">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Mật khẩu hiện tại</label>
                            <input type="password" 
                                   name="current_password" 
                                   id="current_password" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu mới</label>
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Xác nhận mật khẩu mới</label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cập nhật thông tin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection