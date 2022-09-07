<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Posts::class);
        // $user = Auth::user();
        // if ($user->can('viewAny', Posts::class)) {
        //     return 'được phép';
        // }
        // if ($user->cant('viewAny', Posts::class)) {
        //     abort(403);
        // }
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
    public  function detail(Request $request, Posts $post)
    {

        $this->authorize('view', $post);

        // $user = $request->user();
        // if ($user->can('view', $post)) {
        //     return 'được phép';
        // }
        // if ($user->cant('view', $post)) {
        //     abort(403);
        // }
    }
}
