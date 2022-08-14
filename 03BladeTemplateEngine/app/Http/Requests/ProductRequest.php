<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
        return [
            'name_product' => 'required|min:6',
            'price_product' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name_product.required' => ':attribute bắt buộc phải nhập',
            'name_product.min' => ':attribute  không dc nhỏ hơn :min ký tự',
            'price_product.required' => ':attribute  bắt buộc phải nhập',
            'price_product.integer' => ':attribute  bắt buộc phải là số',
        ];
    }
    public function attributes()
    {
        return [
            'name_product' => 'tên sản phẩm',
            'price_product' => 'giá sản phẩm'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if ($validator->errors()->count() > 0) {
                $validator->errors()->add('msg', 'đã có lỗi xãy ra , vui lòng kiểm tra lại');
            }
            // dd($validator);
        });
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'create_at' => date('Y-m-d H:i:s'),
        ]);
    }
    protected function failedAuthorization()
    {
        // throw new AuthorizationException('đây là khu vực cấm ,bạn không có quyền truy cập');
        //throw new HttpResponseException(redirect('/')->with(['msg' => 'bạn không có quyền truy cập', 'type' => 'info']));
        throw new HttpResponseException(abort('404'));
    }
}
