
    <table id="table_bank" class="display table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>@lang('main.clause') </th>
            <th>@lang('main.clause_type')  </th>
            <th>@lang('main.clause_nature') </th>
            <th> @lang('main.edit') </th>
            <th>@lang('main.delete') </th>

        </tr>
        </thead>
        <tbody>
        @foreach($tablesData as $tableData)
            <tr>
                <td>{{ $tableData->name }}</td>
                <td>{{ $tableData->ds_type }}</td>
                <td>{{ $tableData->ds_cat }}</td>
                <td>
                    <a href="{{ URL::route('editDesded',array($tableData->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-editor-mode-edit"></i>
                    </a>
                </td>
                <td>
                    <a  onclick="return confirm('هل تريد بالفعل حذف هذا البند ')" href="{{ URL::route('deleteDesded',array($tableData->id)) }}" class="btn btn-danger red">[X]</a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
