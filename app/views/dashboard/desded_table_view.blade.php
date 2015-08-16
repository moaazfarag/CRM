<div class="card-panel">
    <table class="table table-hover">
        <thead>
        <tr>

            <th>البند </th>
            <th>نوع البند </th>
            <th>طبيعه البند </th>

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
            </tr>

        @endforeach

        </tbody>
    </table>
</div>