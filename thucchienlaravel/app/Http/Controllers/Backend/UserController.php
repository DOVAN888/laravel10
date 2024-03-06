<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCatalogue;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;


class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;
    protected $userRepository;

    public function __construct(UserService $userService, ProvinceRepository $provinceRepository ,UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->userRepository =$userRepository;

    }

    public function index( Request $request)
    {

        // dd(request()->all());
       
        ; // sẽ hiển thị 15 bản ghi trong 1 trang
        // dd($users);
          $userCatalogues = UserCatalogue::all(); 
         
           $users = $this->userService->paginate($request);

        // $config = $this->config();
        $config = [
            'js' => [
                //su dung cho cong tac trang thai 
              // su dung select 2 
                'backend/js/plugins/switchery/switchery.js',
                 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js'
            ],
            'css' => [
                //su dung cho cong tac trang thai 

                'backend/css/plugins/switchery/switchery.css',
                  'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'

            ]
        ];

        // thnag nay de goi ben app /user de su dung title ... ma mk cai dat ben do 
        $config['seo'] = config('apps.user');

      // thang nay mk include ben thang layout 
        $template = "backend.user.user.index";
        return view('backend.dashboad.layout', compact('template', 'config', 'users','userCatalogues'));
    }

    // Phần tạo mới trong phan them nguoi dung 
    public function create()
    {

        //thang nay de goi province 
       $provinces = $this->provinceRepository->all();
      $userCatalogues = UserCatalogue::all(); 
         $config = $this->config();

    
   
     
          //
         

          //
        $config['seo'] = config('apps.user');
         $config['method']='create';
        //
        $template = "backend.user.user.store";

        return view('backend.dashboad.layout', compact('template', 'config', 'provinces','userCatalogues'));
    }
    public function store(StoreUserRequest $request){
        if($this->userService->create( $request)){
              return redirect()->route('user.index')->with('success','them moi ban ghi thanh cong');
        }
          return redirect()->route('user.index')->with('error','them moi ban ghi khong  thanh cong,hay thu lai');
    }
    public function edit($id){

        $user =$this->userRepository->findById($id);
      
       $provinces = $this->provinceRepository->all();
        $userCatalogues = UserCatalogue::all();
           $config = $this->config();
   
     
          //
         

          //
        $config['seo'] = config('apps.user');
        $config['method']='edit';
        //
        $template = "backend.user.user.store";

        return view('backend.dashboad.layout', compact('template', 'config', 'provinces','user','userCatalogues'));
    }
    public function update($id,UpdateUserRequest $request){

        
     if($this->userService->update($id, $request)){
              return redirect()->route('user.index')->with('success','cap nhat  ban ghi thanh cong');
        }  $template = "backend.user.user.store";

        return view('backend.dashboad.layout', compact('template', 'config', 'provinces','user'));
          return redirect()->route('user.index')->with('error',' cap nhat ban ghi khong  thanh cong,hay thu lai');
    }
    public function delete($id){
             $user =$this->userRepository->findById($id);


                $config['seo'] = config('apps.user');

          $template = "backend.user.user.delete";

        return view('backend.dashboad.layout', compact('template','config','user'));

    }
    public function destroy($id){
         if($this->userService->destroy($id)){
              return redirect()->route('user.index')->with('success','xoa ban ghi thanh cong');
        } 
        
          return redirect()->route('user.index')->with('error',' khong xoa  ban ghi khong  thanh cong,hay thu lai');
    }
    private function config(){

        return [
            'css'=>[
                // thanng nay de sai select2
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js'=>[
                //thang nay de sai select2
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js',
                'backend/plugin/ckfinder/ckfinder.js',
            
                'backend/library/finder.js'
              
            ]

          ];

    }

    
    }
    



