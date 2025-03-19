@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Thống kê tổng quan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow-sm border border-blue-200 overflow-hidden">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-900">Tổng đơn hàng</h3>
                        <p class="text-2xl font-semibold text-blue-600">{{ number_format($totalOrders) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-50 px-4 py-2">
                <div class="text-sm text-blue-600">
                    <span class="font-medium">{{ $orderStats['cho_xac_nhan'] ?? 0 }}</span> đơn chờ xác nhận
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-green-200 overflow-hidden">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-900">Tổng sản phẩm</h3>
                        <p class="text-2xl font-semibold text-green-600">{{ number_format($totalProducts) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-green-50 px-4 py-2">
                <div class="text-sm text-green-600">
                    <span class="font-medium">{{ number_format($totalProducts) }}</span> sản phẩm đang bán
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-yellow-200 overflow-hidden">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-900">Tổng người dùng</h3>
                        <p class="text-2xl font-semibold text-yellow-600">{{ number_format($totalUsers) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-yellow-50 px-4 py-2">
                <div class="text-sm text-yellow-600">
                    <span class="font-medium">{{ number_format($totalUsers) }}</span> người dùng đã đăng ký
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-purple-200 overflow-hidden">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-sm font-medium text-gray-900">Tổng doanh thu</h3>
                        <p class="text-2xl font-semibold text-purple-600">{{ number_format($totalRevenue) }}đ</p>
                    </div>
                </div>
            </div>
            <div class="bg-purple-50 px-4 py-2">
                <div class="text-sm text-purple-600">
                    <span class="font-medium">{{ $orderStats['da_giao'] ?? 0 }}</span> đơn hàng đã giao
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Thống kê đơn hàng -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Thống kê đơn hàng</h3>
            </div>
            <div class="p-4">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-yellow-600">Chờ xác nhận</span>
                        <span class="text-sm font-semibold">{{ $orderStats['cho_xac_nhan'] ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-blue-600">Đã xác nhận</span>
                        <span class="text-sm font-semibold">{{ $orderStats['da_xac_nhan'] ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-indigo-600">Đang giao</span>
                        <span class="text-sm font-semibold">{{ $orderStats['dang_giao'] ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-green-600">Đã giao</span>
                        <span class="text-sm font-semibold">{{ $orderStats['da_giao'] ?? 0 }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-red-600">Đã hủy</span>
                        <span class="text-sm font-semibold">{{ $orderStats['da_huy'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top sản phẩm bán chạy -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Top sản phẩm bán chạy</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($topProducts as $product)
                <div class="p-4">
                    <div class="flex items-center">
                        <img src="{{ Storage::url($product->anh_dai_dien) }}" 
                             alt="{{ $product->ten_san_pham }}"
                             class="h-12 w-12 object-cover rounded">
                        <div class="ml-4 flex-1">
                            <h4 class="text-sm font-medium text-gray-900">{{ $product->ten_san_pham }}</h4>
                            <div class="mt-1 flex items-center justify-between">
                                <span class="text-sm text-gray-500">Đã bán: {{ number_format($product->total_quantity) }}</span>
                                <span class="text-sm font-medium text-green-600">{{ number_format($product->total_revenue) }}đ</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Biểu đồ doanh thu -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Doanh thu 7 ngày gần nhất</h3>
        </div>
        <div class="p-4">
            <div class="h-80">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueData = @json($revenueData);
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: revenueData.map(item => {
                const date = new Date(item.date);
                return date.toLocaleDateString('vi-VN', {
                    weekday: 'short',
                    month: 'numeric',
                    day: 'numeric'
                });
            }),
            datasets: [{
                label: 'Doanh thu',
                data: revenueData.map(item => item.revenue),
                backgroundColor: 'rgba(79, 70, 229, 0.2)',
                borderColor: 'rgb(79, 70, 229)',
                borderWidth: 1,
                borderRadius: 4,
                barThickness: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND',
                                notation: "compact",
                                compactDisplay: "short"
                            }).format(value);
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(context.raw);
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection 