<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
       public function rules(): array
    {
         return [


        'name' => 'required',
        'canonical'=>'required|unique:post_language,canonical',
        'post_catalogue_id'=>'gt:0',
        //'post_catalogue_id'=>'gt:0' nghia la post_catalogue_idphai lon hon 0
        ];
    }
    public function messages(): array
    {
        return [
          
           'name.required'=>'ban chua chon tieu de',
           'canonical.required'=>'ban chua nhap duong dan ',
            'post_catalogue_id.gt'=>'ban chua chon danh muc cha',
            
           

            
        ]; 
    }
}