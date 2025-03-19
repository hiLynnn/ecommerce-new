<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $products = SanPham::where('hien_thi', true)
            ->where(function ($q) use ($query) {
                $q->where('ten_san_pham', 'like', "%{$query}%")
                    ->orWhere('mo_ta', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(12);

        return view('search', compact('products', 'query'));
    }
} 