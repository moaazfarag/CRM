<div class="card-panel">
    <table class="table table-hover">
        <thead>
        <tr>

            <th>التاريخ </th>
            <th>الموظف </th>
            <th> لسنه</th>
            <th>لشهر </th>
            <th>البند</th>
            <th>القيمه</th>
            <th>مبلغ/ايام</th>
            <th>السبب</th>
            {{--<th>ملغاه</th>--}}
            <th>سبب الالغاء</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tablesData as $tableData)
            <tr>
                <th>{{ $tableData->trans_date }}</th>
                <th>{{ $tableData->employees->name }}</th>
                <th>{{ $tableData->for_year }}</th>
                <th>{{ $tableData->for_month }}</th>
                <th>{{ $tableData->desded->name }}</th>
                <th>{{ $tableData->val }}</th>
                <th>{{ $tableData->day_cost }}</th>
                <th>{{ $tableData->cause }}</th>
                <th>{{ $tableData->cancel_cause }}</th>
                <td>
                    <a href="{{ URL::route('editMonthChange',array($tableData->id)) }}" class="btn btn-big z-depth-0">
                        <i class="mdi mdi-editor-mode-edit"></i>
                    </a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>