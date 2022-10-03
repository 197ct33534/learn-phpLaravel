<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Resources\User as UsersResource;
use App\Http\Resources\PostCollection;

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
        // $userList = User::orderBy('id', 'desc')->with('posts')->withCount('posts')->paginate();
        $userList = User::orderBy('id', 'desc')->paginate();

        if (!empty($where)) {
            // $userList = User::where($where)->orderBy('id', 'desc')->with('posts')->paginate();
            $userList = User::where($where)->orderBy('id', 'desc')->paginate();
        }
        // $userList đang là 1 collection
        // $users = UserResource::collection($userList);


        $statusText = 'no_data';
        $statusCode = 204;

        if ($userList->count()) {
            $statusText = 'success';
            $statusCode = 200;
        }
        $users = new UsersResource($userList, $statusCode, $statusText);


        return  $users;
    }

    public function detail($id)
    {
        $user = User::with('posts')->find($id);
        //$user là 1 user thông thường


        // $response = [
        //     'status' => 'success',
        //     'user' => $user,
        // ];
        if (!$user) {
            $response = [
                'statusText' => 'error',
                'statusCode' => 404,

                'msg' => 'người dùng không tồn tại',
            ];
        } else {
            $userOne = new UserResource($user);

            $response = [
                'statusText' => 'success',
                'statusCode' => 200,
                'data' => $userOne

            ];
        }
        // $userOne = new UserResource($user);
        // dd($userOne);/
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
                'statusText' => 'success',
                'statusCode' => 201,
                'data' => $user
            ];
            return $response;
        }

        return  [
            'statusText' => 'error',
            'statusCode' => 500,
            'msg' => 'serve error'
        ];
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $response = [
            'statusText' => 'error',
            'statusCode' => 404,
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
                'statusText' => 'success',
                'statusCode' => 200,
                'data' =>   $user,
            ];
        }

        return $response;
    }
    public function delete(Request $request, $id)
    {
        $user = User::find($id);

        $response = [
            'statusText' => 'error',
            'statusCode' => 404,
            'msg' => 'người dùng không tồn tại',
        ];
        if (!$user) {
            return $response;
        } else {
            $user = User::destroy($id);
            if ($user) {
                $response = [
                    'statusText' => 'success',
                    'statusCode' => 204,

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
