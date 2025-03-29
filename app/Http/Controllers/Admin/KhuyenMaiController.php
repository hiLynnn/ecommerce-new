<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KhuyenMai;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KhuyenMaiController extends Controller
{
    public function index()
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $coupons = KhuyenMai::latest()->paginate(10);
        return view('admin.khuyen-mai.index', compact('coupons', 'today'));
    }

    public function create()
    {
        return view('admin.khuyen-mai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'promotions_name' => 'required|string|max:255',
            'promotions_times' => 'required|integer|min:1',
            'promotionsdate_start' => 'required|date',
            'promotionsdate_end' => 'required|date|after_or_equal:promotionsdate_start',
            'promotions_code' => 'required|string|max:50|unique:khuyen_mai',
            'promotions_condition' => 'required|integer|in:1,2', // 1: giảm theo %, 2: giảm tiền
            'promotions_number' => 'required|numeric|min:0',
        ]);

        KhuyenMai::create($request->all());

        return redirect()->route('admin.khuyen-mai.index')
            ->with('success', 'Thêm mã giảm giá thành công.');
    }

    public function update(Request $request, KhuyenMai $coupon)
    {
        $request->validate([
            'promotions_name' => 'required|string|max:255',
            'promotions_times' => 'required|integer|min:1',
            'promotionsdate_start' => 'required|date',
            'promotionsdate_end' => 'required|date|after_or_equal:promotionsdate_start',
            'promotions_code' => 'required|string|max:50|unique:khuyen_mai,promotions_code,' . $coupon->id,
            'promotions_condition' => 'required|integer|in:1,2',
            'promotions_number' => 'required|numeric|min:0',
        ]);

        $coupon->update($request->all());

        return redirect()->route('admin.khuyen-mai.index')
            ->with('success', 'Cập nhật mã giảm giá thành công.');
    }

    public function destroy(KhuyenMai $coupon)
    {
        try {
            $coupon->delete();
            return redirect()->route('admin.khuyen-mai.index')
                ->with('success', 'Xóa khuyến mãi thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.khuyen-mai.index')
                ->with('error', 'Không thể xóa.');
        }
    }

}
