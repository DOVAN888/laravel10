<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
     protected $fillable = [
        'name',
       
    ];
    protected $table ='wards';
      protected $primaryKey ='code';// ten khoa chinh
    public $incrementing=false;//  khong tudong tang vi bang false 

    public function districts(){
        return $this->belongsTo(District::class,'district_code','code');
}
}