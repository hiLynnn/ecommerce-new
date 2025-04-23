<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id','name','username','email','phone','avatar','status')
            ->orderBy('created_at', 'desc')
            ->get();
        $result = [
            'success' => true,
            'users' => $users,
            'message' => 'Tải dữ liệu thành công',
        ];
        return response()->json([$result]);
    }
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            $result = [
                'success' => true,
                'user' => $user,
                'message' => 'Tải dữ liệu thành công',
            ];
        } else {
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy user',
            ];
        }
        return response()->json([$result]);
    }
    public function store(Request $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->roles = $request->roles;
        $user->status = $request->status;
        $user->created_at = date('Y-m-d H:i:s');
        $user->created_by = 1;
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/user', $fileName, 'public');
            $user->image = $fileName;
            if($user->save()){
                $result = [
                    'success' => true,
                    'message' => 'Thêm user thành công',
                    'user' => $user,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Thêm user thất bại',
                'user' => null,
            ];
        }
        return response()->json($result);
    }
    public function update(Request $request, $id)
    {
        $slug = Str::of($request->name)->slug('-');
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy user',
            ]);
        }
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->roles = $request->roles;
        $user->status = $request->status;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->updated_by = 1;
        if($request->hasFile('avatar')){
            // Xóa ảnh cũ nếu có
            $path_delete = "images/user/" . $user->image;
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/user', $fileName, 'public');
            $user->image = $fileName;
            if($user->save()){
                $result = [
                    'success' => true,
                    'message' => 'Cập nhật user thành công',
                    'user' => $user,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Cập nhật user thất bại',
                'user' => null,
            ];
        }
        return response()->json($result);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user == null){
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy user',
            ];
            return response()->json($result);
        }
        $path_delete = 'images/user/' . $user->avatar;
        if($user->delete()){
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $result = [
                'success' => true,
                'message' => 'Xóa user thành công',
            ];
            return response()->json($result);
        }
        else{
            $result = [
                'success' => false,
                'message' => 'Xóa user thất bại',
            ];
            return response()->json($result);
        }

    }
}
