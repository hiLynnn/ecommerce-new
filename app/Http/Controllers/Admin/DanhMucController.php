<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $danhMucs = DanhMuc::latest()->paginate(10);
        return view('admin.danh-muc.index', compact('danhMucs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.danh-muc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ten_danh_muc' => 'required|max:255|unique:danh_muc,ten_danh_muc',
            'mo_ta' => 'nullable',
            'hien_thi' => 'boolean',
        ]);

        DanhMuc::create([
            'ten_danh_muc' => $request->ten_danh_muc,
            'slug' => Str::slug($request->ten_danh_muc),
            'mo_ta' => $request->mo_ta,
            'hien_thi' => $request->has('hien_thi'),
        ]);

        return redirect()->route('admin.danh-muc.index')
            ->with('success', 'Thêm danh mục thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DanhMuc $danhMuc)
    {
        return view('admin.danh-muc.edit', compact('danhMuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DanhMuc $danhMuc)
    {
        $request->validate([
            'ten_danh_muc' => 'required|max:255|unique:danh_muc,ten_danh_muc,' . $danhMuc->id,
            'mo_ta' => 'nullable',
            'hien_thi' => 'boolean',
        ]);

        $danhMuc->update([
            'ten_danh_muc' => $request->ten_danh_muc,
            'slug' => Str::slug($request->ten_danh_muc),
            'mo_ta' => $request->mo_ta,
            'hien_thi' => $request->has('hien_thi'),
        ]);

        return redirect()->route('admin.danh-muc.index')
            ->with('success', 'Cập nhật danh mục thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DanhMuc $danhMuc)
    {
        try {
            $danhMuc->delete();
            return redirect()->route('admin.danh-muc.index')
                ->with('success', 'Xóa danh mục thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.danh-muc.index')
                ->with('error', 'Không thể xóa danh mục này vì có sản phẩm liên quan.');
        }
    }
}
