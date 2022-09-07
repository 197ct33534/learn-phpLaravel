<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    public function index()
    {
        return view('admin.post.lists');
    }

    public function add()
    {
        if (Gate::allows('posts.add')) {
            return 'Bạn  có quyền thêm bài post';
        }
        if (Gate::denies('posts.add')) {
            return 'Bạn không có quyền thêm bài post';
        }
        return 'thêm bài post';
    }
    public function edit(Posts $post)
    {
        // cách  kiểm tra quyền của 1 user nào đó
        $user = User::find(43);
        if (Gate::forUser($user)->allows('posts.edit', $post)) {
            return 'Bạn  có quyền sửa bài post';
        }
        if (Gate::forUser($user)->denies('posts.edit', $post)) {
            return 'Bạn không có quyền sửa bài post';
        }
        // if (Gate::allows('posts.edit', $post)) {
        //     return 'Bạn  có quyền sửa bài post';
        // }
        // if (Gate::denies('posts.edit', $post)) {
        //     return 'Bạn không có quyền sửa bài post';
        // }
        return 'edit bài post id' . $post->title;
    }
}
