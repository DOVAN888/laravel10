<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{ 
     
    protected $fillable = [
        'name',
       
    ];
    protected $table ='districts';
      protected $primaryKey ='code';// ten khoa chinh
    public $incrementing=false;//  khong tu tang vi bang false 

    public function provinces(){
        return $this->belongsTo(Province::class,'province_code','code');

        //belongsTo: Phương thức này chỉ định mối quan hệ "Nhiều-đến-Một". Nó cho biết rằng mỗi bản ghi của model hiện tại thuộc về một bản ghi của model khác.
        //province_code la khoa phu 
    }public function wards(){
       return $this->hasMany(Ward::class,'district_code','code');
    }

   
}
