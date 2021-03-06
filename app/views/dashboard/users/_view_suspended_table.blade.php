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
                <th>@lang('main.returning_user')</th>
                <th>@lang('main.end_delete')</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($suspended as $k=>$user)
            <tr>
                <th>{{ $k+1 }}  </th>
                <td> {{ $user->name }} </td>
                <td> {{ $user->username }} </td>
                <td> {{ $user->formattedCreatedDate() }}</td>
                {{--<td class="green-text">Active</td>--}}
                @if(PerC::isShow('main_info','users','edit'))
                    <td>
                        <a href="{{URL::route('returningUser',$user->id)}}" class="btn btn-small z-depth-0">
                            <i class="fa fa-play"></i>
                        </a>
                    </td>
                @endif
                @if(PerC::isShow('main_info','users','delete'))
                    <td>
                        <a onclick="return confirm('هل تريد بالفعل حذف هذا المستخدم ')"
                           href="{{ URL::route('finaDeleteUser',array($user->id)) }}"
                           class="btn btn-small btn-danger red">[X]</a>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>