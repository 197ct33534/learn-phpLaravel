<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $data =[] ;
    public function index(){
        $this->data['welcom'] = 'chào mừng nghĩa đến với <b> ngành lập trình</b>';
        $this->data['content'] = '<h4>chương 1 :nhập môn laravel</h4>
            <p>kiến thức 1</p>
            <p>kiến thức 2</p>
            <p>kiến thức 3</p>
        ';
        $this->data['index']=1;
        $this->data['arrData'] = ['chuối','dừa','táo'];
        $this->data['number']=1;
        $this->data['date']=2;
        return view('home',$this->data);
    }
}
