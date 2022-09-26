<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // lấy tất cả
    public function index()
    {
        return 'lấy tất cả sản phẩm';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // thêm
    public function store(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // lấy 1
    public function show($id)
    {
        return 'lấy  sản phẩm ' . $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // cập nhật
    public function update(Request $request, $id)
    {
        if ($request->method() == 'PUT') {
            return 'cập nhật sản phẩm phương thức PUT' . $id;
        }
        return 'cập nhật sản phẩm phương thức PATCH' . $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // xóa
    public function destroy($id)
    {
        return 'XÓA SẢN PHẨM ' . $id;
    }
}
