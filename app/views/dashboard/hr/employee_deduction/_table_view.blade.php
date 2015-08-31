<div class="card-panel">
    <table  id="table_customers" class="table table-hover">
        <thead>
        <tr>

            <th>الموظف </th>
            <th>البند </th>
            <th>القيمه </th>
            <th> تعديل  </th>
            <th> إلغاء  </th>

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
                    <a  onclick="return confirm('هل تريد بالفعل حذف هذا الإستحقاق ')" href="{{ URL::route('deleteEmpdesded',array($tableData->id)) }}" class="btn btn-danger red">[X]</a>
                </td>

            </tr>

        @endforeach

        </tbody>
    </table>
</div>