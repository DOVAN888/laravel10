<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;

use App\Models\District;
use App\Repositories\Interfaces\DistrictRepositoryInterface;

class DistrictRepository extends BaseRepository implements DistrictRepositoryInterface
{
    protected $model;

    public function __construct(District $model)
    //District $model $model la thang lay ben file base vi thang base da goi tat ca database 
    {
        $this->model = $model;
    }
    public function findDistrictByProvinceId(int $province_id=0){
        //province_code la gen trong co so du lieu 
        return $this->model->where('province_code','=',$province_id)->get();


    }
}