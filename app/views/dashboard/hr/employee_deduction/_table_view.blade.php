    <table id="table_bank" class="display table table-bordered table-striped table-hover">
        <thead>
        <tr>

            <th>@lang('main.employee') </th>
            <th>@lang('main.clause') </th>
            <th>@lang('main.value') </th>
            <th>@lang('main.edit')  </th>
            <th>@lang('main.cancel_')  </th>

        </tr>
        </thead>
        <tbody>
        @foreach($tablesData as $tableData)
            <tr>
                <td>{{ @$tableData->employees->name }}</td>
                <td>{{ @$tableData->desded()->first()->name}}</td>
                <td>{{ @$tableData->val }}</td>

                <td>
                    <a href="{{ URL::route('editEmpdesded',array($tableData->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-editor-mode-edit"></i>
                    </a>
                </td>
                <td>
                    <a  onclick="return confirm('هل تريد بالفعل إلغاء هذا الإستحقاق ')" href="{{ URL::route('deleteEmpdesded',array($tableData->id)) }}" class="btn btn-danger red">[X]</a>
                </td>

            </tr>

        @endforeach

        </tbody>
    </table>
