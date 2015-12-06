<div class="card">
    <div class="content">

        <div class="table-responsive" >
          <table id="" class="display table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>@lang('main.clause') </th>
                <th>@lang('main.clause_type')  </th>
                <th>@lang('main.clause_nature') </th>
                @if(PerC::isShow('hr','Desdeds','edit'))
                    <th> @lang('main.edit') </th>
                @endif
                @if(PerC::isShow('hr','Desdeds','delete'))
                    <th>@lang('main.delete') </th>
                    <th>
                        {{ Form::open(array('route'=>'multiDeleteDesded')) }}
                        <button  class="btn btn-small red" style="float: right;">إلغاء  المحدد</button>
                    </th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($tablesData as $k => $tableData)
                <tr>
                    <td>{{ $tableData->name }}</td>
                    <td>{{ $tableData->ds_type }}</td>
                    <td>{{ $tableData->ds_cat }}</td>
                    @if(PerC::isShow('hr','Desdeds','edit'))
                        <td>
                            <a href="{{ URL::route('editDesded',array($tableData->id)) }}"
                               class="btn btn-small z-depth-0">
                                <i class="mdi mdi-editor-mode-edit"></i>
                            </a>
                        </td>
                    @endif
                    @if(PerC::isShow('hr','Desdeds','delete'))
                        <td>
                            <a onclick="return confirm('هل تريد بالفعل حذف هذا البند ')"
                               href="{{ URL::route('deleteDesded',array($tableData->id)) }}"
                               class="btn btn-danger red">[X]</a>
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
</div>