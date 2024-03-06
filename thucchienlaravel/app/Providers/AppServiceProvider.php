<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
//services
use App\Services\Interfaces\UserServiceInterface;
use App\Services\UserService;

//responsotiry
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;

use App\Repositories\Interfaces\ProvinceRepositoryInterface;
use App\Repositories\ProvinceRepository;
use App\Repositories\Interfaces\WardRepositoryInterface;
use App\Repositories\WardRepository;
use App\Repositories\Interfaces\DistrictRepositoryInterface;
use App\Repositories\DistrictRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\BaseRepository;
//catalogue phan qua ly nhom thanh vien 

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Services\UserCatalogueService;


use App\Repositories\Interfaces\UserCatalogueRepositoryInterface;
use App\Repositories\UserCatalogueRepository;



//phan language
use App\Services\Interfaces\LanguageServiceInterface;
use App\Services\LanguageService;


use App\Repositories\Interfaces\LanguageRepositoryInterface;
use App\Repositories\LanguageRepository;
//phan them nhom bai viet 
use App\Services\Interfaces\PostCatalogueServiceInterface;
use App\Services\PostCatalogueService;


use App\Repositories\Interfaces\PostCatalogueRepositoryInterface;
use App\Repositories\PostCatalogueRepository;

use App\Services\Interfaces\BaseServiceInterface;
use App\Services\BaseService;
//phan them bai viet 

use App\Services\Interfaces\PostServiceInterface;
use App\Services\PostService;


use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\PostRepository;






class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
    
     */
  


    public function register(): void
    {
        //phan user 
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
         $this->app->bind(ProvinceRepositoryInterface::class,ProvinceRepository::class);
          $this->app->bind(DistrictRepositoryInterface::class,DistrictRepository::class);
           $this->app->bind(WardRepositoryInterface::class,WardRepository::class);
            $this->app->bind(BaseRepositoryInterface::class,BaseRepository::class);


            //phan catalogue
            $this->app->bind(UserCatalogueServiceInterface::class, UserCatalogueService::class);
          $this->app->bind(UserCatalogueRepositoryInterface::class, UserCatalogueRepository::class);

          //phan language
               $this->app->bind(LanguageServiceInterface::class, LanguageService::class);
          $this->app->bind(LanguageRepositoryInterface::class, LanguageRepository::class);
          // phan them nhom bai viet 
            $this->app->bind(PostCatalogueServiceInterface::class, PostCatalogueService::class);
          $this->app->bind(PostCatalogueRepositoryInterface::class, PostCatalogueRepository::class);
          $this->app->bind(BaseServiceInterface::class,BaseService::class);

          // phan them bai viet
           $this->app->bind(PostServiceInterface::class, PostService::class);
          $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
         
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
