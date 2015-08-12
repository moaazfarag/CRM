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
                <td>{{ $tableData->employees }}</td>
                <td>{{ $tableData->loanDate }}</td>
                <td>{{ $tableData->loanVal }}</td>
                <td>{{ $tableData->loanCurrBal }}</td>
                <td>{{ $tableData->loanStart }}</td>
                <td>{{ $tableData->loanEnd }}</td>
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