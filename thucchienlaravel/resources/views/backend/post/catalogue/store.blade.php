<div class="overflow">
    @include('backend.dashboad.component.breadcrumb', ['title' => $config['seo'][$config['method']]['title']])
    {{$config['seo'][$config['method']]['title']}}
    
    <?php
    $url = ($config['method'] == 'create') ? route('post.catalogue.store') : route('post.catalogue.update', $postCatalogues->id);
    ?>
     @include('alert')      

    <form action="{{ $url }}" method="post" class="box">
        @csrf
        <div class="wrapper wrapper-content animated fadeInRight">
    
            <!-- hang1... -->
            <div class="row">
    
                <div class="col-lg-9">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Thông tin chung</h5>
                        </div>
                        <div class="ibox-content">
                           @include('backend.post.catalogue.component.general')
                           @include('backend.post.catalogue.component.album')
                              @include('backend.post.catalogue.component.seo')

                                @include('backend.post.catalogue.component.aside')
    
    
                           
    
               
               </div>
    </form>
</div>
