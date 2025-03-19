<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class NguoiDungController extends Controller
{
    public function index()
    {
        $nguoiDungs = NguoiDung::latest()->paginate(10);
        return view('admin.nguoi-dung.index', compact('nguoiDungs'));
    }

    public function create()
    {
        return view('admin.nguoi-dung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:nguoi_dung',
            'mat_khau' => 'required|string|min:6',
            'so_dien_thoai' => 'required|string|max:20',
            'dia_chi' => 'required|string|max:255',
            'vai_tro' => 'required|in:admin,user',
        ]);

        NguoiDung::create([
            'ten' => $request->ten,
            'email' => $request->email,
            'mat_khau' => Hash::make($request->mat_khau),
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $request->dia_chi,
            'vai_tro' => $request->vai_tro,
        ]);

        return redirect()->route('admin.nguoi-dung.index')
            ->with('success', 'Thêm người dùng thành công.');
    }

    public function show(NguoiDung $nguoiDung)
    {
        return view('admin.nguoi-dung.show', compact('nguoiDung'));
    }

    public function edit(NguoiDung $nguoiDung)
    {
        return view('admin.nguoi-dung.edit', compact('nguoiDung'));
    }

    public function update(Request $request, NguoiDung $nguoiDung)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('nguoi_dung')->ignore($nguoiDung->id)],
            'mat_khau' => 'nullable|string|min:6',
            'so_dien_thoai' => 'required|string|max:20',
            'dia_chi' => 'required|string|max:255',
            'vai_tro' => 'required|in:admin,user',
        ]);

        $data = [
            'ten' => $request->ten,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $request->dia_chi,
            'vai_tro' => $request->vai_tro,
        ];

        if ($request->filled('mat_khau')) {
            $data['mat_khau'] = Hash::make($request->mat_khau);
        }

        $nguoiDung->update($data);

        return redirect()->route('admin.nguoi-dung.index')
            ->with('success', 'Cập nhật người dùng thành công.');
    }

    public function destroy(NguoiDung $nguoiDung)
    {
        try {
            if ($nguoiDung->isAdmin() && NguoiDung::where('vai_tro', 'admin')->count() <= 1) {
                return redirect()->route('admin.nguoi-dung.index')
                    ->with('error', 'Không thể xóa admin cuối cùng.');
            }

            $nguoiDung->delete();
            return redirect()->route('admin.nguoi-dung.index')
                ->with('success', 'Xóa người dùng thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.nguoi-dung.index')
                ->with('error', 'Không thể xóa người dùng này.');
        }
    }
}
