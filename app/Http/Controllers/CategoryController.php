<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = DanhMuc::where('slug', $slug)
            ->firstOrFail();

        $products = $category->sanPhams()
            ->where('hien_thi', true)
            ->latest()
            ->paginate(12);

        return view('category', compact('category', 'products'));
    }
} 