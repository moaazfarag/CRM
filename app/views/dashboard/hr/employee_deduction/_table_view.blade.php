<div class="card-panel">
    <table class="table table-hover">
        <thead>
        <tr>

            <th>البند </th>
            <th>القيمه </th>
            <th> تغديل  </th>

        </tr>
        </thead>
        <tbody>
        @foreach($tablesData as $tableData)
            <tr>
                <td>{{ $tableData->desded->name }}</td>
                <td>{{ $tableData->val }}</td>
                <td>
                    <a href="{{ URL::route('editEmpdesded',array($tableData->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-editor-mode-edit"></i>
                    </a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>