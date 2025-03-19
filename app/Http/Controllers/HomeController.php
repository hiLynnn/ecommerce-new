<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\SanPham;
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

        return view('home', compact('featuredProducts', 'newProducts', 'categories'));
    }
} 