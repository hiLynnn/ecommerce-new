<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::select('id','name','phone','email','address','status')
            ->orderBy('created_at', 'desc')
            ->get();
        $result = [
            'success' => true,
            'orders' => $orders,
            'message' => 'Tải dữ liệu thành công',
        ];
        return response()->json([$result]);
    }

    public function show($id)
    {
        $order = Order::find($id);
        if ($order) {
            $result = [
                'success' => true,
                'order' => $order,
                'message' => 'Tải dữ liệu thành công',
            ];
        } else {
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy order',
            ];
        }
        return response()->json([$result]);
    }
    public function store(Request $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $order = new Order();
        $order->name = $request->name;
        $order->slug = $slug;
        $order->description = $request->description;
        $order->sort_order = $request->sort_order;
        $order->parent_id = $request->parent_id;
        $order->status = $request->status;
        $order->created_at = date('Y-m-d H:i:s');
        $order->created_by = 1;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/order', $fileName, 'public');
            $order->image = $fileName;
            if($order->save()){
                $result = [
                    'success' => true,
                    'message' => 'Thêm order thành công',
                    'order' => $order,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Thêm order thất bại',
                'order' => null,
            ];
        }
        return response()->json($result);
    }
    public function update(Request $request, $id)
    {
        $slug = Str::of($request->name)->slug('-');
        $order = Order::find($id);
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy order',
            ]);
        }
        $order->name = $request->name;
        $order->slug = $slug;
        $order->description = $request->description;
        $order->sort_order = $request->sort_order;
        $order->parent_id = $request->parent_id;
        $order->status = $request->status;
        $order->updated_at = date('Y-m-d H:i:s');
        $order->updated_by = 1;
        if($request->hasFile('image')){
            // Xóa ảnh cũ nếu có
            $path_delete = "images/order/" . $order->image;
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/order', $fileName, 'public');
            $order->image = $fileName;
            if($order->save()){
                $result = [
                    'success' => true,
                    'message' => 'Cập nhật order thành công',
                    'order' => $order,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Cập nhật order thất bại',
                'order' => null,
            ];
        }
        return response()->json($result);
    }
    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order == null){
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy order',
            ];
            return response()->json($result);
        }
        $path_delete = 'images/order/' . $order->image;
        if($order->delete()){
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $result = [
                'success' => true,
                'message' => 'Xóa order thành công',
            ];
            return response()->json($result);
        }
        else{
            $result = [
                'success' => false,
                'message' => 'Xóa order thất bại',
            ];
            return response()->json($result);
        }

    }
}
