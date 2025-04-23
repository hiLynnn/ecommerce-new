<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\DanhMuc;
use App\Models\KhuyenMai;
use App\Models\Product;
use App\Models\SanPham;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $featuredProducts = SanPham::with('danhMuc')
        //     ->where('noi_bat', true)
        //     ->where('hien_thi', true)
        //     ->latest()
        //     ->take(8)
        //     ->get();

        // $newProducts = SanPham::with('danhMuc')
        //     ->where('hien_thi', true)
        //     ->latest()
        //     ->take(8)
        //     ->get();

        // $categories = DanhMuc::withCount('sanPhams')
        //     ->get();
        // $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        // $coupons = KhuyenMai::whereDate('promotionsdate_end', '>=', $today)
        //     ->latest()
        //     ->get();
        // Lấy danh sách banner
        // $banners = Banner::where('active', 1)
        // ->orderBy('position')
        // ->get();
        //Lấy danh sách sản phẩm
        $products = Product::select('product.id','product.name','category.name as catname','brand.name as brandname','thumbnail','product.status')
        ->join('category', 'product.category_id', '=', 'category.id')
        ->join('brand', 'product.brand_id', '=', 'brand.id')
        ->orderBy('product.created_at', 'desc')
        ->get();
        return view('home', compact('products'));
    }

    // public function allCoupon(){
    //     $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
    //     $coupons = KhuyenMai::whereDate('promotionsdate_end', '>=', $today)
    //         ->latest()
    //         ->get();
    //     return view('coupons', compact('coupons'));
    // }
}
