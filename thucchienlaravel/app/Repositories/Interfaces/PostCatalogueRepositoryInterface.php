<?php

namespace App\Repositories\Interfaces;


/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface PostCatalogueRepositoryInterface
{
 // public function createLanguagePivot($model,$payload=[]);

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

       
        );


}
