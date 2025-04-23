<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::select('id','name','link','position','status')
            ->orderBy('created_at', 'desc')
            ->get();
        $result = [
            'success' => true,
            'menus' => $menus,
            'message' => 'Tải dữ liệu thành công',
        ];
        return response()->json([$result]);
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            $result = [
                'success' => true,
                'menu' => $menu,
                'message' => 'Tải dữ liệu thành công',
            ];
        } else {
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy menu',
            ];
        }
        return response()->json([$result]);
    }
    public function store(Request $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->slug = $slug;
        $menu->description = $request->description;
        $menu->sort_order = $request->sort_order;
        $menu->parent_id = $request->parent_id;
        $menu->status = $request->status;
        $menu->created_at = date('Y-m-d H:i:s');
        $menu->created_by = 1;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/menu', $fileName, 'public');
            $menu->image = $fileName;
            if($menu->save()){
                $result = [
                    'success' => true,
                    'message' => 'Thêm menu thành công',
                    'menu' => $menu,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Thêm menu thất bại',
                'menu' => null,
            ];
        }
        return response()->json($result);
    }
    public function update(Request $request, $id)
    {
        $slug = Str::of($request->name)->slug('-');
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy menu',
            ]);
        }
        $menu->name = $request->name;
        $menu->slug = $slug;
        $menu->description = $request->description;
        $menu->sort_order = $request->sort_order;
        $menu->parent_id = $request->parent_id;
        $menu->status = $request->status;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = 1;
        if($request->hasFile('image')){
            // Xóa ảnh cũ nếu có
            $path_delete = "images/menu/" . $menu->image;
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/menu', $fileName, 'public');
            $menu->image = $fileName;
            if($menu->save()){
                $result = [
                    'success' => true,
                    'message' => 'Cập nhật menu thành công',
                    'menu' => $menu,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Cập nhật menu thất bại',
                'menu' => null,
            ];
        }
        return response()->json($result);
    }
    public function destroy($id)
    {
        $menu = Menu::find($id);
        if ($menu == null){
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy menu',
            ];
            return response()->json($result);
        }
        $path_delete = 'images/menu/' . $menu->image;
        if($menu->delete()){
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $result = [
                'success' => true,
                'message' => 'Xóa menu thành công',
            ];
            return response()->json($result);
        }
        else{
            $result = [
                'success' => false,
                'message' => 'Xóa menu thất bại',
            ];
            return response()->json($result);
        }

    }
}
