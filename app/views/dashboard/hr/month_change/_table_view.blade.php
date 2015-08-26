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
            <th>ملغاه</th>
            <th>سبب الالغاء</th>
            <th>مدخل البيانات </th>
            <th>تعديل</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tablesData as $k=>$tableData)
            <tr>
                <th>{{ $tableData->trans_date }}</th>
                <th>{{ $tableData->employees->name }}</th>
                <th>{{ $tableData->for_year }}</th>
                <th>{{ $tableData->for_month }}</th>
                <th>{{ $tableData->desded->name }}</th>
                <th>{{ $tableData->val }}</th>
                <th>{{ $tableData->day_cost }}</th>
                <th>{{ $tableData->cause }}</th>
                <td>
                    <input name="canceled_{{$k}}" type="checkbox" id="canceled_{{$k}}">
                    <label for="canceled_{{$k}}"></label>
                </td>

                <th>{{ $tableData->cancel_cause }}</th>
                <th>{{ $tableData->users->name }}</th>
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