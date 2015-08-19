<div class="card-panel">
    <table class="table table-hover">
        <thead>
        <tr>

            <th>التسلسل </th>
            <th>الموظف </th>
            <th>تاريخ السلفه</th>
            <th>المبلغ </th>
            <th>القسط</th>
            <th>تاريخ البدايه  </th>
            <th>تاريخ الانتهاء  </th>

        </tr>
        </thead>
        <tbody>
        @foreach($tablesData as $tableData)
            <tr>
                <th>{{ $tableData->id }}</th>
                <td>{{ $tableData->employees->name }}</td>
                <td>{{ $tableData->loan_date }}</td>
                <td>{{ $tableData->loan_val }}</td>
                <td>{{ $tableData->loan_currBal }}</td>
                <td>{{ $tableData->loan_start }}</td>
                <td>{{ $tableData->loan_end }}</td>
                <td>
                    <a href="{{ URL::route('editLoans',array($tableData->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-editor-mode-edit"></i>
                    </a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>