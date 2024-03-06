<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserCatalogue extends Model
{

  
  // softDeletes Trong Laravel, SoftDeletes là một tính năng giúp bạn thực hiện việc "mềm" xóa dữ liệu thay vì xóa nó hoàn toàn khỏi cơ sở dữ liệu
  //,SoftDeletes
    use HasFactory,SoftDeletes;
     protected $fillable = [
        'name',
        'description',
        'publish'

    ];
    

    protected $table='user_catalogues';

    public function users(){
      return $this->hasMany(User::class,'user_catalogue_id','id');

          // tao moi quan he lien quan giua hai bang  khai bao user_catalogue_id la khoa ngoai
      // id la khoa chinh 
      

}
   


}
