<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\DeletePostRequest;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Classes\Nestedsetbie;
use Illuminate\Support\Facades\Auth;
use App\Services\BaseService;


class PostController extends Controller
{
    protected $postService;
    protected $postRepository;
    protected $language;

    public function __construct(
        PostService $postService,
        PostRepository $postRepository
    ) {
        $this->language = $this->currentLanguage();
        $this->postService = $postService;
        $this->postRepository = $postRepository;
        $this->nestedset = new Nestedsetbie([
                    'table' =>'post_catalogues',
                    'foreignkey'=>'post_catalogue_id',
                    'language_id'=>2,

                ]);
        
        
    }

    public function index(Request $request)
    {

               $posts = $this->postService->paginate($request);
               // dd($posts);

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
            ],
            'model'=>'Post',
        ];

        $config['seo'] = config('apps.post');// dong nay de lay tieu de danh muc 
        $template = "backend.post.post.index";
          $dropdown = $this->nestedset->Dropdown();

         
        return view('backend.dashboad.layout', compact('template', 'config', 'posts','dropdown'));
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

        $config['seo'] = config('apps.post');
        $config['method'] = 'create';
           $config['model'] = 'Post';
        $dropdown = $this->nestedset->Dropdown();

      // $album = json_decode($postCatalogue->album);


        $template = "backend.post.post.store";

        return view('backend.dashboad.layout', compact('template', 'config','dropdown',));
    }

    public function store(StorePostRequest $request)
    {
        if ($this->postService->create($request)) {
            return redirect()->route('post.post.index')->with('success', 'Thêm mới bản ghi thành công');
        }

        return redirect()->route('post.post.index')->with('error', 'Thêm mới bản ghi không thành công, hãy thử lại');
    }

    public function edit($id)
    {
        // $postCatalogues = $this->postCatalogueRepository->findById($id,['id','parent_id'],['post_catalogue_language']);

          $posts = $this->postRepository->getPostById($id,$this->language);
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

        $config['seo'] = config('apps.post');
        $config['method'] = 'edit';
        $dropdown = $this->nestedset->Dropdown();
        $album = json_decode($posts->album);
        // dd($album);

    

        $template = "backend.post.post.store";

        return view('backend.dashboad.layout', compact('template', 'config', 'posts','dropdown','album'));
    }

    public function update($id, UpdatePostRequest $request)
    {
        if ($this->postService->update($id, $request)) {
            return redirect()->route('post.post.index')->with('success', 'Cập nhật bản ghi thành công');
        }

        $template = "backend.post.post.store";
        return redirect()->route('post.post.index')->with('error', 'Cập nhật bản ghi không thành công, hãy thử lại');
    }

    public function delete($id)
    {
        $posts = $this->postRepository->getPostById($id,$this->language);
        // dd($posts);
        $config['seo'] = config('apps.post');
        $template = "backend.post.post.delete";

        return view('backend.dashboad.layout', compact('template', 'config', 'posts'));
    }

    public function destroy($id)
    {
        if ($this->postService->destroy($id)) {
            return redirect()->route('post.post.index')->with('success', 'Xóa bản ghi thành công');
        }

        return redirect()->route('post.post.index')->with('error', 'Không xóa bản ghi không thành công, hãy thử lại');
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
