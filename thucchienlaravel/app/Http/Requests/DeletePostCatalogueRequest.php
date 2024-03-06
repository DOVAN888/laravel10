<?php

namespace App\Http\Requests;
use App\Rules\CheckPostCatalogueChildrenRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\PostCatalogue;

class DeletePostCatalogueRequest extends FormRequest
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
    public function rules():array
    {
        $id = $this->route('id');
        //Nếu URL của request là /post/catalogue/123/destroy, thì $id sẽ là
        // dd($id);

        return[
            'name'=>[
                new CheckPostCatalogueChildrenRule($id)
           ],
        ];
    }
}
