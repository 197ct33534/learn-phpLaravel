<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //

    } public function index(){
        $title = 'học lập trình web cùng nghĩa dev tương lai';
        $content = 'đây là content của dev nghĩa';
        //cách 1:$dataview = [
        //     'titleData'=>$title,
        //     'contentData'=>$content,
        // ]; return view('home',$dataview);
        /**
         *cách 2 compact('title','content')
         * [
         *      'title'=>$title,
         *      'content'=>$content,
         * ]return view('home',compact('title','content'))
         */

         /**
          * cách 3 dùng với with
            return view('home')->with(['title'=>$title,'content'=>$content]);
          */
         return view('home',compact('title','content'));
        // return View::make('home')->with(['title'=>$title,'content'=>$content]);

        // cách này thông thường dùng để in file pdf
        // $contentView = view('home')->render();
        // dd($contentView);
    }
    public function tintuc(){
        return 'trang tintuc';
    }
    public function getCategories($id){
        return 'chuyen mục '.$id;
    }
    public function getProductDetail($id){
        /**
         * laravel khuyến kích nên dùng cách chấm
         */
        // return view('clients/products/detail',compact('id'));
        return view('clients.products.detail',compact('id'));

    }
}
