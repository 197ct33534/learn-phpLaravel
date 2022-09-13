<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groups;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
{
    public function index()
    {
        $groupList = Groups::all();
        return view('admin.groups.lists', compact('groupList'));
    }

    public function add()
    {
        return view('admin.groups.add');
    }
    public function postAdd(Request $request)
    {
        $rules = ['name' => 'required|unique:groups,name'];
        $messages = [
            'name.required' => 'Tên nhóm không được để trống',
            'name.unique' => 'Tên nhóm đã tồn tại',
        ];
        $request->validate($rules, $messages);

        $group = new Groups();
        $group->name = $request->name;
        $group->user_id = Auth::user()->id;

        $group->save();
        return redirect()->route('admin.groups.index')->with('msg', 'Thêm nhóm người dùng thành công');
    }
}
