<?php

namespace App\Http\Controllers;

use App\Models\Posts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Termwind\Components\Dd;

class PostController extends Controller
{
    public function index()
    {
        return 'danh sách bài post';
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
        if (Gate::allows('posts.edit', $post)) {
            return 'Bạn  có quyền sửa bài post';
        }
        if (Gate::denies('posts.edit', $post)) {
            return 'Bạn không có quyền sửa bài post';
        }
        return 'edit bài post id' . $post->title;
    }
}
