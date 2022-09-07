<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
    public function edit($id)
    {
        return 'edit bài post id' . $id;
    }
}
