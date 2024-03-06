<?php

namespace App\Repositories;

use App\Models\PostCatalogue;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface;

use App\Repositories\BaseRepository;

class PostCatalogueRepository extends BaseRepository implements PostCatalogueRepositoryInterface
   

{
    protected $model;

    public function __construct(PostCatalogue $model)
    {
       $this->model=$model; // Gọi hàm tạo của BaseRepository
    }


    public function pagination(
    array $column = ['*'], // Mảng chứa tên các cột được chọn, mặc định là tất cả (*)
    array $condition = [], // Mảng chứa điều kiện truy vấn
    array $join = [], // Mảng chứa thông tin về các câu lệnh liên kết (JOIN)
    array $extend = [],
    int $perpage = 20, // Số lượng bản ghi hiển thị trên mỗi trang, mặc định là 20
    array $relations = [], // Mảng chứa thông tin về quan hệ giữa các bảng
    array $orderBy = ['id', 'DESC'], // Mảng chứa thông tin về sắp xếp kết quả
    array $where = [], // Mảng chứa điều kiện WHERE
    array $rawQuery = [] // Mảng chứa các truy vấn SQL nguyên bản
) {
    // Tạo câu truy vấn cơ bản với các điều kiện được chỉ định
    $query = $this->model->select($column)->where(function ($query) use ($condition) {
        // Thêm điều kiện tìm kiếm theo từ khóa
        if (isset($condition['keyword']) && !empty($condition['keyword'])) {
            $query->where('name', 'like', '%' . $condition['keyword'] . '%');
        }
        // Thêm điều kiện tìm kiếm theo trạng thái xuất bản
        if (isset($condition['publish']) && $condition['publish'] != 0) {
            $query->where('publish', '=', $condition['publish']);
        }
    });

    // Thêm các truy vấn SQL nguyên bản nếu có
    if (isset($rawQuery['whereRaw']) && count($rawQuery['whereRaw'])) {
        foreach ($rawQuery['whereRaw'] as $key => $val) {
            $query->whereRaw($val[0], $val[1]);
        }
    }

    // Thêm các quan hệ vào câu truy vấn
    if (isset($relations) && !empty($relations)) {
        foreach ($relations as $relation) {
            $query->withCount($relation);
        }
    }

    // Thêm điều kiện WHERE nếu có
    if (isset($condition['where']) && count($condition['where'])) {
        foreach ($condition['where'] as $key => $value) {

            
            // Thêm điều kiện WHERE từ mảng điều kiện
            if (is_array($value) && count($value) === 3) {
                $query->where($value[0], $value[1], $value[2]);
            }
        }
    }

    // Thêm các câu lệnh liên kết (JOIN) nếu có
    if (isset($join) && is_array($join) && count($join)) {
        foreach ($join as $key => $val) {
            $query->join($val[0], $val[1], $val[2], $val[3]);
        }
    }

    // Thêm câu lệnh sắp xếp (ORDER BY) nếu có
    if (isset($orderBy) && is_array($orderBy) && count($orderBy)) {
        $query->orderBy($orderBy[0], $orderBy[1]);
    }

    // Trả về kết quả phân trang với số lượng bản ghi trên mỗi trang và các thông số bổ sung
    return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL') . 'path');
}



   public function getPostCatalogueById(int $id = 0, $language_id = 0)
{
    return $this->model->select([
        'post_catalogues.id',
        'post_catalogues.post_catalogue_id',
        'post_catalogues.image',
        'post_catalogues.icon',
        'post_catalogues.album',
        'post_catalogues.publish',
        'post_catalogues.follow',
        'tb2.name',
        'tb2.description',
        'tb2.content',
        'tb2.meta_title',
        'tb2.meta_description',
        'tb2.meta_keyword',
        'tb2.canonical',
    ]
)->join('post_catalogue_language as tb2','tb2.post_catalogue_id','=','post_catalogues.id')->where('tb2.language_id','=',$language_id)
       ->findOrFail($id);
//>findOrFail($id): Thực hiện truy vấn và lấy ra một bản ghi từ cơ sở dữ liệu với giá trị của trường id bằng $id. Nếu không tìm thấy, sẽ ném ra một ngoại lệ (ModelNotFoundException), thường được sử dụng khi bạn mong đợi có ít nhất một bản ghi với id đã cho.
   

        }







    }