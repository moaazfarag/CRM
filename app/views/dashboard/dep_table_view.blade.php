<div class="card-panel">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>@lang('main.number')</th>
            <th>@lang('main.name') </th>
            <th>@lang('main.edit')</th>

        </tr>
        </thead>
        <tbody>
        @foreach($tablesData as $tableData)
            <tr>
                <th>{{ $tableData->id }}</th>
                <td>{{ $tableData->name }}</td>
                <td>
                    <a href="{{ URL::route('editDep',array($tableData->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-editor-mode-edit"></i>
                    </a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>