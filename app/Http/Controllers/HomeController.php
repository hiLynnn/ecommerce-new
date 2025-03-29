<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\DanhMuc;
use App\Models\KhuyenMai;
use App\Models\SanPham;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = SanPham::with('danhMuc')
            ->where('noi_bat', true)
            ->where('hien_thi', true)
            ->latest()
            ->take(8)
            ->get();

        $newProducts = SanPham::with('danhMuc')
            ->where('hien_thi', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = DanhMuc::withCount('sanPhams')
            ->get();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $coupons = KhuyenMai::whereDate('promotionsdate_end', '>=', $today)
            ->latest()
            ->get();
        // Lấy danh sách banner
        $banners = Banner::where('active', 1)
        ->orderBy('position')
        ->get();
        return view('home', compact('featuredProducts', 'newProducts', 'categories','coupons', 'banners'));
    }

    public function allCoupon(){
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $coupons = KhuyenMai::whereDate('promotionsdate_end', '>=', $today)
            ->latest()
            ->get();
        return view('coupons', compact('coupons'));
    }
}
