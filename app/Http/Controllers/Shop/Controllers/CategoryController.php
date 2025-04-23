<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select('id','name','slug','image','status')
            ->orderBy('created_at', 'desc')
            ->get();
        $result = [
            'success' => true,
            'categories' => $categories,
            'message' => 'Tải dữ liệu thành công',
        ];
        return response()->json([$result]);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            $result = [
                'success' => true,
                'category' => $category,
                'message' => 'Tải dữ liệu thành công',
            ];
        } else {
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy danh mục',
            ];
        }
        return response()->json([$result]);
    }
    public function store(Request $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->sort_order = $request->sort_order;
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;
        $category->created_at = date('Y-m-d H:i:s');
        $category->created_by = 1;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/category', $fileName, 'public');
            $category->image = $fileName;
            if($category->save()){
                $result = [
                    'success' => true,
                    'message' => 'Thêm thương hiệu thành công',
                    'category' => $category,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Thêm thương hiệu thất bại',
                'category' => null,
            ];
        }
        return response()->json($result);
    }
    public function update(Request $request, $id)
    {
        $slug = Str::of($request->name)->slug('-');
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy thương hiệu',
            ]);
        }
        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->sort_order = $request->sort_order;
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->updated_by = 1;
        if($request->hasFile('image')){
            // Xóa ảnh cũ nếu có
            $path_delete = "images/category/" . $category->image;
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/category', $fileName, 'public');
            $category->image = $fileName;
            if($category->save()){
                $result = [
                    'success' => true,
                    'message' => 'Cập nhật thương hiệu thành công',
                    'category' => $category,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Cập nhật thương hiệu thất bại',
                'category' => null,
            ];
        }
        return response()->json($result);
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category == null){
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy category',
            ];
            return response()->json($result);
        }
        $path_delete = 'images/category/' . $category->image;
        if($category->delete()){
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $result = [
                'success' => true,
                'message' => 'Xóa category thành công',
            ];
            return response()->json($result);
        }
        else{
            $result = [
                'success' => false,
                'message' => 'Xóa category thất bại',
            ];
            return response()->json($result);
        }

    }

}
