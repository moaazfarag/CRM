    <div class="card">
        <div class="content">
            <div class="table-responsive" >
              <table id="" class="display table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>@lang('main.number')</th>
                    <th>@lang('main.name') </th>
                    @if(PerC::isShow('hr','Departments','edit'))
                        <th>@lang('main.edit')</th>
                    @endif
                    @if(PerC::isShow('hr','Departments','delete'))
                        <th>@lang('main.delete')</th>
                        <th>
                            {{ Form::open(array('route'=>'multiDeleteDep')) }}
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
                        @if(PerC::isShow('hr','Departments','edit'))
                            <td>
                                <a href="{{ URL::route('editDep',array($tableData->id)) }}" class="btn btn-small z-depth-0">
                                    <i class="mdi mdi-editor-mode-edit"></i>
                                </a>
                            </td>
                        @endif
                        @if(PerC::isShow('hr','Departments','delete'))
                            <td>
                                <a onclick="return confirm(' هل تريد بالفعل حذف القسم ')"
                                   href="{{ URL::route('deleteDep',array($tableData->id)) }}"
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



