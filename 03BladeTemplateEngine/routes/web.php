<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostController;
use App\Models\Groups;
use App\Models\Users;
use App\Models\Post;



use App\Models\Comments;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sanpham', [HomeController::class, 'product'])->name('product');
Route::get('/add', [HomeController::class, 'getAdd'])->name('getadd');
Route::post('/add', [HomeController::class, 'postAdd'])->name('postadd');
Route::put('/add', [HomeController::class, 'putAdd'])->name('putadd');
Route::get('/demo-response', function () {
    // $content = json_encode([
    //     'item1',
    //     'item2',
    //     'item3',
    // ]);
    // $res = (new Response($content,201))->header("Content-Type","application/json");
    // $res = new Response();
    // $res = response();

    $res = (new Response())->cookie("devnghia", "nghĩa đang học laravel với cookie 30 phút", 30);
    return $res;
});

Route::get('/demo-response-2', function (Request $request) {
    return $request->cookie("devnghia");
});
Route::get('/demo-response-3', function () {
    $res = response()->view('demoRes', [
        'title' => "nghĩa nè"
    ])->header('Content-Type', 'application/json')->header('API-key', 123456);
    return $res;
});
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('index');
    Route::get('/add', [UsersController::class, 'add'])->name('add');
    Route::post('/add', [UsersController::class, 'postAdd'])->name('post_add');

    Route::get('/edit/{id}', [UsersController::class, 'getEdit'])->name('edit');
    Route::post('/update', [UsersController::class, 'postEdit'])->name('post_edit');
    Route::get('/delete/{id}', [UsersController::class, 'delete'])->name('delete');
    Route::get('/oneToOne', [UsersController::class, 'oneToOne'])->name('oneToOne');
    Route::get('/oneToMany', [UsersController::class, 'oneToMany'])->name('oneToMany');
    Route::get('/oneToThrough', [UsersController::class, 'oneToThrough'])->name('oneToThrough');
    Route::get('/manyToThrough', [UsersController::class, 'manyToThrough'])->name('manyToThrough');
});

Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/add', [PostController::class, 'add'])->name('add');
    Route::get('/update/{id}', [PostController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [PostController::class, 'delete'])->name('delete');
    Route::post('/delete-any', [PostController::class, 'handleDeleteAny'])->name('delete-any');
    Route::get('/restore/{id}', [PostController::class, 'restore'])->name('restore');
    Route::get('/forceDelete/{id}', [PostController::class, 'forceDelete'])->name('force-delete');
    Route::get('manyToMany', [PostController::class, 'manyToMany']);
});
Route::get('/', function () {
    DB::enableQueryLog();
    // $Group = Users::find(1)->belongsToGroupOneToMany;
    // get all users from groups
    // $userList = Groups::find(2)->oneToManyUsers;
    // filters
    // $userList = Groups::find(2)->oneToManyUsers()->where('status', '1')->get();


    // dd($userList);
    // $postList = Post::has('postComments', '>=', '2')->get();
    // $postList = Post::doesntHave('postComments')->get();

    // // $postList  = Post::whereHas('postComments', function ($query) {
    // //     $query->whereNotNull('image');
    // // })->get();
    // $postList  = Post::whereDoesntHave('postComments', function ($query) {
    //     $query->whereNotNull('image');
    // })->get();


    // $postList = Post::withCount('postComments as SL_comment')->get();

    // $postList = Post::withCount([
    //     'postComments as SL_comment',
    //     'postVotes as SL_vote' => function ($query) {
    //         $query->where('value', '>=', '2');
    //     }
    // ])->get();
    // tải dữ liệu
    //cách 1 lazy load
    // $userList = Users::all();
    // cách 2 tải dữ liệu 1 lần
    // $userList = Users::with(['belongsToGroupOneToMany' => function ($query) {
    //     $query->where('name', 'admin');
    // }])->get();
    // cách 3 bản chất vẫn là tải dữ liệu 1 lần
    // $userList = Users::all();
    // $userList->load('belongsToGroupOneToMany');

    // foreach ($userList as $user) {
    //     if (!empty($user->belongsToGroupOneToMany->name)) {
    //         echo $user->belongsToGroupOneToMany->name . '<br/>';
    //     }
    // }

    // cập nhật dữ liệu trong quan hệ
    // cách 1
    // $comment = new Comments(
    //     [
    //         'content' => 'A new comment Nghĩa 2',
    //         'name' => 'New Name Nghĩa 2'
    //     ]
    // );
    // $post = Post::find(17);
    // // thêm 1
    // $post->postComments()->saveMany($comment);
    // // thêm nhiều
    // $post->postComments()->saveMany([$comment, new Comments(
    //     [
    //         'content' => 'A new comment Nghĩa 3',
    //         'name' => 'New Name Nghĩa 3'
    //     ]
    // )]);

    // cách 2
    $post = Post::find(21);
    // them 1
    // $comment = $post->postComments()->create([
    //     'content' => 'A new comment Nghĩa 3 new',
    //     'name' => 'New Name Nghĩa 3 new'
    // ]);

    dd(DB::getQueryLog());
    // dd($postList);
});
