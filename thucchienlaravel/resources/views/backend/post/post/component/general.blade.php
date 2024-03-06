
<div class="row mb15" >
							
					<div class="col-lg-12" style="width: 900px;">

							<div class="form-row">
								<label for="" class="control-lable text-left">
									teu de bai viet<span class="text-danger">(*)</span>
								</label>
								
								<input 
									type="text" 
									name="name"
									value="{{old('name',($posts->name ) ?? '')}}"
									class="form-control post"
									placeholder=""
									autocomplete="off" 
									id=""
									data-height="500" 
									>
									
								
								
								
						</div>
					</div>
						</div>
						

						<div class="row mb15">
									
						<div class="col-lg-12">
							<div class="form-row">
								<label for="" class="control-lable text-left">
									mo ta ngan 
								</label>
								<textarea

							    type="text"
							    name="description"
							    class="form-control post ck-editor"
							    placeholder=""
							    autocomplete="off"
							    id="description"
							>
							  {{ old('description', $posts->description ?? '') }}
							</textarea>

								
								
						</div>
					</div>
						</div>

						<div class="row mb15">
									
						<div class="col-lg-12">
							<div class="form-row">
								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<label for="" class="control-lable text-left">
									noi dung 
								</label>

									<a href="" class="multiplUpdateImageCkeidtor " data-target="ckContent">up load nhieu hinh anh</a>

									
								</div>
								
								

							 <textarea name="content"  class="form-control post ck-editor" placeholder="" autocomplete="off"id="ckContent">
                                            {{ old('content', $posts->content ?? '') }}
                                 </textarea>


								
								
								
						</div>
					</div>
						</div>
						

						

					</div>
					

				</div>
				
			</div>

 <div class="col-lg-3">
               <div class="ibox">
                                    <div class="ibox-title">
                                     
                                        <h5>Nhập thông tin ngôn ngữ</h5>
                                    </div>
    
                                    <div class="ibox-content">
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <label for="" class="control-label text-left">
                                                        chon danh muc cha 
                                                        <span class="text-danger">(*)</span>
                                                    </label>
                                                    <span class="text-danger notice"mb10>
                                                    	(*)chon root neu khong co danh muc cha 
                                                    	
                                                    </span>

    
	                                       
	                                        <select name="post_catalogue_id" class="form-control setupSelect2" id="your_unique_id_here">
										    @foreach($dropdown as $key => $val)
										        <option value="{{ $key }}" {{ $key == old('post_catalogue_id', (isset($posts->post_catalogue_id) ? $posts->post_catalogue_id : '')) ? 'selected' : '' }}>
										            {{ $val }}
										        </option>
										    @endforeach
										</select>


	                                                </div>
                                            </div>
                                          
                                    </div>

                                    @php
                                   $catalogue =[];
                                   if(isset($posts)){
                                   foreach($posts->post_catalogues as $key =>$val)
                                   $catalogue[] = $val->id;
                               }
                                    @endphp

                                    	  <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                	<label class="control-label"> Danh muc phu </label>
                                            
	                                      <select multiple name="catalogue[]" class="form-control setupSelect2" id="your_unique_id_here">
								    @foreach($dropdown as $key => $val)
								        <option value="{{ $key }}" 
								            @if(is_array(old('catalogue', (isset( $catalogue) && count($catalogue)) ? $catalogue : [])) && in_array($key, old('catalogue', (isset($catalogue)) ? $catalogue : [])))
								                selected
								            @endif
								        >
								            {{ $val }}
								        </option>
								    @endforeach
								</select>



	                                                </div>
                                            </div>
                                          
                                    </div>

                                </div>

                                 <div class="ibox">
                                    <div class="ibox-title">

                                     
                                        <h5>chon anh dai dien </h5>
                                      
                                    </div>
    
                                    <div class="ibox-content">
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                   <span class="image image-target"> <img src=" {{ old('image', $posts->image ??' backend/img/notfound.png') }}" alt="">  </span>
                                                   <input type="hidden" name="image"value="{{ old('image', $posts->image ?? '') }}">
                                                   
                                                </div>
                                            </div>
                                          
                                    </div>
                                </div>

                                    <div class="ibox">
                                    <div class="ibox-title">

                                      
                                        <h5>Cau Hinh nag cao   </h5>
                                      
                                    </div>
    
                                    <div class="ibox-content">
                                     <div class="row mb15">
    <div class="col-lg-12">
        <div class="form-row">
            <select name="publish" class="form-control setupSelect2 status" id="">
                @foreach(config('apps.general.publish') as $key => $val)
                    <option value="{{$key}}" {{ ($key == old('publish', (isset($posts->publish) ? $posts->publish : ''))) ? 'selected' : '' }}>
                        {{$val}}
                    </option>
                @endforeach
            </select>

            <select name="follow" class="form-control setupSelect2" id="">
                @foreach(config('apps.general.follow') as $key => $val)
                    <option value="{{$key}}" {{ ($key == old('follow', (isset($postCatalogues->follow) ? $posts->follow : ''))) ? 'selected' : '' }}>
                        {{$val}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

                                </div>

                                



                            </div>

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>