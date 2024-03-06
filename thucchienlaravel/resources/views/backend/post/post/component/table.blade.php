<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox" name="" >
            </th>
            <th class="text-center" style="width:100px;">anh dai dien</th>
            <th class="text-center" style="width:500px;">tieu de</th>
              <th class="text-center" style="width:100px;">vi tri </th>
        
        
            <th class="text-center">Tinh trang</th>
            <th class="text-center">thao tac</th>
        </tr>
    </thead>
    <tbody>

                  
        @if(request()->has('keyword') && !empty(request('keyword')))
           
            @forelse($posts as $post)
                <tr>
                    <td><input type="checkbox" value="{{$post->id}}" class="checkBoxItem" name=""></td>

                    <td>
                        <span class="image img-cover"><img src="{{$post->image}}"alt="" ></span>

                    </td>
                    <td>
                 {{ 
                    $post->name
                   }}
                </td>

                    

                     <td>
                        <input 
                            type="checkbox" 
                            class="js-switch status js-switch-{{$post->id}}" 
                            data-field="publish" 
                            data-model="Post" 
                            data-modelId="{{ $post->id }}" 
                            value="{{ $post->publish }}" 
                            {{ $post->publish == 2 ? 'checked' : '' }}
                        >
                    </td>

                             <td class="text-center">
                        <a href="{{ route('post.post.edit', $post->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('post.post.delete', $post->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>


            @empty
                <tr>
                    <td colspan="7">Không có kết quả người dùng được hiển thị</td>
                </tr>
            @endforelse

            <tr>
                    <td colspan="7">
                       <button> <a href="{{ route('post.post.index') }}"> Trang postCatalogue</a></button>
                    </td>
                </tr>

               {{$posts->links('pagination::bootstrap-4') }}

        @else
            @forelse($posts as $post)
                    <td><input type="checkbox" value="{{$post->id}}" class="checkBoxItem" name=""></td>
                    <td>

                        <span class="image img-cover">
                            <img src="{{$post->image}}" alt>
                        </span>
                    </td>

                      <td>
                        <div class="main-info">
                            <div class="name"><span class="maintitle">
                                 {{ $post->name}}
                                </span>

                            </div>
                            
                            <div class="catalogue">
                                <span class="text-danger">nhom hien thi:</span>
                                @foreach($post->post_catalogues as $val)
                                @foreach($val->post_catalogue_language as $cat)
                                <a href="{{route('post.post.index',['post_catalogue_id'=>$val->id])}}" title="">
                                    {{$cat->name}}
                                  </a>
                                   @endforeach
                            </div>
                             @endforeach

                        </div>

                
                </td>
                <td>
                    <input 
                    type="text" 
                    name="order" 
                    value="{{$post->order}}" 
                    class="form-control sort-order" 
               
                    data-id="{{ $post->id }}" 
                    data-model="{{$config['model']}}"

                     >
                </td>
               
                    
                    <td>
                       <input 
                            type="checkbox" 
                            class="js-switch status js-switch-{{$post->id}}" 
                            data-field="publish" 
                            data-model="Post" 
                            data-modelId="{{ $post->id }}" 
                            value="{{ $post->publish }}" 
                            {{ $post->publish == 2 ? 'checked' : '' }}
                            >

                    </td>
                    <td class="text-center">
                        <a href="{{ route('post.post.edit', $post->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('post.post.delete', $post->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
{{ $posts->links('pagination::bootstrap-4') }}
