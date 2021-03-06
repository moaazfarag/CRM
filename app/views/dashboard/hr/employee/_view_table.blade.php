<div class="row">
    <div class="col  l12">
        <div class="card-panel">
            <div class="table-responsive" >
                <table id="table_bank" class="display table table-bordered table-striped table-hover">

                <thead>
                <tr>
                    <th> @lang('main.serial')</th>
                    <th> @lang('main.name')</th>
                    <th> @lang('main.position')</th>
                    <th> @lang('main.section')</th>
                    <th> @lang('main.salary')</th>
                    <th> @lang('main.address')</th>
                    <th> @lang('main.qualification')</th>
                    @if(PerC::isShow('hr','Employees','edit'))
                        <th> @lang('main.edit')</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($tablesData as $tableData)
                    <tr>
                        <td>{{ $tableData->true_id }}</td>
                        <td><a href="{{ URL::route('showEmployee',$tableData->id) }}">{{ $tableData->name }}</a></td>
                        <td>{{ $tableData->jobs->name }}</td>
                        <td>{{ $tableData->departments->name }}</td>
                        <td>{{ $tableData->salary }}</td>
                        <td>{{ $tableData->address }}</td>
                        <td>{{ $tableData->certificate }}</td>
                        @if(PerC::isShow('hr','Employees','edit'))
                            <td>
                                <a href="{{ URL::route('editEmp',array($tableData->id)) }}"
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
</div>