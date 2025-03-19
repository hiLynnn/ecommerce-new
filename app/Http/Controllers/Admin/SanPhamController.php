<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sanPhams = SanPham::with(['danhMuc', 'anhPhu'])->latest()->paginate(10);
        return view('admin.san-pham.index', compact('sanPhams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $danhMucs = DanhMuc::where('hien_thi', true)->get();
        return view('admin.san-pham.create', compact('danhMucs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ten_san_pham' => 'required|max:255',
            'danh_muc_id' => 'required|exists:danh_muc,id',
            'mo_ta' => 'nullable',
            'gia' => 'required|numeric|min:0',
            'so_luong' => 'required|integer|min:0',
            'anh_dai_dien' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'anh_phu.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hien_thi' => 'boolean',
            'noi_bat' => 'boolean',
        ]);

        $anhDaiDien = $request->file('anh_dai_dien')->store('san-pham', 'public');

        $sanPham = SanPham::create([
            'ten_san_pham' => $request->input('ten_san_pham'),
            'slug' => Str::slug($request->input('ten_san_pham')),
            'danh_muc_id' => $request->input('danh_muc_id'),
            'mo_ta' => $request->input('mo_ta'),
            'gia' => $request->input('gia'),
            'so_luong' => $request->input('so_luong'),
            'anh_dai_dien' => $anhDaiDien,
            'hien_thi' => $request->has('hien_thi'),
            'noi_bat' => $request->has('noi_bat'),
        ]);

        if ($request->hasFile('anh_phu')) {
            foreach ($request->file('anh_phu') as $anhPhu) {
                $duongDan = $anhPhu->store('san-pham/phu', 'public');
                $sanPham->anhPhu()->create(['duong_dan' => $duongDan]);
            }
        }

        return redirect()->route('admin.san-pham.index')
            ->with('success', 'Thêm sản phẩm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SanPham $sanPham)
    {
        return view('admin.san-pham.show', compact('sanPham'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SanPham $sanPham)
    {
        $danhMucs = DanhMuc::where('hien_thi', true)->get();
        return view('admin.san-pham.edit', compact('sanPham', 'danhMucs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SanPham $sanPham)
    {
        $request->validate([
            'ten_san_pham' => 'required|max:255',
            'danh_muc_id' => 'required|exists:danh_muc,id',
            'mo_ta' => 'nullable',
            'gia' => 'required|numeric|min:0',
            'so_luong' => 'required|integer|min:0',
            'anh_dai_dien' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'anh_phu.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'xoa_anh_phu' => 'nullable|array',
            'xoa_anh_phu.*' => 'exists:anh_phu_san_pham,id',
            'hien_thi' => 'boolean',
            'noi_bat' => 'boolean',
        ]);

        $data = [
            'ten_san_pham' => $request->input('ten_san_pham'),
            'slug' => Str::slug($request->input('ten_san_pham')),
            'danh_muc_id' => $request->input('danh_muc_id'),
            'mo_ta' => $request->input('mo_ta'),
            'gia' => $request->input('gia'),
            'so_luong' => $request->input('so_luong'),
            'hien_thi' => $request->has('hien_thi'),
            'noi_bat' => $request->has('noi_bat'),
        ];

        if ($request->hasFile('anh_dai_dien')) {
            Storage::disk('public')->delete($sanPham->anh_dai_dien);
            $data['anh_dai_dien'] = $request->file('anh_dai_dien')->store('san-pham', 'public');
        }

        $sanPham->update($data);

        // Xử lý xóa ảnh phụ
        if ($request->has('xoa_anh_phu')) {
            foreach ($request->input('xoa_anh_phu') as $anhPhuId) {
                $anhPhu = $sanPham->anhPhu()->find($anhPhuId);
                if ($anhPhu) {
                    Storage::disk('public')->delete($anhPhu->duong_dan);
                    $anhPhu->delete();
                }
            }
        }

        // Thêm ảnh phụ mới
        if ($request->hasFile('anh_phu')) {
            foreach ($request->file('anh_phu') as $anhPhu) {
                $duongDan = $anhPhu->store('san-pham/phu', 'public');
                $sanPham->anhPhu()->create(['duong_dan' => $duongDan]);
            }
        }

        return redirect()->route('admin.san-pham.index')
            ->with('success', 'Cập nhật sản phẩm thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SanPham $sanPham)
    {
        try {
            // Xóa ảnh đại diện
            Storage::disk('public')->delete($sanPham->anh_dai_dien);
            
            // Xóa các ảnh phụ
            foreach ($sanPham->anhPhu as $anhPhu) {
                Storage::disk('public')->delete($anhPhu->duong_dan);
            }
            
            // Xóa sản phẩm (các ảnh phụ sẽ tự động bị xóa do quan hệ)
            $sanPham->delete();
            
            return redirect()->route('admin.san-pham.index')
                ->with('success', 'Xóa sản phẩm thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.san-pham.index')
                ->with('error', 'Không thể xóa sản phẩm này.');
        }
    }
}
