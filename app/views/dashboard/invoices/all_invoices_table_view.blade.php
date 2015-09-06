<div class="card-panel">

    <table class="table table-hover">
        <thead>
        <tr>
            <th>@lang('main.number')</th>
            <th>@lang('main.date') </th>
            <th>@lang('main.edit')</th>

        </tr>
        </thead>
        <tbody>
        @foreach($tablesData as $tableData)
            <tr>
                <th>{{ $tableData->invoice_no }}</th>
                <td>{{ BaseController::ViewDate($tableData->created_at) }}</td>

                <td>
                    <a href="{{ URL::route('editDep',array($tableData->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-editor-mode-edit"></i>
                    </a>
                </td>


            </tr>

        @endforeach

        </tbody>
    </table>
</div>



