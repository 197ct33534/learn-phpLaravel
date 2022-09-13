<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        $postList = Posts::orderBy('created_at', 'desc')->get();
        return view('admin.posts.lists', compact('postList'));
    }
    public function add()
    {
        return view('admin.posts.add');
    }
    public function postAdd(Request $request)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];
        $messages = [
            'title.required' => 'Tiêu đề không được để trống',
            'content.required' => 'Nội dung không được để trống',
        ];
        $request->validate($rules, $messages);
        $post = new Posts();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect()->route('admin.posts.index')->with('msg', 'Thêm bài viết thành công');
    }
    public function edit(Posts $post)
    {
        return view('admin.posts.edit', compact('post'));
    }
    public function postEdit(Posts $post, Request $request)
    {
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];
        $messages = [
            'title.required' => 'Tiêu đề không được để trống',
            'content.required' => 'Nội dung không được để trống',
        ];
        $request->validate($rules, $messages);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return redirect()->route('admin.posts.index')->with('msg', 'Cập nhật bài viết thành công');
    }
    public function delete(Posts $post)
    {
        Posts::destroy($post->id);
        return redirect()->route('admin.posts.index')->with('msg', 'Xóa bài viết thành công');
    }
}
