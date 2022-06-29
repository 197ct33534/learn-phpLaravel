<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $data =[] ;
    public function index(){
        $this->data['title'] ='Trang chủ';
        $this->data['chart'] ='!';
        return view('clients.home',$this->data);
    }
    public function product(){
        $this->data['title'] ='Trang sản phẩm';
        return view('clients.products',$this->data);
    }
    public function getAdd(){
        $this->data['title'] ='Trang thêm sản phẩm';
        return view('clients.add',$this->data);
    }
    public function postAdd(Request $request){
        dd($request);
    }
    public function putAdd(Request $request){
        dd($request);
    }
}
