<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groups;

class GroupsController extends Controller
{
    public function index()
    {
        $groupList = Groups::all();


        return view('admin.groups.lists', compact('groupList'));
    }
}
