<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use  App\Http\Requests\ProductRequest;
use App\Rules\Uppercase;
class HomeController extends Controller
{
    public $data = [];
    public function index()
    {
        $this->data['title'] = 'Trang chủ';
        $this->data['chart'] = '!';
        return view('clients.home', $this->data);
    }
    public function product()
    {
        $this->data['title'] = 'Trang sản phẩm';
        return view('clients.products', $this->data);
    }
    public function getAdd()
    {
        $this->data['title'] = 'Trang thêm sản phẩm';
        $this->data['errorMessage'] = "vui lòng kiểm tra lại dữ liệu";
        return view('clients.add', $this->data);
    }
    public function postAdd(ProductRequest $request)
    {

        $rules = [
            'name_product' => ['required','min:6'],
            // 'name_product' => ['required','min:6',function ($attribute,$value,$fail){
            //     uppercase($value,'tên sp phải viết hoa',$fail);
            // }],
            'price_product' => ['required','integer']
        ];
        // $messages = [
        //     'name_product.required' => 'trường tên sản phẩm bắt buộc phải nhập',
        //     'name_product.min' => 'tên sản phẩm không dc nhỏ hơn :min ký tự',
        //     'price_product.required' => 'giá sản phẩm bắt buộc phải nhập',
        //     'price_product.integer' => 'giá sản phẩm bắt buộc phải là số',
        // ];
        $messages = [
            'required'=>'trường :attribute bắt buộc phải nhập',
            'min'=> 'trường :attribute không được nhỏ hơn :min ký tự',
            'integer'=>'trường :attribute phải là số'
        ];
        //    $request->validate($rules,$messages);


        $attributes = [
            'name_product' => 'tên sản phẩm',
            'price_product' => 'giá sản phẩm'
        ];
        // $validator = Validator::make($request->all(), $rules, $messages,$attributes);
        // $validator->validate();
        $request->validate($rules,$messages);

        return response()->json(['status'=>'success']);

        // if($validator->fails()){
        //    $validator->errors()->add('msg','vui lòng kt dữ liệu');
        // }else{
        //     return redirect()->route('product')->with('msg','thêm thành công');
        // }
        // return back()->withErrors($validator);
    }

    // public function postAdd(ProductRequest $request){
    //     dd($request->all());
    // }
    public function putAdd(Request $request)
    {
        dd($request);
    }
    public function uppercase ($value,$message,$fail){
        if ($value  !== mb_strtoupper($value,'UTF-8')) {
                $fail($message);
            }
    }
}
