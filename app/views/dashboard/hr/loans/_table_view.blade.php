<div class="card-panel">
    <table class="table table-hover">
        <thead>
        <tr>

            <th>@lang('main.serial')</th>
            <th>@lang('main.employee')</th>
            <th>@lang('main.loan_date')</th>
            <th>@lang('main.salary_loan')</th>
            <th>@lang('main.monthly_quantity')</th>
            <th>@lang('main.loan_start')</th>
            <th>@lang('main.loan_end')</th>
            <th>@lang('main.finished')</th>
            <th>@lang('main.balance')</th>
            <th>@lang('main.edit')</th>


        </tr>
        </thead>
        <tbody>
        @foreach($tablesData as $k=>$tableData)
            <tr>
                <th>{{ $tableData->id }}</th>
                <td>{{ $tableData->employees->name }}</td>
                <td>{{ $tableData->loan_date }}</td>
                <td>{{ $tableData->loan_val }}</td>
                <td>{{ $tableData->loan_currBal }}</td>
                <td>{{ $tableData->loan_start }}</td>
                <td>{{ $tableData->loan_end }}</td>
                <td>{{ $tableData->employees->salary }}</td>
                <td>
                    <input name="finish_{{$k}}" type="checkbox" id="finish_{{$k}}" >
                    <label for="finish_{{$k}}"></label>
                </td>
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