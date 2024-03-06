<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;


use App\Models\Ward;
use App\Repositories\Interfaces\WardRepositoryInterface;

class WardRepository extends BaseRepository implements WardRepositoryInterface
{
   
    public function __construct(Province $model)
    {
        $this->model = $model;
    }
}
