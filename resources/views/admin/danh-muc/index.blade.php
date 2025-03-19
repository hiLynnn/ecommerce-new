@extends('admin.layouts.app')

@section('title', 'Quản lý danh mục')

@section('header', 'Quản lý danh mục')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold">Danh sách danh mục</h3>
            <a href="{{ route('admin.danh-muc.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm danh mục
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên danh mục</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hiển thị</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($danhMucs as $danhMuc)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $danhMuc->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $danhMuc->ten_danh_muc }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $danhMuc->slug }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $danhMuc->hien_thi ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $danhMuc->hien_thi ? 'Hiển thị' : 'Ẩn' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('admin.danh-muc.edit', $danhMuc->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-edit"></i> Sửa
                                </a>
                                <form action="{{ route('admin.danh-muc.destroy', $danhMuc->id) }}" method="POST" class="inline">
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
            {{ $danhMucs->links() }}
        </div>
    </div>
@endsection 