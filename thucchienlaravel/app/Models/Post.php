<?php

namespace App\Models;
 use App\Rules\CheckPostChildrenRule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
   use HasFactory,SoftDeletes;
     protected $fillable = [
       
        'image',
        'post_catalogue_id',
        'catalogue',
       
     
        'album',
        'publish',
        'user_id',
        'order',
        'name',


    ];
    

    protected $table='posts';

    
    public function languages(){
      return $this->belongsToMany(Language::class,'post_language','post_id','language_id')
        ->withPivot(
          'name',
         'canonical',
         'meta_title',
         'meta_keyword',
         'meta_description',
         'description',
         'content')->withTimestamps();
    }


//     ->withPivot(...): Phương thức withPivot được sử dụng để chỉ định các cột khác trong bảng trung gian post_language mà bạn muốn truy cập thông qua mối quan hệ. Trong trường hợp này, các cột là: name, canonical, meta_title, meta_keyword, meta_description, description, content.

// ->withTimestamps(): Phương thức này cho biết rằng bạn muốn Eloquent tự động quản lý các cột created_at và updated_at trong bảng trung gian.

// Tóm lại, đoạn mã trên xác định một mối quan hệ many-to-man

     public function post_catalogues(){

      return $this->belongsToMany(PostCatalogue::class,'post_catalogue_post','post_id','post_catalogue_id');
      }
      
   public function post_catalogue_language(){

      return $this->hasMany(PostCatalogueLanguage::class,'post_catalogue_id','id');
      }
}

   
//->withPivot(...): Phương thức withPivot được sử dụng để chỉ định các cột mà bạn muốn lấy từ bảng trung gian. Trong trường hợp này, bạn đang chỉ định nhiều cột như name, canonical, meta_title, meta_keyword, meta_description, description, và content.
    //->withTimestamps(): Phương thức này cho biết rằng bạn muốn sử dụng cột created_at và updated_at trong bảng trung gian để lưu thời điểm tạo và cập nhật mối quan hệ.


 

// phuong thuc tinh co the goi truc tiep 
// con phuong thuc khong tinh thi phai tao mot doi tuong class thi moi goi duoc 
//Rule::exists($table, 'id'): Đây là một phương thức của Laravel Eloquent để kiểm tra xem một giá trị có tồn tại trong cơ sở dữ liệu hay không
 