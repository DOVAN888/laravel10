<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox" name="" >
            </th>
            <th>Ten nhom thanh vien </th>
          
              <th class="text-center">so thanh vien </th>
             <th>Mo Ta  </th>
            <th class="text-center">Tinh trang</th>
            <th class="text-center">thao tac</th>
        </tr>
    </thead>
    <tbody>

                  
        @if(request()->has('keyword') && !empty(request('keyword')))
           
            @forelse($userCatalogues as $userCatalogue)
                <tr>
                    <td><input type="checkbox" value="{{$userCatalogue->id}}" class="checkBoxItem" name=""></td>
                    <td>{{ $userCatalogue->name }}</td>
                  
                        <td class="text-center">{{$userCatalogue->users_count}}nguoi</td>
                    <td>{{ $userCatalogue->description }}</td>
                    
                     <td>
                        <input 
                            type="checkbox" 
                            class="js-switch status js-switch-{{$userCatalogue->id}}" 
                            data-field="publish" 
                            data-model="userCatalogue" 
                            data-modelId="{{ $userCatalogue->id }}" 
                            value="{{ $userCatalogue->publish }}" 
                            {{ $userCatalogue->publish == 2 ? 'checked' : '' }}
                        >
                    </td>

                                        <td class="text-center">
                        <a href="{{ route('user.catalogue.edit', $userCatalogue->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('user.catalogue.delete', $userCatalogue->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>


            @empty
                <tr>
                    <td colspan="7">Không có kết quả người dùng được hiển thị</td>
                </tr>
            @endforelse

            <tr>
                    <td colspan="7">
                       <button> <a href="{{ route('user.catalogue.index') }}"> Trang userCatalogue</a></button>
                    </td>
                </tr>

               {{$userCatalogues->links('pagination::bootstrap-4') }}

        @else
            @forelse($userCatalogues as $userCatalogue)
                <tr>
                    <td><input type="checkbox" value="{{$userCatalogue->id}}" class="checkBoxItem" name=""></td>
                    <td>{{ $userCatalogue->name }}</td>
                       
                      <td class="text-center">{{$userCatalogue->users_count}}nguoi</td>
                     <td>{{ $userCatalogue->description }}</td>
                   
                    <td>
                       <input 
                            type="checkbox" 
                            class="js-switch status js-switch-{{$userCatalogue->id}}" 
                            data-field="publish" 
                            data-model="UserCatalogue" 
                            data-modelId="{{ $userCatalogue->id }}" 
                            value="{{ $userCatalogue->publish }}" 
                            {{ $userCatalogue->publish == 2 ? 'checked' : '' }}
                        >
                    </td>
                    <td class="text-center">
                        <a href="{{ route('user.catalogue.edit', $userCatalogue->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('user.catalogue.delete', $userCatalogue->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
{{ $userCatalogues->links('pagination::bootstrap-4') }}
