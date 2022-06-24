<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $data =[] ;
    public function index(){
        $this->data['title'] ='Nghĩa học lặp trình web';
        return view('clients.home',$this->data);
    }
    public function product(){
        $this->data['title'] ='Nghĩa học lặp trình web';
        return view('clients.products',$this->data);
    }
}
