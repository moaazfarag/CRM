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
            <th>@lang('main.stop')</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($company->users as $k=>$user)
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
                    @if($user->owner != 'acount_creator')
                        <a onclick="return confirm('هل تريد بالفعل إيقاف هذا المستخدم ')"
                           href="{{ URL::route('suspendUser',array($user->id)) }}"
                           class="btn btn-small btn-danger red accent-1"><i class="fa fa-pause"></i></a>
                    @endif
            </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
    </div>