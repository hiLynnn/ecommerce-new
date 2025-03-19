@extends('admin.layouts.app')

@section('title', 'Quản lý người dùng')

@section('header', 'Quản lý người dùng')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold">Danh sách người dùng</h3>
        <a href="{{ route('admin.nguoi-dung.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm người dùng
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số điện thoại</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vai trò</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($nguoiDungs as $nguoiDung)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $nguoiDung->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $nguoiDung->ten }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $nguoiDung->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $nguoiDung->so_dien_thoai }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $nguoiDung->vai_tro === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                            {{ $nguoiDung->vai_tro === 'admin' ? 'Quản trị viên' : 'Người dùng' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('admin.nguoi-dung.show', $nguoiDung->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-eye"></i> Xem
                        </a>
                        <a href="{{ route('admin.nguoi-dung.edit', $nguoiDung->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        @if(!$nguoiDung->isAdmin() || \App\Models\NguoiDung::where('vai_tro', 'admin')->count() > 1)
                        <form action="{{ route('admin.nguoi-dung.destroy', $nguoiDung->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $nguoiDungs->links() }}
    </div>
</div>
@endsection 