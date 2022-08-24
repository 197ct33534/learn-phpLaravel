<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Users;

class UsersController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new Users();
    }
    public function index()
    {
        $title = 'danh sách người dùng';
        $this->users->learnQueryBuilder();
        // $users = $this->users->statement('SELECT * FROM users');
        // dd($users);
        $usersList = $this->users->getAllUsers();
        return view('clients.users.lists', compact('title', 'usersList'));
    }
    public function add()
    {
        $title = 'Thêm người dùng';
        return view('clients.users.add', compact('title'));
    }
    public function postAdd(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required|min:5', 'email' => 'required|email|unique:users'
            ],
            [
                'fullname.required' => 'Họ và tên bắt buộc phải nhập',
                'fullname.min' => 'Họ và tên phải lớn hơn :min ký tự trở lên',
                'email.required' => 'Email bắt buộc phải nhập',
                'email.email' => 'Email không đúng dịnh dạng',
                'email.unique' => 'Email đã tồn tại trên hệ thống',
            ]
        );
        $data = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->addUser($data);
        return redirect()->route('users.index')->with('msg', 'Thêm user thành công');
    }
    public function getEdit(Request $request, $id = 0)
    {
        $title = 'Cập nhật người người dùng';

        if (!empty($id)) {
            $userDetail = $this->users->getDetails($id);
            if (!empty($userDetail[0])) {
                $userDetail = $userDetail[0];
                $request->session()->put('id', $id);
            } else {
                return redirect()->route('users.index')->with('msg', 'người dùng không tồn tại');
            }
        } else {
            return redirect()->route('users.index')->with('msg', 'người dùng không tồn tại');
        }
        return view('clients.users.edit', compact('title', 'userDetail'));
    }
    public function postEdit(Request $request)
    {
        $id = session('id');
        if (empty($id)) {
            return back()->with('msg', 'liên kết ko tồn tại');
        }
        $request->validate(
            [
                'fullname' => 'required|min:5', 'email' => 'required|email|unique:users,email,' . $id
            ],
            [
                'fullname.required' => 'Họ và tên bắt buộc phải nhập',
                'fullname.min' => 'Họ và tên phải lớn hơn :min ký tự trở lên',
                'email.required' => 'Email bắt buộc phải nhập',
                'email.email' => 'Email không đúng dịnh dạng',
                'email.unique' => 'Email đã tồn tại trên hệ thống',
            ]
        );
        $data = [
            $request->fullname,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->updateUser($data, $id);
        return redirect()->route('users.index')->with('msg', 'cập nhật user thành công');
    }

    public function delete($id = 0)
    {
        if (!empty($id)) {
            $userDetail = $this->users->getDetails($id);
            if (!empty($userDetail[0])) {
                $deleteStatus = $this->users->deleteUser($id);
                if ($deleteStatus) {
                    $msg = 'xóa người dùng thành công';
                } else {
                    $msg = 'bạn không thể xóa người dùng';
                }
            } else {
                $msg = 'người dùng không tồn tại';
            }
        } else {
            $msg = 'người dùng không tồn tại';
        }
        return redirect()->route('users.index')->with('msg', $msg);
    }
}
