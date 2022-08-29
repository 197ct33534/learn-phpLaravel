<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Users;
use  App\Http\Requests\UsersRequest;

class UsersController extends Controller
{
    private $users;
    const _PER_PAGE = 2;

    public function __construct()
    {
        $this->users = new Users();
    }
    public function index(Request $request)
    {
        $title = 'danh sách người dùng';
        // $this->users->learnQueryBuilder();
        // $users = $this->users->statement('SELECT * FROM users');
        // dd($users);
        $filters = [];
        $keywords = null;
        if (!empty($request->status)) {
            $status = $request->status;
            if ($status == 'active') {
                $status = 1;
            } else {
                $status = 0;
            }
            $filters[] = ['users.status', '=', $status];
        }

        if (!empty($request->group_id)) {
            $groupId = $request->group_id;

            $filters[] = ['users.group_id', '=', $groupId];
        }

        if (!empty($request->keywords)) {
            $keywords = $request->keywords;
        }
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');
        $allowSort = ['desc', 'asc'];
        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            $sortType = $sortType == 'desc' ? 'asc' : 'desc';
        } else {
            $sortType = 'asc';
        }
        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType
        ];
        $usersList = $this->users->getAllUsers($filters, $keywords, $sortArr, self::_PER_PAGE);
        return view('clients.users.lists', compact('title', 'usersList', 'sortType'));
    }
    public function add()
    {
        $allGroups = getAllGroups();
        $title = 'Thêm người dùng';
        return view('clients.users.add', compact('title', 'allGroups'));
    }
    public function postAdd(UsersRequest $request)
    {
        $data = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'create_at' => date('Y-m-d H:i:s')

        ];

        $this->users->addUser($data);
        return redirect()->route('users.index')->compact('msg', 'allGroups');
    }
    public function getEdit(Request $request, $id = 0)
    {
        $title = 'Cập nhật người người dùng';
        $allGroups = getAllGroups();
        $msg = 'Thêm người dùng thành công';
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
        return view('clients.users.edit', compact('title', 'userDetail', 'allGroups'));
    }
    public function postEdit(UsersRequest $request)
    {
        $id = session('id');
        if (empty($id)) {
            return back()->with('msg', 'liên kết ko tồn tại');
        }
        $data = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'updated_at' => date('Y-m-d H:i:s')
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