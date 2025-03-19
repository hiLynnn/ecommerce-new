<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = SanPham::with(['danhMuc', 'anhPhu'])
            ->where('hien_thi', true)
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = SanPham::where('danh_muc_id', $product->danh_muc_id)
            ->where('id', '!=', $product->id)
            ->where('hien_thi', true)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
} 