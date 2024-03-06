<div class="ibox" id="anh">
    <div class="ibox-title">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <h5>album anh</h5>
            <div class="upload-abum">
                <a href="" class="upload-picture">
                    chon hinh
                </a>
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div class="row">
            <!-- 	<div class="col-lg-12">
                    
                </div> -->
            @if(!isset($album) || count($album) == 0)

            <div class="click-to-upload">
                <div class="icon">
                    <a href="" class="upload-picture">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="12" cy="12" r="3"></circle>
                            <line x1="17.5" y1="6.5" x2="6.5" y2="17.5"></line>
                        </svg>
                    </a>
                </div>
                <div class="small-text">
                    su dung nut chon hinh click vao day de them hinh anh
                </div>
            </div>


             <div class="upload-list hidden">
                <div class="row">
                    <ul id="sortable" class="clearfix data-album sortui ui-sortable">

                    	     </ul>
                </div>
            </div>
            @endif

            @if(isset($album) && count($album))
            <div class="upload-list {{(count($album))? '' : 'hidden'}}">
                <div class="row">
                    <ul id="sortable" class="clearfix data-album sortui ui-sortable">
                        @foreach($album as $key => $val)
                        <li class="ui-state-default">
                            <div class="thumb">
                                <span class="span image img-scaledown" style="width:100px; height:100px;">
                                    <img src="{{ $val }}" alt="{{ $val }}">
                                    <input type="hidden" name="album[]" value="{{ $val }}">
                                </span>
                                <button class="delete-image"><i class="fa fa-trash"></i></button>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
