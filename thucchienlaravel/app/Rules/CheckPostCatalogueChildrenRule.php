<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\PostCatalogue;

class CheckPostCatalogueChildrenRule implements ValidationRule
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;

   
}
    
    public function validate(string $attribute, mixed $value, Closure $fail):void
    {
        
      
 
        // Rule logic
        $flag = PostCatalogue::isNodeCheck($this->id);
      

        // Check condition and fail if necessary
        if ($flag == false) {
            $fail('Không thể xóa danh mục con');
        }
    }
}
