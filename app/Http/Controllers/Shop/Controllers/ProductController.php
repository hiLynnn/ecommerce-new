<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('product.id','product.name','category.name as catname','brand.name as brandname','thumbnail','product.status')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->orderBy('product.created_at', 'desc')
            ->get();
        $result = [
            'success' => true,
            'products' => $products,
            'message' => 'Tải dữ liệu thành công',
        ];
        return response()->json([$result]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            $result = [
                'success' => true,
                'product' => $product,
                'message' => 'Tải dữ liệu thành công',
            ];
        } else {
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy product',
            ];
        }
        return response()->json([$result]);
    }
    public function store(Request $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->slug = $slug;
        $product->description = $request->description;
        $product->detail = $request->detail;
        $product->qty = $request->qty;
        $product->price_sale = $request->price_sale;
        $product->price_buy = $request->price_buy;
        $product->status = $request->status;
        $product->created_at = date('Y-m-d H:i:s');
        $product->created_by = 1;
        if($request->hasFile('thumbnail')){
            $file = $request->file('');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/product', $fileName, 'public');
            $product->image = $fileName;
            if($product->save()){
                $result = [
                    'success' => true,
                    'message' => 'Thêm product thành công',
                    'product' => $product,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Thêm product thất bại',
                'product' => null,
            ];
        }
        return response()->json($result);
    }
    public function update(Request $request, $id)
    {
        $slug = Str::of($request->name)->slug('-');
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy product',
            ]);
        }
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->slug = $slug;
        $product->description = $request->description;
        $product->detail = $request->detail;
        $product->qty = $request->qty;
        $product->price_sale = $request->price_sale;
        $product->price_buy = $request->price_buy;
        $product->status = $request->status;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->updated_by = 1;
        if($request->hasFile('thumbnail')){
            // Xóa ảnh cũ nếu có
            $path_delete = "images/product/" . $product->image;
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/product', $fileName, 'public');
            $product->image = $fileName;
            if($product->save()){
                $result = [
                    'success' => true,
                    'message' => 'Cập nhật product thành công',
                    'product' => $product,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Cập nhật product thất bại',
                'product' => null,
            ];
        }
        return response()->json($result);
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product == null){
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy product',
            ];
            return response()->json($result);
        }
        $path_delete = 'images/product/' . $product->image;
        if($product->delete()){
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $result = [
                'success' => true,
                'message' => 'Xóa product thành công',
            ];
            return response()->json($result);
        }
        else{
            $result = [
                'success' => false,
                'message' => 'Xóa product thất bại',
            ];
            return response()->json($result);
        }

    }
}
