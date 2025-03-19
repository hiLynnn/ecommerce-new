<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:san_pham,id',
            'quantity' => 'required|integer|min:1'
        ]);

        app('cart')->add($request->product_id, $request->quantity);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        app('cart')->update($id, $request->quantity);

        return redirect()->back()->with('success', 'Giỏ hàng đã được cập nhật');
    }

    public function remove($id)
    {
        app('cart')->remove($id);

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }
} 