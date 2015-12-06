<div class="card-panel">
    <div class="table-responsive" >
        <table id="" class="display table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>@lang('main.number')</th>
            <th>@lang('main.name') </th>
            @if(PerC::isShow('hr','jobs','edit'))
                <th>@lang('main.edit')</th>
            @endif
            @if(PerC::isShow('hr','jobs','delete'))
                <th>@lang('main.delete')</th>
                <th>
                    {{ Form::open(array('route'=>'multiDeleteJob')) }}
                    <button  class="btn btn-small red" style="float: right;">إلغاء  المحدد</button>
                </th>

            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($tablesData as $k=>$tableData)
            <tr>
                <th>{{ $tableData->true_id }}</th>
                <td>{{ $tableData->name }}</td>
                @if(PerC::isShow('hr','jobs','edit'))
                    <td>
                        <a href="{{ URL::route('editJob',array($tableData->id)) }}" class="btn btn-small z-depth-0">
                            <i class="mdi mdi-editor-mode-edit"></i>
                        </a>
                    </td>
                @endif
                @if(PerC::isShow('hr','jobs','delete'))
                    <td>
                        <a onclick="return confirm('هل تريد بالفعل حذف الوظيفة')"
                           href="{{ URL::route('deleteJob',array($tableData->id)) }}" class="btn btn-danger red">[X]</a>
                    </td>
                    <td>
                        <input type="checkbox" id="checkbox{{ $k }}" name="checkbox[]"  value="{{ $tableData->id }}" />
                        <label for="checkbox{{ $k }}"></label>
                    </td>
                @endif
            </tr>
        @endforeach
        {{ Form::close() }}
        </tbody>
    </table>
   </div>
</div>