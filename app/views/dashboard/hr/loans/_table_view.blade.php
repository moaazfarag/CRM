<div class="card">
    <div class="content">
        <div class="table-responsive">
            <table id="table_bank" class="display table table-bordered table-striped table-hover">
                <thead>
                <tr>

                    <th>@lang('main.serial')</th>
                    <th>@lang('main.employee')</th>
                    <th>@lang('main.loan_date')</th>
                    <th>@lang('main.salary_loan')</th>
                    <th>@lang('main.monthly_quantity')</th>
                    <th>@lang('main.loan_start')</th>
                    <th>@lang('main.loan_end')</th>
                    {{--<th>@lang('main.balance')</th>--}}
                    <th>@lang('main.edit')</th>

                </tr>
                </thead>
                <tbody>
                @foreach($tablesData as $k=>$tableData)
                    <tr>
                        <th>{{ $tableData->true_id }}</th>
                        <td>{{ $tableData->employees->name }}</td>
                        <td>{{ BaseController::ViewDateAndTime($tableData->loan_date) }}</td>
                        <td>{{ $tableData->loan_val }}</td>
                        <td>{{ $tableData->loan_currBal }}</td>
                        <td>{{ BaseController::ViewDate($tableData->loan_start) }}</td>
                        <td>{{ BaseController::ViewDate($tableData->loan_end) }}</td>
                        <td>
                            <a href="{{ URL::route('editLoans',array($tableData->id)) }}"
                               class="btn btn-small z-depth-0">
                                <i class="mdi mdi-editor-mode-edit"></i>
                            </a>
                        </td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
