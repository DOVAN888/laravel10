<div class="overflow">
    @include('backend.dashboad.component.breadcrumb', ['title' => $config['seo'][$config['method']]['title']])
    {{$config['seo'][$config['method']]['title']}}
    
    <?php
    $url = ($config['method'] == 'create') ? route('post.post.store') : route('post.post.update', $posts->id);
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
                           @include('backend.post.post.component.general')
                           @include('backend.post.post.component.album')
                              @include('backend.post.post.component.seo')

                             
    
    
                           
    
               
               </div>
    </form>
</div>
