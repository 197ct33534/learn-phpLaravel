<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groups;
use Illuminate\Support\Facades\Auth;
use App\Models\Modules;

class GroupsController extends Controller
{
    public function index()
    {
        $userID = Auth::user()->id;
        if (Auth::user()->user_id == 0) {
            $groupList = Groups::all();
        } else {
            $groupList = Groups::where('user_id', $userID)->get();
        }

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
        $this->authorize('groups.edit', $group);

        return view('admin.groups.edit', compact('group'));
    }
    public function postEdit(Groups $group, Request $request)
    {
        $this->authorize('groups.edit', $group);

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
        $this->authorize('groups.delete', $group);

        $numberUser = $group->getUser->count();
        if ($numberUser) {
            return redirect()->route('admin.groups.index')->with('msg', 'Trong nhóm vẫn còn ' . $numberUser . ' người dùng');
        }
        Groups::destroy($group->id);
        return redirect()->route('admin.groups.index')->with('msg', 'Xóa nhóm người dùng thành công');
    }

    public function permissions(Groups $group)
    {
        $this->authorize('permission', $group);
        $moduleList = Modules::all();
        $roleListArr  = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',

        ];
        $dataPermissionJson = $group->permissions;
        $dataPermissionArr = [];
        if (!empty($dataPermissionJson)) {
            $dataPermissionArr = json_decode($dataPermissionJson, true);
        }

        return view('admin.groups.permissions', compact('group', 'moduleList', 'roleListArr', 'dataPermissionArr'));
    }
    public function postPermissions(Groups $group, Request $request)
    {
        $this->authorize('permission', $group);


        $roleList = [];
        if (!empty($request->role)) {
            $roleList = $request->role;
        }
        $permissionJson = json_encode($roleList);
        $group->permissions =  $permissionJson;
        $group->save();
        return back()->with('msg', 'Phần quyền người dùng thành công');
    }
}
