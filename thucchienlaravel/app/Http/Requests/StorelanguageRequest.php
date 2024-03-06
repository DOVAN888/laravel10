<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorelanguageRequest extends FormRequest
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


        'name' => 'required',
        'canonical'=>'required|unique:languages'
        ];
    }
    public function messages(): array
    {
        return [
          
           'name.required'=>'ban chua nhap ten ngon ngu   ',
            'name.required'=>'ban chua nhap vao tu khoa cua ngon ngu',
            'canonical.unique'=>'tu  khoa da to tai ban hay chon tu khoa khac '
           

            
        ]; 
    }
}
