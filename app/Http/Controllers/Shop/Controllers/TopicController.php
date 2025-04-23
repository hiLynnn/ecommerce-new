<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::select('id','name','slug','status')
            ->orderBy('created_at', 'desc')
            ->get();
        $result = [
            'success' => true,
            'topics' => $topics,
            'message' => 'Tải dữ liệu thành công',
        ];
        return response()->json([$result]);
    }

    public function show($id)
    {
        $topic = Topic::find($id);
        if ($topic) {
            $result = [
                'success' => true,
                'topic' => $topic,
                'message' => 'Tải dữ liệu thành công',
            ];
        } else {
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy topic',
            ];
        }
        return response()->json([$result]);
    }
    public function store(Request $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $topic = new Topic();
        $topic->name = $request->name;
        $topic->slug = $slug;
        $topic->description = $request->description;
        $topic->sort_order = $request->sort_order;
        $topic->parent_id = $request->parent_id;
        $topic->status = $request->status;
        $topic->created_at = date('Y-m-d H:i:s');
        $topic->created_by = 1;
        if($topic->save()){
            $result = [
                'success' => true,
                'message' => 'Thêm topic thành công',
                'topic' => $topic,
            ];
        }
        else{
            $result = [
                'success' => false,
                'message' => 'Thêm topic thất bại',
                'topic' => null,
            ];
        }
        return response()->json($result);
    }
    public function update(Request $request, $id)
    {
        $slug = Str::of($request->name)->slug('-');
        $topic = Topic::find($id);
        if (!$topic) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy topic',
            ]);
        }
        $topic->name = $request->name;
        $topic->slug = $slug;
        $topic->description = $request->description;
        $topic->sort_order = $request->sort_order;
        $topic->parent_id = $request->parent_id;
        $topic->status = $request->status;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->updated_by = 1;
        if($topic->save()){
            $result = [
                'success' => true,
                'message' => 'Cập nhật topic thành công',
                'topic' => $topic,
            ];
        }else{
            $result = [
                'success' => false,
                'message' => 'Cập nhật topic thất bại',
                'topic' => null,
            ];
        }
        return response()->json($result);
    }
    public function destroy($id)
    {
        $topic = Topic::find($id);
        if ($topic == null){
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy topic',
            ];
            return response()->json($result);
        }
        $path_delete = 'images/topic/' . $topic->image;
        if($topic->delete()){
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $result = [
                'success' => true,
                'message' => 'Xóa topic thành công',
            ];
            return response()->json($result);
        }
        else{
            $result = [
                'success' => false,
                'message' => 'Xóa topic thất bại',
            ];
            return response()->json($result);
        }

    }
}
