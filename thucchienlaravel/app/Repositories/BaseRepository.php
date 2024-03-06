<?php

namespace App\Repositories;

use App\Models\Base;//base nay co san trong laravel; 
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
// use App\Services\Interfaces\UserServiceInterface as UserService;

class BaseRepository implements BaseRepositoryInterface
{

        protected $model;
        public function __construct( Model $model)
           {
            $this->model = $model;

        }
        public function all(){
            return $this->model->all();
        }

        // tao user
        public function create(array $payload =[]){
           $model= $this->model->create($payload);
           return $model->fresh();// Lấy lại dữ liệu mới nhất từ cơ sở dữ liệu
        }

        //user update 
          public function update(int $id=0, array $payload =[]){
           $model= $this->findById($id);// tim kiem id 
                
           return $model->update($payload);// Lấy lại dữ liệu mới nhất từ cơ sở dữ liệu

        }

        //phan nay la update hang loat pusblish cung mot luc 
        public function updateByWhereIn(string $whereInField='',array $whereIn=[],array $payload=[]){
            //field la truong 
            //payload la du lieu truyen dat 
            return $this->model->whereIn($whereInField,$whereIn)->update($payload);

        }
      



        // xoa user 
        public function delete(int $id = 0){
            return $this->findById($id)->delete();

        }
        //xoa mem tuc la xoa luon day la cach xoa 2
        public function forceDelete(int $id=0){
            return $this->findById($id)->forceDelete($id);
        }

        // phan nay lay du lieu theo pagination
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

        
       if(isset($rawQuery['whereRaw']) && count($rawQuery['whereRaw'])) {
    foreach ($rawQuery['whereRaw'] as $key =>$val) {
        $query->whereRaw($val[0], $val[1]);
    }
}

        if(isset($relations) && !empty($relations)){
            foreach($relations as $relation){
                $query->withCount($relation);

                //withCount là giảm số lượng truy vấn cần thiết để lấy thông tin về số lượng bản ghi liên quan và tối ưu hóa hiệu suất của ứng dụng.

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





//phan nay la lay du lieu vung mien theo cac thhanh pho quan huyen thon xom
public function findById(
        int $modelId ,   //$modelId. Đây là ID của mô hình (model) bạn đang tìm kiếm trong cơ sở dữ liệu.
        array $column=['*'],   //Nếu giá trị mặc định là "*", nó có nghĩa là chọn tất cả các cột. co the duoc phep lay nhieu cot 
        array $relation=[]    //Nó đại diện cho các mối quan hệ (relations) mà bạn muốn load cùng với mô hình. Điều này giúp tránh tình trạng "n+1 query" trong Laravel.
    )
    {

        return $this->model->select($column)->with($relation)->findOrFail($modelId);
        //Đoạn mã này sử dụng Eloquent, ORM của Laravel, để tìm kiếm một bản ghi với ID là $modelId. Phương thức select($columns) chọn các cột từ cơ sở dữ liệu
        //findOrFail($modelId) ném một ngoại lệ nếu không tìm thấy bản ghi với ID cung cấp.
    } 



    // phan nay la translate phien dich ngoon ngu 
    public function createLanguagePivot($model,array $payload=[]){
        // dd($payload);

        return $model->languages()->attach($model->id,$payload);

        //$model->languages(): Có vẻ như đang truy cập một mối quan hệ có tên là languages() trên mô hình đã cho no duoc lay trog ten model . 
        //attach($model->id, $payload)Gắn một bản ghi mới vào mối quan hệ languages. Đối số đầu tiên là ID của mô hình liên quan ($model->id), và tham số thứ hai là một mảng chứa dữ liệu bổ sung cho bảng pivot ($payload).


    } 
    public function createPivot($model, array $payload = [],string $relation =''){
            return $model->{$relation}()->attach($model->id,$payload);

    }

       

}
