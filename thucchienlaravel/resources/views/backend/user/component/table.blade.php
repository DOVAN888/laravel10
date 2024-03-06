<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox" name="" >
            </th>
            <th style="height:100px;width: 100px;"> anh dai dien  </th>
            <th>ho ten</th>
            <th>Chuc Vu </th>
            <th>Email</th>
            <th>so dien thoai</th>
            <th>dia chi</th>
            <th class="text-center">Tinh trang</th>
            <th class="text-center">thao tac</th>
        </tr>
    </thead>
    <tbody>
    
               
            </tr>
        @if(request()->has('keyword') && !empty(request('keyword')))
            
            @forelse($users as $user)
                <tr>
                    <td><input type="checkbox" value="{{$user->id}}" class="checkBoxItem" name=""></td>
                    <td><span class="image img-cover">
                        <img src="{{$user->image}}"alt>
                        </span>
                    </td>
                    <td>{{ $user->name }}</td>
                    
                   <td>{{  $user->user_catalogues->name  }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                     <td>
                        <input 
                            type="checkbox" 
                            class="js-switch status js-switch-{{$user->id}}" 
                            data-field="publish" 
                            data-model="User" 
                            data-model-id="{{ $user->id }}" 
                            value="{{ $user->publish }}" 
                            {{ $user->publish == 2 ? 'checked' : '' }}
                        >
                    </td>

                                        <td class="text-center">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>


            @empty
                <tr>
                    <td colspan="7">Không có kết quả người dùng được hiển thị</td>
                </tr>
            @endforelse

            <tr>
                    <td colspan="7">
                       <button> <a href="{{ route('user.index') }}"> Trang User</a></button>
                    </td>
                </tr>

               {{ $users->links('pagination::bootstrap-4') }}

        @else
            @forelse($users as $user)
                <tr>
                    <td><input type="checkbox" value="{{$user->id}}" class="checkBoxItem" name=""></td>
                    <td><span class="image img-cover">
                         <img src="{{$user->image}}"alt>
                        </span>
                    </td>
                    <td>{{ $user->name }}</td>
                 
                   <td>{{ $user->user_catalogues->name  }}</td>

                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td>
                       <input 
                            type="checkbox" 
                            class="js-switch status js-switch-{{$user->id}}" 
                            data-field="publish" 
                            data-model="User" 
                          data-modelId="{{ $user->id }}" 
                            value="{{ $user->publish }}" 
                            {{ $user->publish == 2 ? 'checked' : '' }}
                        >
                    </td>
                    <td class="text-center">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
{{ $users->links('pagination::bootstrap-4') }}