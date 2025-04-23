<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::select('post.id','title','name','post.slug','thumbnail','post.status')
            ->join('topic', 'post.topic_id', '=', 'topic.id')
            ->postBy('post.created_at', 'desc')
            ->get();
        $result = [
            'success' => true,
            'posts' => $posts,
            'message' => 'Tải dữ liệu thành công',
        ];
        return response()->json([$result]);
    }

    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            $result = [
                'success' => true,
                'post' => $post,
                'message' => 'Tải dữ liệu thành công',
            ];
        } else {
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy post',
            ];
        }
        return response()->json([$result]);
    }
    public function store(Request $request)
    {
        $slug = Str::of($request->title)->slug('-');
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->description = $request->description;
        $post->detail = $request->detail;
        $post->type = $request->type;
        $post->topic_id = $request->topic_id;
        $post->status = $request->status;
        $post->created_at = date('Y-m-d H:i:s');
        $post->created_by = 1;
        if($request->hasFile('thumbnail')){
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/post', $fileName, 'public');
            $post->image = $fileName;
            if($post->save()){
                $result = [
                    'success' => true,
                    'message' => 'Thêm post thành công',
                    'post' => $post,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Thêm post thất bại',
                'post' => null,
            ];
        }
        return response()->json($result);
    }
    public function update(Request $request, $id)
    {
        $slug = Str::of($request->name)->slug('-');
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy post',
            ]);
        }
        $post->title = $request->title;
        $post->slug = $slug;
        $post->description = $request->description;
        $post->detail = $request->detail;
        $post->type = $request->type;
        $post->topic_id = $request->topic_id;
        $post->status = $request->status;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->updated_by = 1;
        if($request->hasFile('thumbnail')){
            // Xóa ảnh cũ nếu có
            $path_delete = "images/post/" . $post->image;
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->storeAs('images/post', $fileName, 'public');
            $post->image = $fileName;
            if($post->save()){
                $result = [
                    'success' => true,
                    'message' => 'Cập nhật post thành công',
                    'post' => $post,
                ];
            }
        }else{
            $result = [
                'success' => false,
                'message' => 'Cập nhật post thất bại',
                'post' => null,
            ];
        }
        return response()->json($result);
    }
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post == null){
            $result = [
                'success' => false,
                'message' => 'Không tìm thấy post',
            ];
            return response()->json($result);
        }
        $path_delete = 'images/post/' . $post->image;
        if($post->delete()){
            if(Storage::disk('public')->exists($path_delete)){
                Storage::disk('public')->delete($path_delete);
            }
            $result = [
                'success' => true,
                'message' => 'Xóa post thành công',
            ];
            return response()->json($result);
        }
        else{
            $result = [
                'success' => false,
                'message' => 'Xóa post thất bại',
            ];
            return response()->json($result);
        }

    }
}
