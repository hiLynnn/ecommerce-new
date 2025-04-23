<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::select('id','name','slug','image','status')
            ->orderBy('created_at', 'desc')
            ->get();
        $result = [
            'success' => true,
            'brands' => $brands,
            'message' => 'Tải dữ liệu thành công',
        ];
        return response()->json([$result]);
    }

    public function show($id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            $result = [
                'success' => true,
                'brand' => $brand,
                'message' => 'Tải dữ liệu thành công',
            ];
        } else {
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy thương hiệu',
            ];
        }
        return response()->json([$result]);
    }
    public function store(Request $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = $slug;
        $brand->description = $request->description;
        $brand->sort_order = $request->sort_order;
        $brand->status = $request->status;
        $brand->created_at = date('Y-m-d H:i:s');
        $brand->created_by = 1;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/brand', $fileName, 'public');
            $brand->image = $fileName;
            if($brand->save()){
                $result = [
                    'success' => true,
                    'message' => 'Thêm thương hiệu thành công',
                    'brand' => $brand,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Thêm thương hiệu thất bại',
                'brand' => null,
            ];
        }
        return response()->json($result);
    }
    public function update(Request $request, $id)
    {
        $slug = Str::of($request->name)->slug('-');
        $brand = Brand::find($id);
        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy thương hiệu',
            ]);
        }
        $brand->name = $request->name;
        $brand->slug = $slug;
        $brand->description = $request->description;
        $brand->sort_order = $request->sort_order;
        $brand->status = $request->status;
        $brand->updated_at = date('Y-m-d H:i:s');
        $brand->updated_by = 1;
        if($request->hasFile('image')){
            // Xóa ảnh cũ nếu có
            $path_delete = "images/brand/" . $brand->image;
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/brand', $fileName, 'public');
            $brand->image = $fileName;
            if($brand->save()){
                $result = [
                    'success' => true,
                    'message' => 'Cập nhật thương hiệu thành công',
                    'brand' => $brand,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Cập nhật thương hiệu thất bại',
                'brand' => null,
            ];
        }
        return response()->json($result);
    }
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if ($brand == null){
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy brand',
            ];
            return response()->json($result);
        }
        $path_delete = 'images/brand/' . $brand->image;
        if($brand->delete()){
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $result = [
                'success' => true,
                'message' => 'Xóa brand thành công',
            ];
            return response()->json($result);
        }
        else{
            $result = [
                'success' => false,
                'message' => 'Xóa brand thất bại',
            ];
            return response()->json($result);
        }

    }


}
