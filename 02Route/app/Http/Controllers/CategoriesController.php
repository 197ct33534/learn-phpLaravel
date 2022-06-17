<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function __construct(Request $request){

        if($request->is('category')){
            echo 'xin chào nghĩa đẹp trai';
        };
    }
    // hiển thị danh sách chuyên mục phương thức get
    public function index(Request $request){
        // if(isset($_GET['id'])){
        //     echo $_GET['id'];
        // }

        // $allData = $request->all(); // lấy từ cả giữ liệu của request hiện tại , lấy tất cả lun dù khác method
        // $id = $allData['id'];echo $id;
        // dd($allData);


        // $path = $request->path();
        // echo $path;

        // $url = $request->url();
        // echo $url;

        // $fullurl = $request->fullUrl();
        // echo $fullurl;

        // $method = $request->method();
        // echo $method;

        // $ip = $request->ip();
        // echo '<br/> Ip là '.$ip;


        // $server = $request->server();
        // echo $server["QUERY_STRING"];
        // dd($server);

        // $header = $request->header();
        // dd($header);

        // $id = $request->input('id.*.name');
        // dd ($id);
        // dd($request->input());

        // $id = $request -> id;
        // $name = $request -> name;
        // echo $id . " ".$name;

        // sử dụng thương thức giống những cái học ở bên trên
        dd(request('id',10));
        return view('clients/categories/list');
    }
    // lấy ra 1 chuyên mục theo id
    public function getCategory($id){
        return view('clients/categories/edit');
    }
    // cập nhật 1 chuyên mục
    public function updateCategory($id){
        return 'update chuyên mục '.$id;
    }
    // show form thêm dữ liệu phương thức get
    public function showCategory(Request $request){

        $path = $request->path();
        echo $path;
        return  view('clients/categories/add');
    }
    // thêm giữ liệu vào chuyên mục (phương thức post)
    public function handleAddCategory(Request $request){
        // $allData = $request->all(); // lấy từ cả giữ liệu của request hiện tại, lấy tất cả lun dù khác method
        // dd($allData);

        $path = $request->path();
        echo $path;


        // return redirect(route('categories.add'));
        // return 'add category';
    }
    // xóa giữ liệu
    public function deleteCategory($id){
        return 'delete nè'.$id;
    }
}
