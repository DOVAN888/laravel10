<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
       $this->model=$model; // Gọi hàm tạo của BaseRepository
    }

    public function getAllPaginate()
    {
        return $this->model->paginate(15);
    }

    //phan lam tim kiem bang cac phan khac ko chi ten 
       public function pagination(
          array $column=['*'],//gia tri column cua ca bang
           array $condition=[],// dieu kien truy van 
           array $join=[],// de ket noi lien ket join
            array $extend=[],
        int $perpage=20,// so ban ghi hien tren mot trang 
      array $relations =[],//để lưu trữ thông tin về các quan hệ giữa các cột trong các bảng cơ sở dữ liệu.
      array $orderBy=[],
       array $where=[],

       
        ){
        $query = $this->model->select($column)->where(function ($query) use ($condition) {
        if (isset($condition['keyword']) && !empty($condition['keyword'])) {
            $query->where('name', 'like', '%' . $condition['keyword'] . '%')
                    ->orWhere('email', 'like', '%' . $condition['keyword'] . '%')
                    ->orWhere('phone', 'like', '%' . $condition['keyword'] . '%')
                     ->orWhere('address', 'like', '%' . $condition['keyword'] . '%')
            ;
                        }
                        if(isset($condition['publish']) && $condition['publish']!= 0){
                            $query->where('publish','=',$condition['publish']);
                        }
                        return $query;
                    })->with('user_catalogues');


            if (!empty($join)) {
                $query->join(...$join);
            }

            return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL').'path');
            //withQueryString() de no gan dong duong dan vao 
            //http://vantuongcongnghe.com:8000/user/index?perpage=20&user_catalogue_id=0&keyword=van+tuong&search=search

        }

}
