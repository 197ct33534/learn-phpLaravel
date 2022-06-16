<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        echo '<h1>construc lun lun chạy đầu tiên</h1>';
    }
    public function  index(){
        return '<h2>welcom to viet nam</h2>';
    }
}
