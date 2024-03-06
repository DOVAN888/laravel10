<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;

use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
// use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\LanguageRepositoryInterface as Languaglanguage;
class LanguageController extends Controller
{
    protected $languageService;
    // protected $provinceRepository;
    protected $languageRepository;

    public function __construct(
        LanguageService $languageService,
        // ProvinceRepository $provinceRepository,
        LanguageRepository $languageRepository
    ) {
        $this->languageService = $languageService;
        // $this->provinceRepository = $provinceRepository;
        $this->languageRepository = $languageRepository;

    }

    public function index(Request $request)
    {
        // echo 123;die();
        $languages = $this->languageService->paginate($request);

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

        $config['seo'] = config('apps.language');// de doi ten tieu de theo mong muon 

        $template = "backend.Language.index";
        return view('backend.dashboad.layout', compact('template', 'config', 'languages'));
    }



    //Phần tạo mới trong phan them nguoi dung 
    public function create()
    {
        $config = $this->configData();

       $config = [
            'js' => [
                'backend/plugin/ckfinder/ckfinder.js',
            
                'backend/library/finder.js'
            ],
        ];
          //
        
          //
        $config['seo'] = config('apps.language');
         $config['method']='create';
        //
        $template = "backend.language.store";

        return view('backend.dashboad.layout', compact('template', 'config'));
    }
    public function store(StoreLanguageRequest $request){
        if($this->languageService->create( $request)){
              return redirect()->route('language.index')->with('success','them moi ban ghi thanh cong');
        }
          return redirect()->route('language.index')->with('error','them moi ban ghi khong  thanh cong,hay thu lai');
    }
    public function edit($id){

        $languages =$this->languageRepository->findById($id);
         $config = $this->configData();
      
      
     
         

          //
        $config['seo'] = config('apps.language');
        $config['method']='edit';
        //
        $template = "backend.language.store";

        return view('backend.dashboad.layout', compact('template', 'config','languages'));
    }
    public function update($id,UpdateLanguageRequest $request){

        
     if($this->languageService->update($id, $request)){
              return redirect()->route('language.index')->with('success','cap nhat  ban ghi thanh cong');
        }  $template = "backend.language.store";

        return view('backend.dashboad.layout', compact('template', 'config', 'provinces','language'));
          return redirect()->route('language.index')->with('error',' cap nhat ban ghi khong  thanh cong,hay thu lai');
    }
    public function delete($id){
             $languages =$this->languageRepository->findById($id);


                $config['seo'] = config('apps.language');

          $template = "backend.language.delete";

        return view('backend.dashboad.layout', compact('template','config','languages'));

    }
    public function destroy($id){
         if($this->languageService->destroy($id)){
              return redirect()->route('language.index')->with('success','xoa ban ghi thanh cong');
        } 
        
          return redirect()->route('language.index')->with('error',' khong xoa  ban ghi khong  thanh cong,hay thu lai');
    }

    private function configData(){
        return[
            'js'=>[
                'backend/plugin/ckfinder/ckfinder.js',
            
                'backend/library/finder.js',
            ],

        ];
    }

    }

    
    
