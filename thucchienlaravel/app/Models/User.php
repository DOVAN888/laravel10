<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// dong nay de xoa mem
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    // softDeletes Trong Laravel, SoftDeletes là một tính năng giúp bạn thực hiện việc "mềm" xóa dữ liệu thay vì xóa nó hoàn toàn khỏi cơ sở dữ liệu

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'birthday',
        'image',
        'description',
        'user_agent',
        'id',
        'user_catalogue_id',
        'delete',
        'publish'
    ];









    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
 protected $casts = [
        'email_verified_at' => 'datetime',
         'password' => 'string',
        // 'password' => 'hashed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
   


    public function user_catalogues(){
        return $this->belongsTo(UserCatalogue::class,'user_catalogue_id','id');

        //belongsTo: Phương thức này chỉ định mối quan hệ "Nhiều-đến-Một". Nó cho biết rằng mỗi bản ghi của model hiện tại thuộc về một bản ghi của model khác.
        //province_code la khoa phu 

}

}
