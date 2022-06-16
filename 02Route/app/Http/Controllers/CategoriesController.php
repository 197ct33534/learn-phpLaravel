<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function __construct(){

    }
    // hiển thị danh sách chuyên mục phương thức get
    public function index(){
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
    public function showCategory(){
        return  view('clients/categories/add');
    }
    // thêm giữ liệu vào chuyên mục (phương thức post)
    public function handleAddCategory(){
        return redirect(route('categories.add'));
        // return 'add category';
    }
    // xóa giữ liệu
    public function deleteCategory($id){
        return 'delete nè'.$id;
    }
}
