<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $where = [];
        if ($request->name) {
            $where[] = ['name', 'like', '%' . $request->name . '%'];
        }
        if ($request->email) {
            $where[] = ['email', 'like', '%' . $request->email . '%'];
        }
        $userList = User::orderBy('id', 'desc')->get();
        if (!empty($where)) {
            $userList = User::where($where)->orderBy('id', 'desc')->get();
        }
        // $userList đang là 1 collection
        $users = UserResource::collection($userList);

        $response = [
            'status' => 'no_data',
            'data' =>  $users,
        ];
        if ($userList->count()) {
            $response = [
                'status' => 'data',
                'data' =>  $users,

            ];
            return $response;
        }
        return $response;
    }

    public function detail($id)
    {
        $user = User::find($id);
        //$user là 1 user thông thường
        $user = new UserResource($user);

        $response = [
            'status' => 'success',
            'user' => $user,
        ];
        if (!$user) {
            $response = [
                'status' => 'error',
                'msg' => 'người dùng không tồn tại',
            ];
        }
        return  $response;
    }
    public function create(Request $request)
    {

        $this->validated($request);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($user->id) {
            $response = [
                'status' => 'success',
                'data' => $user
            ];
            return $response;
        }

        return  [
            'status' => 'error',
            'msg' => 'thêm user không thành công'
        ];
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $response = [
            'status' => 'error',
            'msg' => 'người dùng không tồn tại',
        ];
        if (!$user) {
            return $response;
        } else {

            if ($request->method() == 'PUT') {
                $this->validated($request, $id);

                $user->name =  $request->name;
                $user->email =  $request->email;
                if (!empty($request->password)) {
                    $user->password =  Hash::make($request->password);
                } else {
                    $user->password = null;
                }
                $user->save();
            } else {
                if ($request->name) {
                    $user->name =  $request->name;
                }
                if ($request->email) {
                    $user->email =  $request->email;
                }
                if ($request->password) {
                    $user->password = Hash::make($request->password);
                }
                $user->save();
            }
            $response = [
                'status' => 'success',
                'data' =>   $user,
            ];
        }

        return $response;
    }
    public function delete(Request $request, $id)
    {
        $user = User::find($id);

        $response = [
            'status' => 'error',
            'msg' => 'người dùng không tồn tại',
        ];
        if (!$user) {
            return $response;
        } else {
            $user = User::destroy($id);
            if ($user) {
                $response = [
                    'status' => 'success',
                    'data' => $user,
                ];
            }
        }

        return $response;
    }
    public function validated($request, $id = 0)
    {
        $uniqueEmail = 'required|email|unique:users';
        if (!empty($id)) {
            $uniqueEmail .= ',email,' . $id;
        }
        $rules = [
            'name' => 'required|min:5',
            'email' => $uniqueEmail,
            'password' => 'required',
        ];
        $messages = [
            'name.required' => 'họ và tên bắt buộc phải nhập ',
            'name.min' => 'họ và tên không được bé hơn :min ký tự',
            'email.required' => 'email bắt buộc phải nhập',
            'email.unique' => 'email đã được sử dụng',
            'password.required' => 'Mật khẩu bắt buộc phải nhập',
        ];
        $request->validate($rules, $messages);
    }
}
