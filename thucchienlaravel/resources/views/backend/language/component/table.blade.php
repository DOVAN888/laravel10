<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox" name="" >
            </th>
            <th style="height:100px;width: 100px;">anh dai dien</th>
            <th>Ten nhom ngon ngu</th>
          
              <th>Canonical</th>
             <th>mo ta</th>
            
            <th class="text-center">Tinh trang</th>
            <th class="text-center">thao tac</th>
        </tr>
    </thead>
    <tbody>

                  
        @if(request()->has('keyword') && !empty(request('keyword')))
           
            @forelse($languages as $language)
                <tr>
                    <td><input type="checkbox" value="{{$language->id}}" class="checkBoxItem" name=""></td>

                    <td>
                        <span class="image img-cover"><img src="{{$language->image}}"alt="" ></span>

                    </td>
                    <td>{{ $language->name }}</td>
                       <td>{{ $language->canonical }}</td>
                  
                       
                    <td>{{ $language->description }}</td>
                    
                     <td>
                        <input 
                            type="checkbox" 
                            class="js-switch status js-switch-{{$language->id}}" 
                            data-field="publish" 
                            data-model="language" 
                            data-modelId="{{ $language->id }}" 
                            value="{{ $language->publish }}" 
                            {{ $language->publish == 2 ? 'checked' : '' }}
                        >
                    </td>

                                        <td class="text-center">
                        <a href="{{ route('languages.edit', $language->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('languages.delete', $language->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>


            @empty
                <tr>
                    <td colspan="7">Không có kết quả người dùng được hiển thị</td>
                </tr>
            @endforelse

            <tr>
                    <td colspan="7">
                       <button> <a href="{{ route('language.index') }}"> Trang language</a></button>
                    </td>
                </tr>

               {{$languages->links('pagination::bootstrap-4') }}

        @else
            @forelse($languages as $language)
                <tr>
                    <td><input type="checkbox" value="{{$language->id}}" class="checkBoxItem" name=""></td>
                    <td>

                        <span class="image img-cover" >

                            <img src="{{$language->image}}" alt>
                        </span>
                    </td>

                   <td>{{ $language->name }}</td>
                       <td>{{ $language->canonical }}</td>
                  
                       
                    <td>{{ $language->description }}</td>
                    
                    <td>
                       <input 
                            type="checkbox" 
                            class="js-switch status js-switch-{{$language->id}}" 
                            data-field="publish" 
                            data-model="language" 
                            data-modelId="{{ $language->id }}" 
                            value="{{ $language->publish }}" 
                            {{ $language->publish == 2 ? 'checked' : '' }}
                        >
                    </td>
                    <td class="text-center">
                        <a href="{{ route('language.edit', $language->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('language.delete', $language->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
{{ $languages->links('pagination::bootstrap-4') }}
