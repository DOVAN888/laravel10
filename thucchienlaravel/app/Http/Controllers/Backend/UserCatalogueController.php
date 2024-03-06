<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserCatalogueRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
// use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    // protected $provinceRepository;
    protected $userCatalogueRepository;

    public function __construct(
        UserCatalogueService $userCatalogueService,
        // ProvinceRepository $provinceRepository,
        UserCatalogueRepository $userCatalogueRepository
    ) {
        $this->userCatalogueService = $userCatalogueService;
        // $this->provinceRepository = $provinceRepository;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    public function index(Request $request)
    {
        // echo 123;die();
        $userCatalogues = $this->userCatalogueService->paginate($request);

        $config = [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js'
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ]
        ];

        $config['seo'] = config('apps.userCatalogue');// de doi ten tieu de theo mong muon 

        $template = "backend.user.catalogue.index";
        return view('backend.dashboad.layout', compact('template', 'config', 'userCatalogues'));
    }



    //Phần tạo mới trong phan them nguoi dung 
    public function create()
    {

        //thang nay de goi province 
       
     
          //
        
          //
        $config['seo'] = config('apps.user');
         $config['method']='create';
        //
        $template = "backend.user.catalogue.store";

        return view('backend.dashboad.layout', compact('template', 'config'));
    }
    public function store(StoreUserCatalogueRequest $request){
        if($this->userCatalogueService->create( $request)){
              return redirect()->route('user.catalogue.index')->with('success','them moi ban ghi thanh cong');
        }
          return redirect()->route('user.catalogue.index')->with('error','them moi ban ghi khong  thanh cong,hay thu lai');
    }
    public function edit($id){

        $userCatalogue =$this->userCatalogueRepository->findById($id);
      
      
     
         

          //
        $config['seo'] = config('apps.user');
        $config['method']='edit';
        //
        $template = "backend.user.catalogue.store";

        return view('backend.dashboad.layout', compact('template', 'config','userCatalogue'));
    }
    public function update($id,StoreUserCatalogueRequest $request){

        
     if($this->userCatalogueService->update($id, $request)){
              return redirect()->route('user.catalogue.index')->with('success','cap nhat  ban ghi thanh cong');
        }  $template = "backend.user.catalogue.store";

        return view('backend.dashboad.layout', compact('template', 'config', 'provinces','user'));
          return redirect()->route('user.catalogue.index')->with('error',' cap nhat ban ghi khong  thanh cong,hay thu lai');
    }
    public function delete($id){
             $userCatalogue =$this->userCatalogueRepository->findById($id);


                $config['seo'] = config('apps.user');

          $template = "backend.user.catalogue.delete";

        return view('backend.dashboad.layout', compact('template','config','userCatalogue'));

    }
    public function destroy($id){
         if($this->userCatalogueService->destroy($id)){
              return redirect()->route('user.catalogue.index')->with('success','xoa ban ghi thanh cong');
        } 
        
          return redirect()->route('user.catalogue.index')->with('error',' khong xoa  ban ghi khong  thanh cong,hay thu lai');
    }

    
    }
    
