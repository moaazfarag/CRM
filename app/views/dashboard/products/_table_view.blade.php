<div class="card-panel">

    @if(Session::has('error'))
        <div id="hidden" class="alert" >

            {{ Session::get('error') }}
        </div>
    @endif

    @if(Session::has('success'))

        <div  id="hidden" class="alert green lighten-4 green-text text-darken-2">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class="table table-hover">
        <thead>
        <tr>
            <th>@lang('main.number')</th>
                <th>@lang('main.name') </th>

            @if(Route::currentRouteName() == 'addModel')
            <th>@lang('main.marka') </th>
            @endif
            <th>@lang('main.statue') </th>
            <th>@lang('main.edit')</th>
            <th>@lang('main.delete')</th>

        </tr>
        </thead>
        <tbody>
        @foreach($tablesData as $tableData)
            <tr>
                <th>{{ $tableData->true_id }}</th>
                <td>{{ $tableData->name }}</td>
                @if(Route::currentRouteName() == 'addModel')
                <td>{{ $tableData->getMarkName() }}</td>
                @endif
                <td class="green-text">Active</td>
                <td>
                    <a href="{{ URL::route($catFunName,array($tableData->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-editor-mode-edit"></i>
                    </a>
                </td>
                <td>
                    @if(Route::currentRouteName() == 'addModel')
                        <a  onclick="return confirm('هل تريد بالفعل حذف  الموديل')" href="{{ URL::route('deleteModel',array($tableData->id)) }}" class="btn btn-danger red">[X]</a>
                    @elseif(Route::currentRouteName() == 'addMark')
                        <a  onclick="return confirm('هل تريد بالفعل حذف  الماركة ')" href="{{ URL::route('deleteMark',array($tableData->id)) }}" class="btn btn-danger red">[X]</a>

                    @endif
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>