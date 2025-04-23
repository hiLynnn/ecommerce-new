<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::select('id','name','phone','email','title','status')
            ->orderBy('created_at', 'desc')
            ->get();
        $result = [
            'success' => true,
            'contacts' => $contacts,
            'message' => 'Tải dữ liệu thành công',
        ];
        return response()->json([$result]);
    }
    public function show($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $result = [
                'success' => true,
                'contact' => $contact,
                'message' => 'Tải dữ liệu thành công',
            ];
        } else {
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy contact',
            ];
        }
        return response()->json([$result]);
    }
    public function store(Request $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->slug = $slug;
        $contact->description = $request->description;
        $contact->sort_order = $request->sort_order;
        $contact->parent_id = $request->parent_id;
        $contact->status = $request->status;
        $contact->created_at = date('Y-m-d H:i:s');
        $contact->created_by = 1;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/contact', $fileName, 'public');
            $contact->image = $fileName;
            if($contact->save()){
                $result = [
                    'success' => true,
                    'message' => 'Thêm contact thành công',
                    'contact' => $contact,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Thêm contact thất bại',
                'contact' => null,
            ];
        }
        return response()->json($result);
    }
    public function update(Request $request, $id)
    {
        $slug = Str::of($request->name)->slug('-');
        $contact = Contact::find($id);
        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy contact',
            ]);
        }
        $contact->name = $request->name;
        $contact->slug = $slug;
        $contact->description = $request->description;
        $contact->sort_order = $request->sort_order;
        $contact->parent_id = $request->parent_id;
        $contact->status = $request->status;
        $contact->updated_at = date('Y-m-d H:i:s');
        $contact->updated_by = 1;
        if($request->hasFile('image')){
            // Xóa ảnh cũ nếu có
            $path_delete = "images/contact/" . $contact->image;
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/contact', $fileName, 'public');
            $contact->image = $fileName;
            if($contact->save()){
                $result = [
                    'success' => true,
                    'message' => 'Cập nhật contact thành công',
                    'contact' => $contact,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Cập nhật contact thất bại',
                'contact' => null,
            ];
        }
        return response()->json($result);
    }
    public function destroy($id)
    {
        $contact = Contact::find($id);
        if ($contact == null){
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy contact',
            ];
            return response()->json($result);
        }
        $path_delete = 'images/contact/' . $contact->image;
        if($contact->delete()){
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $result = [
                'success' => true,
                'message' => 'Xóa contact thành công',
            ];
            return response()->json($result);
        }
        else{
            $result = [
                'success' => false,
                'message' => 'Xóa contact thất bại',
            ];
            return response()->json($result);
        }

    }
}
