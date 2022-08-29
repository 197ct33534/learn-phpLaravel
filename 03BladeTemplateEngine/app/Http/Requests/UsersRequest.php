<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $uniqueEmail = 'unique:users';
        if (session('id')) {
            $id = session('id');
            $uniqueEmail .= ',email,' . $id;
        }

        return [
            'fullname' => 'required|min:5',
            'email' => 'required|email|' . $uniqueEmail,
            'group_id' => [
                'required', 'integer', function ($attr, $value, $fail) {
                    if ($value == 0) {
                        $fail('bắt buộc phải chọn nhóm');
                    }
                }
            ],
            'status' => 'required|integer'
        ];
    }
    public function attributes()
    {
        return [
            'fullname' => 'Họ và tên',
            'email' => 'Email',
            'group_id' => 'Nhóm',
            'status' => 'Trạng thái'
        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => ':attribute bắt buộc phải nhập',
            'fullname.min' => ':attribute phải lớn hơn :min ký tự trở lên',
            'email.required' => ':attribute bắt buộc phải nhập',
            'email.email' => ':attribute không đúng dịnh dạng',
            'email.unique' => ':attribute đã tồn tại trên hệ thống',
            'group_id.required' => ':attribute không được để trống',
            'group_id.integer' => ':attribute không hợp lệ',
            'status.required' => ':attribute không được để trống',
            'status.integer' => ':attribute không hợp lệ'
        ];
    }
}