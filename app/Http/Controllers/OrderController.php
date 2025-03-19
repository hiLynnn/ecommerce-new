<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->donHang()
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        if (app('cart')->count() == 0) {
            return redirect()->route('cart')
                ->with('error', 'Giỏ hàng của bạn đang trống');
        }

        return view('orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dia_chi_giao' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:20',
            'ghi_chu' => 'nullable|string|max:1000',
        ]);

        $cart = app('cart');

        if ($cart->count() == 0) {
            return redirect()->route('cart')
                ->with('error', 'Giỏ hàng của bạn đang trống');
        }

        $order = DonHang::create([
            'nguoi_dung_id' => Auth::id(),
            'tong_tien' => $cart->total(),
            'dia_chi_giao' => $request->dia_chi_giao,
            'so_dien_thoai' => $request->so_dien_thoai,
            'ghi_chu' => $request->ghi_chu,
            'trang_thai' => 'cho_xac_nhan',
        ]);

        foreach ($cart->content() as $item) {
            $order->chiTietDonHang()->create([
                'san_pham_id' => $item['id'],
                'so_luong' => $item['quantity'],
                'don_gia' => $item['price']
            ]);
        }

        $cart->clear();

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Đơn hàng của bạn đã được đặt thành công');
    }

    public function show($id)
    {
        $order = Auth::user()->donHang()
            ->with(['chiTietDonHang.sanPham'])
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function cancel($id)
    {
        $order = Auth::user()->donHang()
            ->where('trang_thai', 'cho_xac_nhan')
            ->findOrFail($id);

        $order->update(['trang_thai' => 'da_huy']);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Đơn hàng đã được hủy');
    }
}
