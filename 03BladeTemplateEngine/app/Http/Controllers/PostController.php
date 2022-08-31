<?php

namespace App\Http\Controllers;

use App\Models\Categoies;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //
    public function index()
    {
        // $allPost = Post::all();
        // dd($allPost);

        // $detailPost = Post::find('c1');
        // dd($detailPost);

        // $post = new Post();
        // $post->title = 'tiêu đề 2';
        // $post->content = 'nội dung 2';
        // // $post->status = '1';
        // $post->save();

        // echo '<h2>Query Eloquent ORM</h2>';
        // $allPosts = Post::all();
        // if ($allPosts->count() > 0) {
        //     foreach ($allPosts as $item) {
        //         echo $item->title . '<br/>';
        //     }
        // }
        // $detail = Post::find(2);
        // dd($detail);

        // sử dụng query builder
        // $activePost = DB::table('posts')->where('status', '1')->get();
        // $activePost = Post::where('status', '1')->orderBy('update_at', 'desc')->get();

        // if ($activePost->count() > 0) {
        //     foreach ($activePost as $item) {
        //         echo $item->title . '<br/>';
        //     }
        // }

        // $allposts = Post::all();
        // $activeposts = $allposts->reject(function ($post) {
        //     return $post->status == 1;
        // });
        // dd($activeposts);

        // $allposts = Post::all();
        $allposts = Post::withTrashed()
            ->orderBy('deleted_at', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        // dd($allposts);
        $title = 'danh sách bài Post';
        return view('clients.posts.lists', compact('title', 'allposts'));
    }
    public function add()
    {
        $dataInsert = [
            'title' => 'Thêm Dữ Liệu Trong Eloquent Model',
            'content' => 'Thêm Dữ Liệu Trong Eloquent Models',
            'status' => 1
        ];

        // $post = Post::create($dataInsert);

        // echo 'Id vừa insert: ' . $post->id;

        // $statusPost = Post::insert($dataInsert);
        // dd($statusPost);

        // $post = Post::firstOrCreate(['id' => 6], $dataInsert);
        // dd($post);

        $post = new Post();
        $post->title = 'tiêu đề new';
        $post->content = 'nội dung new';
        $post->status = '1';
        $check = true;
        if ($check) {

            $post->save();
        }
    }
    public function update($id)
    {
        $post = Post::find($id);

        //cách 1
        // $post->title = 'tiêu đề update';
        // $post->content = 'nội dung update';
        // $post->save();

        // cách 2
        $dataUpdate = [
            'title' => 'tiêu đề update 4',
            'content' => 'nội dung update 4',

        ];
        // $status = $post->update($dataUpdate);
        // $status = Post::where('id', $id)->update($dataUpdate);

        // cách 3
        $status = Post::updateOrCreate(['id' => $id], $dataUpdate);
        dd($status);
    }

    public function delete($id)
    {
        $idCollection = collect([12, 13, 15]);
        // dd($idCollection);
        // $status = Post::destroy($id);
        // dd($status);

        $status =  Post::where('id', $id)->delete();
        dd($status);
    }
    public function handleDeleteAny(Request $request)
    {
        $deleteArr =  $request->delete;
        $msg = null;
        if (!empty($deleteArr)) {
            // xử lý
            $status = Post::destroy($deleteArr);
            if ($status) {
                $sl = count($deleteArr);
                $msg = "Đã xóa {$sl} bài viết";
            } else {
                $msg = "bạn không thể xóa vào lúc này";
            }
        } else {
            $msg = 'vui lòng chọn bài viết mún xóa';
        }
        return redirect()->route('posts.index')->with('msg', $msg);
    }
    public function restore($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        if (!empty($post)) {
            $post->restore();
            return redirect()->route('posts.index')->with('msg', 'khôi phục bài viết thành công');
        }
        return redirect()->route('posts.index')->with('msg', 'bài viết không tồn tại');
    }
    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        if (!empty($post)) {
            $post->forceDelete();
            return redirect()->route('posts.index')->with('msg', 'xóa bài viết vĩnh viễn thành công');
        }
        return redirect()->route('posts.index')->with('msg', 'bài viết không tồn tại');
    }
    public function manyToMany()
    {
        // $cateList = Post::find(18)->getCategoies;
        // dd($cateList);

        $postList = Categoies::find(2)->getPosts;
        dd($postList);
        foreach ($postList as $post) {
            echo $post->pivot;
        }
    }
}
