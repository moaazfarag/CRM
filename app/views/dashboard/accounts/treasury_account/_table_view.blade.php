<div class="card">
    <div class="content">
        <div class="table-responsive" >
            <table id="table_bank" class="display table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>@lang('main.number')</th>
                <th>@lang('main.of_account')</th>
                <th>@lang('main.name')</th>
                <th>@lang('main.date')</th>
                <th>@lang('main.debit_')</th>
                <th>@lang('main.credit_')</th>
                <th>@lang('main.trans_type')</th>
                <th>@lang('main.notes')</th>
                <th>@lang('main.edit')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rowsData as $k => $rowData)
                <?php
                $account = $rowData->account;
                ?>
                <tr>
                    <th>{{ $k +1}}</th>
                    <td>@lang('main.'.$account)</td>
                    <td>
                        {{ $rowData->accountName->acc_name }}
                    </td>
                    <td>{{ BaseController::ViewDate($rowData->date) }}</td>
                    <td>{{ $rowData->debit}}</td>
                    <td>{{ $rowData->credit }}</td>
                    <td>{{ lang::get('main.'.$rowData->trans_type) }}</td>
                    <td>{{ $rowData->notes }}</td>
                    @if(PerC::isShow('p_general_accounts','p_directMovement','edit'))
                        <td>
                            <a href="{{ URL::route('editDirectMovement',array($rowData->id)) }}"
                               class="btn btn-small z-depth-0">
                                <i class="mdi mdi-editor-mode-edit"></i>
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
</div>