<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donHangs = DonHang::with(['nguoiDung', 'chiTietDonHang.sanPham'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.don-hang.index', compact('donHangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DonHang $donHang)
    {
        $donHang->load(['nguoiDung', 'chiTietDonHang.sanPham']);
        return view('admin.don-hang.show', compact('donHang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateTrangThai(Request $request, DonHang $donHang)
    {
        // Kiểm tra nếu đơn hàng đã hủy thì không cho cập nhật
        if ($donHang->trang_thai === 'da_huy') {
            return back()->with('error', 'Không thể thay đổi trạng thái của đơn hàng đã hủy!');
        }

        $request->validate([
            'trang_thai' => 'required|in:cho_xac_nhan,da_xac_nhan,dang_giao,da_giao,da_huy',
        ]);

        // Nếu đơn hàng đã giao thì không cho cập nhật sang trạng thái khác trừ hủy
        if ($donHang->trang_thai === 'da_giao' && $request->trang_thai !== 'da_huy') {
            return back()->with('error', 'Không thể thay đổi trạng thái của đơn hàng đã giao!');
        }

        $donHang->update([
            'trang_thai' => $request->trang_thai,
        ]);

        $message = $request->trang_thai === 'da_huy' 
            ? 'Hủy đơn hàng thành công!' 
            : 'Cập nhật trạng thái đơn hàng thành công!';

        return back()->with('success', $message);
    }
}
