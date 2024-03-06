<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostCatalogueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.*/
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
        'canonical'=>'required|unique:post_catalogue_language,canonical',
        // 'parent_id'=>'gt:0'
        //'user_catalogue_id'=>'gt:0' nghia la user_catalogue_id phai lon hon 0
        ];
    }
    public function messages(): array
    {
        return [
          
           'name.required'=>'ban chua chon tieu de',
           'canonical.required'=>'ban chua nhap duong dan ',
            // 'parent_id.gt'=>'ban chua chon danh muc cha',
            
           

            
        ]; 
    }
}