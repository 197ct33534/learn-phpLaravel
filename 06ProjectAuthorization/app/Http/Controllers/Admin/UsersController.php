<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Groups;

class UsersController extends Controller
{
    public function index()
    {
        $userID = Auth::user()->id;

        if (Auth::user()->user_id == 0) {
            $usersList = User::all();
        } else {
            $usersList = User::where('user_id', $userID)->get();
        }
        return view('admin.users.lists', compact('usersList'));
    }
    public function add()
    {
        $groupList = Groups::all();
        return view('admin.users.add', compact('groupList'));
    }
    public function postAdd(Request $request)
    {
        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'group_id' => ['required', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail('vui lòng chọn nhóm');
                }
            }],

        ];
        $messages = [
            'name.required' => 'Họ và tên bắt buộc phải nhập ',
            'email.required' => 'Email bắt buộc phải nhập ',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã dươc sử dụng',
            'password.required' => 'Mật khẩu bắt buộc phải nhập ',
            'group_id.required' => 'Vui lòng chọn nhóm',
        ];
        $request->validate($rules, $messages);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->group_id = $request->group_id;
        $user->user_id = Auth::user()->id;
        $user->save();
        return redirect()->route('admin.users.index')->with('msg', 'Thêm người dùng thành công');
    }
    public function edit(User $user)
    {
        $this->authorize('users.edit', $user);
        $groupList = Groups::all();
        return view('admin.users.edit', compact('groupList', 'user'));
    }
    public function postEdit(User $user, Request $request)
    {
        $this->authorize('users.edit', $user);

        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'group_id' => ['required', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail('vui lòng chọn nhóm');
                }
            }],

        ];
        $messages = [
            'name.required' => 'Họ và tên bắt buộc phải nhập ',
            'email.required' => 'Email bắt buộc phải nhập ',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã dươc sử dụng',
            'group_id.required' => 'Vui lòng chọn nhóm',
        ];
        $request->validate($rules, $messages);

        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->group_id = $request->group_id;
        $user->save();
        return redirect()->route('admin.users.index')->with('msg', 'Cập nhật người dùng thành công');
    }

    public function delete(User $user)
    {
        $this->authorize('users.delete', $user);

        if ($user->id != Auth::user()->id) {
            User::destroy($user->id);
            return redirect()->route('admin.users.index')->with('msg', 'Xóa người dùng thành công');
        }
        return redirect()->route('admin.users.index')->with('error', 'Xóa người dùng thất bại');
    }
}
