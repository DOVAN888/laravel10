<?php

namespace App\Models;
 use App\Rules\CheckPostCatalogueChildrenRule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PostCatalogue extends Model
{
   use HasFactory,SoftDeletes;
     protected $fillable = [
        'post_catalogue_id',
        'lft',
        'rgt',
        'level',
        'image',
        'icon',
        'album',
        'publish',
        'user_id',
        'order',
        'name'


    ];
    

    protected $table='post_catalogues';

    
    public function languages(){
      return $this->belongsToMany(Language::class,'post_catalogue_language','post_catalogue_id','language_id')
        ->withPivot('name',
         'canonical',
         'meta_title',
         'meta_keyword',
         'meta_description',
         'description',
         'content')->withTimestamps();
    }

     public function posts(){

      return $this->belongsToMany(Post::class,'post_catalogue_post','post_catalogue_id','post_id');
      }


    public function post_catalogue_language(){

      return $this->hasMany(PostCatalogueLanguage::class,'post_catalogue_id','id');
      }
//->withPivot(...): Phương thức withPivot được sử dụng để chỉ định các cột mà bạn muốn lấy từ bảng trung gian. Trong trường hợp này, bạn đang chỉ định nhiều cột như name, canonical, meta_title, meta_keyword, meta_description, description, và content.
    //->withTimestamps(): Phương thức này cho biết rằng bạn muốn sử dụng cột created_at và updated_at trong bảng trung gian để lưu thời điểm tạo và cập nhật mối quan hệ.


  public static function isNodeCheck($id = 0)
{
  // echo 456553;die();

    $postCatalogue = PostCatalogue::find($id);  
    // dd($postCatalogue);

    if ($postCatalogue->rgt - $postCatalogue->lft !== 1) {
        return false;
    }

    return true;
}

}


// phuong thuc tinh co the goi truc tiep 
// con phuong thuc khong tinh thi phai tao mot doi tuong class thi moi goi duoc 
//Rule::exists($table, 'id'): Đây là một phương thức của Laravel Eloquent để kiểm tra xem một giá trị có tồn tại trong cơ sở dữ liệu hay không
 