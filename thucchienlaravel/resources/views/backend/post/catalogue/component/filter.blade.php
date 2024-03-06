<form action="{{ route('post.catalogue.index') }}" method="get">
    <div class="filter-wrapper">
        <div class="uk-flex-middle uk-flex-space-between">
            <div class="perpage">
                @php
                    $perpage = request('perpage') ?: old('perpage');
                @endphp
                <div class="uk-flex-middle uk-flex-space-between">
                    <select name="perpage" class="form-control input-sm perpage filter mr10">
                        @for ($i = 20; $i <= 200; $i += 20)
                            <option {{ $perpage == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }} bản ghi</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="action">
                <div class="uk-flex uk-flex-middle">
             
 @php
               $publishArray=[
               0=>'chon hinh thuc ',
               1=>'khong xuat ban ',
               2=>'chon xuat ban '];
               $publishs = request('publish')?:old('publish');

               @endphp
                    <select name="publish" class="form-control mr10 setupSelect2">

                       
                        @foreach($publishArray as $key=>$publish)
                        <option {{($publishs==$key)?'selected':''}} value="{{$key}}">{{ $publish}}</option>
                         
                         @endforeach
                        

                    </select>

                    <div class="uk-search uk-flex uk-flex-middle mr10">
                        <div class="input-group">
                            <input type="text"
                                name="keyword"
                                value="{{ request('keyword') ?: old('keyword') }}"
                                placeholder="Nhập từ khóa bạn muốn tìm kiếm"
                                class="form-control"
                            >
                            <span class="input-group-btn">
                                <button type="submit" name="search" value="search" class="btn btn-primary mb0  btn-sm">Tìm kiếm</button>
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('post.catalogue.create') }}" class="btn btn-danger">
                        <i class="fa fa-plus mr5"></i>Thêm mới nhom bai viet
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
