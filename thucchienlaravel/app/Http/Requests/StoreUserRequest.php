<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'email' => 'required|string|email|unique:users|max:191',//unique:users users tronng bang la duy nhat khogn duoc trung nhau 
        'password' => 'required|string|min:6',
        're_password' => 'required|string|same:password',//same:password cau nay tuc la phai giong thang password
        'user_catalogue_id'=>'required|integer|gt:0',
       // 'gt:0': Phần này của quy tắc đảm bảo rằng giá trị số nguyên của 'user_catalogue_id' phải lớn hơn 0. Nếu giá trị cung cấp là 0 


        'name' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
          'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.email co dang :abc@gmail.com',
            'email.unique'=>'Email da ton tai,hay chon email khac ',
            'email.string '=>'email phai la dang ky tu ',
           'email.max'=>' do dai email toi da la 191 ky tu ',
           'name.required'=>'ban chua nhap ho ten ',
            'name.string'=>'ho ten phai la bang ky tu ',
            'user_catalogue_id.gt'=>'ban chua chon nhom thanh vien ',
              'user_catalogue_id.required'=>'ban chua chon nhom thanh vien ',
           
           
            'password.required' => 'Vui lòng nhập mật khẩu.',
            're_password.same'=>'mat  khau khong khop ',
             're_password.required'=>'ban chua  nhap lai mat khau ',

            
        ]; 
    }
}
