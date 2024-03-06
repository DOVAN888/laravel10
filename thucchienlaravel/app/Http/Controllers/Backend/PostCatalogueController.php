<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostCatalogueRequest;
use App\Http\Requests\UpdatePostCatalogueRequest;
use App\Http\Requests\DeletePostCatalogueRequest;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Facades\Auth;
use App\Services\BaseService;


class PostCatalogueController extends Controller
{
    protected $postCatalogueService;
    protected $postCatalogueRepository;
    protected $language;

    public function __construct(
        PostCatalogueService $postCatalogueService,
        PostCatalogueRepository $postCatalogueRepository
    ) {
        $this->language = $this->currentLanguage();
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->nestedset = new Nestedsetbie([
                    'table' =>'post_catalogues',
                    'foreignkey'=>'post_catalogue_id',
                    'language_id'=>2,

                ]);
        
        
    }

    public function index(Request $request)
    {
        $postCatalogues = $this->postCatalogueService->paginate($request);

        // dd($postCatalogues);

        $config = [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/library/location.js',
                'backend/library/seo.js',
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ]
        ];

        $config['seo'] = config('apps.postCatalogue');
        $template = "backend.post.catalogue.index";
          $dropdown = $this->nestedset->Dropdown();
         
        return view('backend.dashboad.layout', compact('template', 'config', 'postCatalogues','dropdown'));
    }

    public function create()
    {
         $config = $this->configData();
        $config = [
            'js' => [
                 'backend/plugin/ckeditor/ckeditor.js',
                'backend/plugin/ckfinder/ckfinder.js',
                'backend/library/finder.js',
                 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                 'backend/library/library.js',
                 'backend/library/seo.js'
                 // 'https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js'

            ],
            'css'=>[
                 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ]
        ];

        $config['seo'] = config('apps.postCatalogue');
        $config['method'] = 'create';
        $dropdown = $this->nestedset->Dropdown();// dung de thut le theo cap cua phan tu

      // $album = json_decode($postCatalogue->album);


        $template = "backend.post.catalogue.store";

        return view('backend.dashboad.layout', compact('template', 'config','dropdown',));
    }

    public function store(StorePostCatalogueRequest $request)
    {
        if ($this->postCatalogueService->create($request)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Thêm mới bản ghi thành công');
        }

        return redirect()->route('post.catalogue.index')->with('error', 'Thêm mới bản ghi không thành công, hãy thử lại');
    }

    public function edit($id)
    {
        // $postCatalogues = $this->postCatalogueRepository->findById($id,['id','parent_id'],['post_catalogue_language']);

          $postCatalogues = $this->postCatalogueRepository->getPostCatalogueById($id,$this->language);
          // dd($postCatalogues);
        
        $config = $this->configData();
 $config = [
            'js' => [
                 'backend/plugin/ckeditor/ckeditor.js',
                'backend/plugin/ckfinder/ckfinder.js',
                'backend/library/finder.js',
                 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                 'backend/library/library.js',
                 'backend/library/seo.js'
                 // 'https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js'

            ],
            'css'=>[
                 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ]
        ];

        $config['seo'] = config('apps.postCatalogue');
        $config['method'] = 'edit';
        $dropdown = $this->nestedset->Dropdown();
        $album = json_decode($postCatalogues->album);
        // dd($album);

    

        $template = "backend.post.catalogue.store";

        return view('backend.dashboad.layout', compact('template', 'config', 'postCatalogues','dropdown','album'));
    }

    public function update($id, UpdatePostCatalogueRequest $request)
    {
        if ($this->postCatalogueService->update($id, $request)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Cập nhật bản ghi thành công');
        }

        $template = "backend.post.catalogue.store";
        return redirect()->route('post.catalogue.index')->with('error', 'Cập nhật bản ghi không thành công, hãy thử lại');
    }

    public function delete($id)
    {
        $postCatalogues = $this->postCatalogueRepository->getPostCatalogueById($id,$this->language);
        // dd($postCatalogues);
        $config['seo'] = config('apps.postCatalogue');
        $template = "backend.post.catalogue.delete";

        return view('backend.dashboad.layout', compact('template', 'config', 'postCatalogues'));
    }

    public function destroy(DeletePostCatalogueRequest $request,$id)
    {
        if ($this->postCatalogueService->destroy($id)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Xóa bản ghi thành công');
        }

        return redirect()->route('post.catalogue.index')->with('error', 'Không xóa bản ghi không thành công, hãy thử lại');
    }

    private function configData()
    {
        return [
            'js' => [
                 'backend/plugin/ckeditor/ckeditor.js',
                'backend/plugin/ckfinder/ckfinder.js',
                'backend/library/finder.js',
                 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                 'backend/library/library.js',
                 'https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js',
                 'backend/library/seo.js',

            ],
            'css'=>[
                 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ]
        ];
    }
}
