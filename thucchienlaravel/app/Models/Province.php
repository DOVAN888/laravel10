<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
     protected $fillable = [
        'name',
       
    ];
    protected $table ='provinces';
    protected $primaryKey ='code';// ten khoa chinh
    public $incrementing=false;//  khong tu tang vi bang false 


    public function districts(){
      return $this->hasMany(District::class,'province_code','code');

      //khai bao province_id la khoa ngoai
      // code la khoa chinh 
      

////hasMany:Sử dụng khi một bản ghi của một model de có thể liên kết với nhiều bản ghi của một model khác.
    }

}

   
