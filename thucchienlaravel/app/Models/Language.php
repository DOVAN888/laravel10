<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Language extends Model
{
    // softDeletes Trong Laravel, SoftDeletes là một tính năng giúp bạn thực hiện việc "mềm" xóa dữ liệu thay vì xóa nó hoàn toàn khỏi cơ sở dữ liệu
  //,SoftDeletes
    use HasFactory,SoftDeletes;
     protected $fillable = [
        'name',
        'canonical',
        'publish',
        'user_id',
        'description',
        'image',

    ];
    

    protected $table='languages';

   
    public function languages(){
      return $this->belongsToMany(PostCatalogue::class,'post_catalogue_language','post_catalogue_id','language_id')
        ->withPivot(
          'name',
         'canonical',
         'meta_title',
         'meta_keyword',
         'meta_description',
         'description',
         'content')->withTimestamps();
    }

    //       // tao moi quan he lien quan giua hai bang  khai bao user_catalogue_id la khoa ngoai
    //   // id la khoa chinh  
      //post_catalogue_language la bnag trung gian 
      


   
}
