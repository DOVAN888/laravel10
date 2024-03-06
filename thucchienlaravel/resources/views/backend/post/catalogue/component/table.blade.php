<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox" name="" >
            </th>
            <th>anh dai dien</th>
            <th style="width:500px;">Ten nhom </th>
          
              <th>Canonical</th>
          
            
            <th class="text-center">Tinh trang</th>
            <th class="text-center">thao tac</th>
        </tr>
    </thead>
    <tbody>

                  
        @if(request()->has('keyword') && !empty(request('keyword')))
           
            @forelse($postCatalogues as $postCatalogue)
                <tr>
                    <td><input type="checkbox" value="{{$postCatalogue->id}}" class="checkBoxItem" name=""></td>

                    <td>
                        <span class="image img-cover"><img src="{{$postCatalogue->image}}"alt="" ></span>

                    </td>
                    <td>
                 {{ 
                    str_repeat('|-----',(($postCatalogue->level>0)?($postCatalogue->level -1 ):0)).$postCatalogue->name
                   }}
                </td>

                       <td>
                         <a href="http://vantuongcongnghe.com:8000/.html{{ $postCatalogue->canonical }}.html">
                      http://vantuongcongnghe.com:8000/.html{{ $postCatalogue->canonical }}.html
                           </a>
                            </td>

                  
                       
                    

                    
                     <td>
                        <input 
                            type="checkbox" 
                            class="js-switch status js-switch-{{$postCatalogue->id}}" 
                            data-field="publish" 
                            data-model="PostCatalogue" 
                            data-modelId="{{ $postCatalogue->id }}" 
                            value="{{ $postCatalogue->publish }}" 
                            {{ $postCatalogue->publish == 2 ? 'checked' : '' }}
                        >
                    </td>

                                        <td class="text-center">
                        <a href="{{ route('post.catalogue.edit', $postCatalogue->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('post.catalogue.delete', $postCatalogue->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>


            @empty
                <tr>
                    <td colspan="7">Không có kết quả người dùng được hiển thị</td>
                </tr>
            @endforelse

            <tr>
                    <td colspan="7">
                       <button> <a href="{{ route('post.catalogue.index') }}"> Trang postCatalogue</a></button>
                    </td>
                </tr>

               {{$postCatalogues->links('pagination::bootstrap-4') }}

        @else
            @forelse($postCatalogues as $postCatalogue)
                <tr>
                    <td><input type="checkbox" value="{{$postCatalogue->id}}" class="checkBoxItem" name=""></td>
                    <td>

                        <span class="image img-cover">
                            <img src="{{$postCatalogue->image}}" alt>
                        </span>
                    </td>

                      <td>
                 {{ 
                    str_repeat('|-----',(($postCatalogue->level>0)?($postCatalogue->level -1 ):0)).$postCatalogue->name
                   }}
                </td>
                        <td>
                         <a href="http://vantuongcongnghe.com:8000/.html{{ $postCatalogue->canonical }}.html">
                      http://vantuongcongnghe.com:8000/.html{{ $postCatalogue->canonical }}.html
                           </a>
                            </td>

                  
                       
               
                    
                    <td>
                       <input 
                            type="checkbox" 
                            class="js-switch status js-switch-{{$postCatalogue->id}}" 
                            data-field="publish" 
                            data-model="postCatalogue" 
                            data-modelId="{{ $postCatalogue->id }}" 
                            value="{{ $postCatalogue->publish }}" 
                            {{ $postCatalogue->publish == 2 ? 'checked' : '' }}
                            >

                    </td>
                    <td class="text-center">
                        <a href="{{ route('post.catalogue.edit', $postCatalogue->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('post.catalogue.delete', $postCatalogue->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Không có kết quả người dùng được hiển thị</td>
                    
                </tr>
            @endforelse
        @endif
    </tbody>
</table>
{{ $postCatalogues->links('pagination::bootstrap-4') }}
