<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\PostCatalogue;
use App\Repositories\Interfaces\PostRepositoryInterface;

use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
   

{
    protected $model;

    public function __construct(Post $model)
    {
       $this->model=$model; // Gọi hàm tạo của BaseRepository
    }


    public function pagination(
           array $column=['*'],//gia tri column cua ca bang
           array $condition=[],// dieu kien truy van 
           array $join=[],// de ket noi lien ket join
            array $extend=[],
        int $perpage=20,// so ban ghi hien tren mot trang 
      array $relations =[],//để lưu trữ thông tin về các quan hệ giữa các cột trong các bảng cơ sở dữ liệu.
      array $orderBy=['id','DESC'],
      array $where=[],
      array $rawQuery=[],

       
        ){

            // phan nay tim kiem du lieu 
        $query = $this->model->select($column)->where(function ($query) use ($condition) {
        if (isset($condition['keyword']) && !empty($condition['keyword'])) {
            $query->where('name', 'like', '%' . $condition['keyword'] . '%');
                        }
            if(isset($condition['publish']) && $condition['publish'] !=0){
                $query->where('publish','=',$condition['publish']);
            }
            return $query;


                    });
        if(isset($relations) && !empty($relations)){
            foreach($relations as $relation){
                $query->withCount($relation);

                //withCount là giảm số lượng truy vấn cần thiết để lấy thông tin về số lượng bản ghi liên quan và tối ưu hóa hiệu suất của ứng dụng.

            }
        }

                // day la phan tim kiem theo danh muc

       if(isset($rawQuery['whereRaw']) && count($rawQuery['whereRaw'])) {
    foreach ($rawQuery['whereRaw'] as $key =>$val) {
        $query->whereRaw($val[0], $val[1]);
    }
}

        if (isset($condition['where']) && count($condition['where'])) {
    foreach ($condition['where'] as $key => $value) {
        if (is_array($value) && count($value) === 3) {
            $query->where($value[0], $value[1], $value[2]);
        }
    }
}


        if(isset($join) && is_array($join) && count($join)){
            foreach($join as $key =>$val){
                $query->join($val[0],$val[1],$val[2],$val[3]);
            }
        }
          
        if(isset($orderBy) && is_array($orderBy) && count($orderBy)){
            $query->orderBy($orderBy[0],$orderBy[1]);

}


           

            return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL').'path');
            //withQueryString() de no gan dong duong dan vao 
            //http://vantuongcongnghe.com:8000/user/index?perpage=20&user_catalogue_id=0&keyword=van+tuong&search=search

        }


      

   public function getPostById(int $id = 0, $language_id = 0)
{
    return $this->model->select([

    'posts.id',
    'posts.post_catalogue_id',
    'posts.image',
    'posts.icon',
    'posts.album',
    'posts.publish',
    'posts.follow',
    'tb2.name',
    'tb2.description',
    'tb2.content',
    'tb2.meta_title',
    'tb2.meta_description',
    'tb2.meta_keyword',
    'tb2.canonical',
])
->join('post_language as tb2', 'tb2.post_id', '=', 'posts.id')
->with('post_catalogues')
->where('tb2.language_id', '=', $language_id)

->findOrFail($id);

//>findOrFail($id): Thực hiện truy vấn và lấy ra một bản ghi từ cơ sở dữ liệu với giá trị của trường id bằng $id. Nếu không tìm thấy, sẽ ném ra một ngoại lệ (ModelNotFoundException), thường được sử dụng khi bạn mong đợi có ít nhất một bản ghi với id đã cho.
   

        }







    }