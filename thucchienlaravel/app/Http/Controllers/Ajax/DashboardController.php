<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;

class DashboardController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService){
        $this->userService=$userService;


    }
   public function changeStatus(Request $request){

    $post = $request->input();
    $servicesInterfacesNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
   

    if(class_exists($servicesInterfacesNamespace)){
        $serviceInstance = app($servicesInterfacesNamespace);
    }

    $flag =$serviceInstance->updateStatus($post);

    return response()->json(['flag' => $flag]);
     // ucfirst($post['model']) nghĩa là chữ cái đầu tiên của model sẽ chuyển thành chữ hoa 

   // Khai báo biến trước khi sử dụng để tránh lỗi

    // cau lenh nay goi sang json trong ajax va flag de kiem tra dua ra loi true hoac false 
}
public function changeStatusAll(Request $request){
    $post = $request->input();
     $servicesInterfacesNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
   

    if(class_exists($servicesInterfacesNamespace)){
        $serviceInstance = app($servicesInterfacesNamespace);
    }
       $flag =$serviceInstance->updateStatusAll($post);
          return response()->json(['flag' => $flag]);
}
}

