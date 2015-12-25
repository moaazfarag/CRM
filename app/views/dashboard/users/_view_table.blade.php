<div class="table-responsive" >
<table id="" class="display table table-bordered  table-hover">
    <thead>
    <tr>
        <th>@lang('main.serialNum')</th>
        <th>@lang('main.name')</th>
        <th>@lang('main.username')</th>
        <th> ت الاضافة</th>
{{--        <th>@lang('main.statue') </th>--}}
        @if(PerC::isShow('main_info','users','edit'))
            <th>@lang('main.edit')</th>
            <th>@lang('main.delete')</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($users as $k=>$user)
        <tr>
            <th>{{ $k+1 }}  </th>
            <td> {{ $user->name }} </td>
            <td> {{ $user->username }} </td>
            <td> {{ $user->formattedCreatedDate() }}</td>
            {{--<td class="green-text">Active</td>--}}
            @if(PerC::isShow('main_info','users','edit'))
                <td>
                    <a href="{{URL::route('editUser',$user->id)}}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-editor-mode-edit"></i>
                    </a>
                </td>
            @endif
            @if(PerC::isShow('main_info','users','delete'))
            <td>
                <a onclick="return confirm('هل تريد بالفعل حذف هذا المستخدم ')"
                   href="{{ URL::route('deleteUser',array($user->id)) }}"
                   class="btn btn-danger red">[X]</a>
            </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
    </div>