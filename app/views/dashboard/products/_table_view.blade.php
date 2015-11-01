<div class="card-panel">



    <table id="table_bank" class="display table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>@lang('main.number')</th>
            @if(Route::currentRouteName() == 'addModel' || Route::currentRouteName() == 'editModel')
                <th>@lang('main.model_name') </th>
            @elseif(Route::currentRouteName() == 'addMark' || Route::currentRouteName() == 'editMark')
                <th>@lang('main.marka') </th>

            @else
                <th>@lang('main.name') </th>
            @endif
            @if(Route::currentRouteName() == 'addModel' || Route::currentRouteName() == 'editModel')
            <th>@lang('main.marka') </th>
            @endif
            <th>@lang('main.edit')</th>
            <th>@lang('main.delete')</th>

        </tr>
        </thead>
        <tbody>
        @foreach($tablesData as $k=>$tableData)
            <tr>
                <th>{{ $k+1 }}</th>
                <td>{{ $tableData->name }}</td>
                @if(Route::currentRouteName() == 'addModel' || Route::currentRouteName() == 'editModel')
                <td>{{ $tableData->getMarkName() }}</td>
                @endif

                <td>
                    <a href="{{ URL::route($catFunName,array($tableData->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-editor-mode-edit"></i>
                    </a>
                </td>
                <td>
                    @if(Route::currentRouteName() == 'addModel' || Route::currentRouteName() == 'editModel')
                        <a  onclick="return confirm('هل تريد بالفعل حذف  الموديل')" href="{{ URL::route('deleteModel',array($tableData->id)) }}" class="btn btn-danger red">[X]</a>
                    @elseif(Route::currentRouteName() == 'addMark' || Route::currentRouteName() == 'editMark')
                        <a  onclick="return confirm('هل تريد بالفعل حذف  الماركة ')" href="{{ URL::route('deleteMark',array($tableData->id)) }}" class="btn btn-danger red">[X]</a>
                    @elseif(Route::currentRouteName() == 'addCategory' || Route::currentRouteName() == 'editCategory')
                        <a  onclick="return confirm('هل تريد بالفعل حذف  فئة الصنف ')" href="{{ URL::route('deleteCategory',array($tableData->id)) }}" class="btn btn-danger red">[X]</a>
                    @elseif(Route::currentRouteName() == 'addSeason' || Route::currentRouteName() == 'editSeason')
                        <a  onclick="return confirm('هل تريد بالفعل حذف  الموسم ')" href="{{ URL::route('deleteSeason',array($tableData->id)) }}" class="btn btn-danger red">[X]</a>

                    @endif
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>