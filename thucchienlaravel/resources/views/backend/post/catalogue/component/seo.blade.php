 <div class="col-lg-9">
      
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Cấu hình SEO</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="seo-container">
    <div class="h3 meta-title">
        {{ old('meta_title', $postCatalogues->meta_title ?? '') }}
    </div>

  <div class="canonical">
    {{
        old('canonical', isset($postCatalogues) ? $postCatalogues->canonical : '')
            ? config('app.url') . old('canonical', isset($postCatalogues) ? $postCatalogues->canonical : '') . config('apps.general.suffix')
            : 'https://duong_dan_cua_ban.html'
    }}
</div>


    <div class="meta_description">
        {{ old('meta_description', $postCatalogues->meta_description ?? '') }}
    </div>
</div>

                            <div class="seo-wrapper">

                            	 
                                <div class="row mb15">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-right">
                                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                    <span>Mô tả SEO</span>
                                                    <span class="count_meta-title">0 ký tự</span>
                                                </div>
                                            </label>
    
                                         <input type="text" name="meta_title" value="{{ old('meta_title', ($postCatalogues->meta_title ) ?? '') }}" class="form-control  post" placeholder="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>


                                <div class="row mb15">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-right">
                                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                    <span>Từ khóa SEO</span>
                                                    
                                                </div>
                                            </label>
    
                                            <input type="text" name="meta_keyword" value="{{ old('meta_keyword', ($postCatalogues->meta_keyword ) ?? '') }}" class="form-control  post" placeholder="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
    
                               
                                <div class="row mb15">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-right">
                                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                    <span>Mô tả SEO</span>
                                                    <span class="count_meta-title">0 ký tự</span>
                                                </div>
                                            </label>
    
                                           <textarea name="meta_description" class="form-control post ck-editor" placeholder="" autocomplete="off">
                                            {{ old('meta_description', $postCatalogues->meta_description ?? '') }}
                                        </textarea>

                                        </div>
                                    </div>
                                </div>

                                <div class="row mb15">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-right">
                                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                    <span>duong dan </span>
                                                   
                                                </div>
                                            </label>

                                            <div class="input-wrapper">
    
                                            <input type="text" name="canonical" value="{{ old('canonical', ($postCatalogues->canonical ) ?? '') }}" class="form-control post" placeholder="" autocomplete="off">
                                            <span class="baseUrl" >{{env('APP_URL')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Thêm các phần tử khác tại đây nếu cần -->
                                 <div class="text-left mb15">
                            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
                        </div>
    
                            </div>
                        </div>
                       
                    </div>
                </div> 