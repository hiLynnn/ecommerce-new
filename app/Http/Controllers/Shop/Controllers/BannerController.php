<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::select('id','name','link','position','image','status')
            ->orderBy('banner.created_at', 'desc')
            ->get();
        $result = [
            'success' => true,
            'banners' => $banners,
            'message' => 'Tải dữ liệu thành công',
        ];
        return response()->json([$result]);
    }

    public function store(Request $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $banner = new Banner();
        $banner->name = $request->name;
        $banner->link = $request->link;
        $banner->position = $request->position;
        $banner->description = $request->description;
        $banner->sort_order = $request->sort_order;
        $banner->status = $request->status;
        $banner->created_at = date('Y-m-d H:i:s');
        $banner->created_by = 1;

        //Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $slug . '_' . time() . '.' . $extension;
            $file->storeAs('images/banner', $filename, 'public');
            $banner->image = $filename;
            if($banner->save()){
                $result = [
                    'success' => true,
                    'message' => 'Thêm banner thành công',
                    'banner' => $banner,
                ];
            }
            else{
                $result = [
                    'success' => false,
                    'message' => 'Thêm banner thất bại',
                ];
            }

            return response()->json($result);
        }
        else {
            $result = [
                'success' => false,
                'message' => 'Thêm mới banner thất bại',
            ];
            return response()->json($result,200);
        }

    }

    public function show(string $id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            $result = [
                'success' => true,
                'banner' => $banner,
                'message' => 'Tải dữ liệu thành công',
            ];
        } else {
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy banner',
            ];
        }
        return response()->json($result);
    }

    public function edit(string $id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            $result = [
                'success' => true,
                'banner' => $banner,
                'message' => 'Tải dữ liệu thành công',
            ];
        } else {
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy banner',
            ];
        }
        return response()->json($result);
    }

    public function update(Request $request, string $id)
    {
        $slug = Str::of($request->name)->slug('-');
        $banner = Banner::find($id);
        if ($banner == null){
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy banner',
            ];
            return response()->json($result);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'link' => 'required',
            'position' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }
        $banner->name = $request->name;
        $banner->link = $request->link;
        $banner->position = $request->position;
        $banner->description = $request->description;
        $banner->sort_order = $request->sort_order;
        $banner->status = $request->status;
        $banner->updated_at = date('Y-m-d H:i:s');
        $banner->updated_by = 1;
        //Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $slug . '_' . time() . '.' . $extension;
            $file->storeAs('images/banner', $filename, 'public');
            //Xóa ảnh cũ
            Storage::disk('public')->delete('images/banner/' . $banner->image);
            $banner->image = $filename;
        }
        if($banner->save()){
            $result = [
                'success' => true,
                'message' => 'Cập nhật banner thành công',
                'banner' => $banner,
            ];
        }
        else{
            $result = [
                'success' => false,
                'message' => 'Cập nhật banner thất bại',
            ];

        }
        return response()->json($result);

    }

    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null){
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy banner',
            ];
            return response()->json($result);
        }
        $path_delete = 'images/banner/' . $banner->image;
        if($banner->delete()){
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $result = [
                'success' => true,
                'message' => 'Xóa banner thành công',
            ];
            return response()->json($result);
        }
        else{
            $result = [
                'success' => false,
                'message' => 'Xóa banner thất bại',
            ];
            return response()->json($result);
        }

    }
}
