<?php

namespace App\Repositories\Interfaces;


/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{

	public function all();
	 public function create(array $payload =[]);
	   public function update(int $id=0, array $payload =[]);
	   // xoa cung 
	    public function delete(int $id=0);
	    //xoa mem
	     public function forceDelete(int $id=0);

	     //phan paginate
	      public function pagination(
            array $column=['*'],//gia tri column cua ca bang
           array $condition=[],// dieu kien truy van 
           array $join=[],// de ket noi lien ket join
            array $extend=[],
        int $perpage=20,// so ban ghi hien tren mot trang 
         array $relations =[], 
          array $orderBy=['id','DESC'],
          array $where=[],
       
          array $rawQuery=[],
        );
	public function findById(
        int $modelId ,//$modelId. Đây là ID của mô hình (model) bạn đang tìm kiếm trong cơ sở dữ liệu.
        array $column=['*'],//Nếu giá trị mặc định là "*", nó có nghĩa là chọn tất cả các cột.
        array $relation=[]//Nó đại diện cho các mối quan hệ (relations) mà bạn muốn load cùng với mô hình. Điều này giúp tránh tình trạng "n+1 query" trong Laravel.
    );
    public function updateByWhereIn(string $whereInField='',array $whereIn=[],array $payload=[]);
    public function createLanguagePivot($model,array $payload=[]);
     public function createPivot($model, array $payload = [],string $relation ='');

	}
	


