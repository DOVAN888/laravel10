<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PostCatalogueLanguage extends Model
{
   use HasFactory,SoftDeletes;
     protected $fillable = [
        'post_catalogue_id',
        'language_id',
        'name',
        'description',
        'content',
        'meta_title',
        'meta_description',
        'canonical',
       


    ];
    
    protected $table='post_catalogue_language';

    public function post_catalogue(){
      return $this->belongto(PostCatalogue::class,'post_catalogue_id','id');

    //       // tao moi quan he lien quan giua hai bang  khai bao user_catalogue_id la khoa ngoai
    //   // id la khoa chinh 
      

}
}