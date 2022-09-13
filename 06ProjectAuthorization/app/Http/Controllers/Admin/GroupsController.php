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

    public function edit(Groups $group, Request $request)
    {

        return view('admin.groups.edit', compact('group'));
    }
    public function postEdit(Groups $group, Request $request)
    {
        $rules = ['name' => 'required|unique:groups,name,' . $group->id];
        $messages = [
            'name.required' => 'Tên nhóm không được để trống',
            'name.unique' => 'Tên nhóm đã tồn tại',
        ];
        $request->validate($rules, $messages);
        $group->name = $request->name;

        $group->save();
        return redirect()->route('admin.groups.index')->with('msg', 'Cập nhật nhóm người dùng thành công');
    }
    public function delete(Groups $group)
    {
        $numberUser = $group->getUser->count();
        if ($numberUser) {
            return redirect()->route('admin.groups.index')->with('msg', 'Trong nhóm vẫn còn ' . $numberUser . ' người dùng');
        }
        Groups::destroy($group->id);
        return redirect()->route('admin.groups.index')->with('msg', 'Xóa nhóm người dùng thành công');
    }
}
