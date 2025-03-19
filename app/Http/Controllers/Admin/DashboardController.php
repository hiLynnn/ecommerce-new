<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use App\Models\NguoiDung;
use App\Models\SanPham;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê cơ bản
        $totalOrders = DonHang::count();
        $totalProducts = SanPham::count();
        $totalUsers = NguoiDung::where('vai_tro', 'user')->count();
        $totalRevenue = DonHang::where('trang_thai', 'da_giao')->sum('tong_tien');

        // Thống kê đơn hàng theo trạng thái
        $orderStats = DonHang::select('trang_thai', DB::raw('count(*) as total'))
            ->groupBy('trang_thai')
            ->get()
            ->pluck('total', 'trang_thai')
            ->toArray();

        // Doanh thu 7 ngày gần nhất
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Tạo mảng các ngày
        $period = CarbonPeriod::create($startDate, $endDate);
        $dates = [];
        foreach ($period as $date) {
            $dates[$date->format('Y-m-d')] = 0;
        }

        // Lấy doanh thu thực tế
        $revenues = DonHang::where('trang_thai', 'da_giao')
            ->where('created_at', '>=', $startDate)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(tong_tien) as revenue')
            )
            ->groupBy('date')
            ->get()
            ->pluck('revenue', 'date')
            ->toArray();

        // Gộp dữ liệu
        foreach ($revenues as $date => $revenue) {
            if (isset($dates[$date])) {
                $dates[$date] = $revenue;
            }
        }

        // Chuyển đổi sang định dạng cho biểu đồ
        $revenueData = [];
        foreach ($dates as $date => $revenue) {
            $revenueData[] = [
                'date' => $date,
                'revenue' => $revenue
            ];
        }

        // Sản phẩm bán chạy
        $topProducts = DB::table('chi_tiet_don_hang')
            ->join('san_pham', 'chi_tiet_don_hang.san_pham_id', '=', 'san_pham.id')
            ->join('don_hang', 'chi_tiet_don_hang.don_hang_id', '=', 'don_hang.id')
            ->where('don_hang.trang_thai', 'da_giao')
            ->select(
                'san_pham.ten_san_pham',
                'san_pham.anh_dai_dien',
                DB::raw('SUM(chi_tiet_don_hang.so_luong) as total_quantity'),
                DB::raw('SUM(chi_tiet_don_hang.thanh_tien) as total_revenue')
            )
            ->groupBy('san_pham.id', 'san_pham.ten_san_pham', 'san_pham.anh_dai_dien')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalUsers',
            'totalRevenue',
            'orderStats',
            'revenueData',
            'topProducts'
        ));
    }
} 