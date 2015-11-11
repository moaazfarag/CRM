<div class="table-responsive" >
<table id="table_customers" class="display table table-bordered  table-hover">
    <thead>
    <tr>
        <th>@lang('main.serialNum')</th>
        <th>@lang('main.name')</th>
        <th>@lang('main.username')</th>
        <th> ت الاضافة</th>
        <th>@lang('main.statue') </th>
        @if(PerC::isShow('main_info','users','edit'))
            <th>@lang('main.edit')</th>
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
            <td class="green-text">Active</td>
            @if(PerC::isShow('main_info','users','edit'))
                <td>
                    <a href="{{URL::route('editUser',$user->id)}}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-editor-mode-edit"></i>
                    </a>
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
    </div>