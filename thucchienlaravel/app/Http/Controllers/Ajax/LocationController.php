<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface as BaseRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;



// phan nay lam cho thang district va thang ward
class LocationController extends Controller
{
    protected $districtRepository;
       protected $provinceRepository;

    public function __construct(DistrictRepository $districtRepository,ProvinceRepository $provinceRepository)
    {
        $this->districtRepository = $districtRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function getLocation(Request $request)
    {
        // $province_id là biến tự tạo từ yêu cầu đến input có giá trị là province_id
        $province_id = $request->input('province_id');
        $get=$request->input();//lay data ben thang ajax ma thang nay chinh la lay cai gia tri cua thang input
      $html='';
      
        if($get['target']=='districts'){
        $province=$this->provinceRepository->findById($get['data']['location_id'] ,['code','name'],['districts']);
        $html = $this->renderHtml($province->districts);
    }else if($get['target']=='wards'){
        //['target']=='wards' cai nay chinh la cai ten data-tagrat ben trang html create
        $district=$this->districtRepository->findById($get['data']['location_id'] ,['code','name'],['wards']);

         $html = $this->renderHtml($district->wards,'[chon phuong /xa]');
    }
        

        $response=[
            'html'=>$html
];


                return response()->json($response);

       
}public function renderHtml($districts,$root='[chon quan/Huyen]'){
    // khi goi bang json ajax thi phai tao bien html va render cho no 
    $html ='<option value="0">'.$root.'</option>';
     foreach($districts as $district){
        $html .= '<option value="'.$district->code.'">'.$district->name.'</option>';
     }
     return $html;
}
}



















  // lay thang province_id vao tu thang input 
        // sau do nhung vao phuong thuc findDistrictByProvinceId ben DistrictRepository cung thiet lap phuong thuc do 
// tao moi quan he cho bien districts
       // $districts=$province->districts->toArray();
       // dd($districts);


        // dd($province);

       
        // $districts = $this->districtRepository->findDistrictByProvinceId($province_id);