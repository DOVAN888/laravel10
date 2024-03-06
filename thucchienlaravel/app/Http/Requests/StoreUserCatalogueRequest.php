<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserCatalogueRequest extends FormRequest
{

     public function authorize(): bool
    {
        return true;
    }


     public function rules(): array
    {
         return [


        'name' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
          
           'name.required'=>'ban chua nhap ten nhom thanh vien  ',
            'name.string'=>'nhom thanh vien phai la  ky tu ',
           

            
        ]; 
    }
}
