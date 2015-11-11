<div class="card">
    <div class="content">
        <div class="table-responsive" >

        <table id="table_bank" class="display table table-bordered table-striped table-hover">
            <thead>
            <tr>

                <th>@lang('main.employee') </th>
                <th>@lang('main.clause') </th>
                <th>@lang('main.value') </th>
                @if(PerC::isShow('hr','Empdesded','edit'))
                    <th>@lang('main.edit')  </th>
                @endif
                @if(PerC::isShow('hr','Empdesded','delete'))
                    <th>@lang('main.cancel_')  </th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($tablesData as $tableData)
                <tr>
                    <td>{{ @$tableData->employees->name }}</td>
                    <td>{{ @$tableData->desded()->first()->name}}</td>
                    <td>{{ @$tableData->val }}</td>
                    @if(PerC::isShow('hr','Empdesded','edit'))
                        <td>
                            <a href="{{ URL::route('editEmpdesded',array($tableData->id)) }}"
                               class="btn btn-small z-depth-0">
                                <i class="mdi mdi-editor-mode-edit"></i>
                            </a>
                        </td>
                    @endif
                    @if(PerC::isShow('hr','Empdesded','delete'))
                        <td>
                            <a onclick="return confirm('هل تريد بالفعل إلغاء هذا الإستحقاق ')"
                               href="{{ URL::route('deleteEmpdesded',array($tableData->id)) }}"
                               class="btn btn-danger red">[X]</a>
                        </td>
                    @endif
                </tr>

            @endforeach

            </tbody>
        </table>
            </div>
    </div>
</div>