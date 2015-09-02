<div class="row">
    <div class="col  l12">
        <div class="card-panel">
            {{ Form::open(array('route'=>array('readyToPay'))) }}
            <table id="table_customers" class="display table table-bordered table-striped table-hover">
                <thead>
                <tr>

                    <th>اسم الموظف</th>
                    <th>الاساسى </th>
                    <th>ج.الاستحقاقات</th>
                    <th>ج.الاستقطاعات</th>
                    <th>سلفه دوريه</th>
                    <th>الصافى </th>
                    <th>صرف </th>
                    {{--<th>تم الصرف </th>--}}
                    {{--<th>القائم بالصرف</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($net as $k=>$tableData )
                    <tr>
                        <td>{{ $tableData->name }}</td>
                        <?php
                         $dud   =  $tableData->employeeDudValue('استحقاق');
                         $dis   =  $tableData->employeeDudValue('استقطاع');
                         $loan  =  $tableData->loansValue();
                        ?>
                        <td>{{ $tableData->salary }}</td>
                        <td>{{ $dud }}</td>
                        <td>{{ $dis }}</td>
                        <td>{{ $loan }}</td>
                        <td>
                            {{ ($dud+$tableData->salary)-($dis +$loan)  }}
                        </td>
                        <td>
                            <input value="{{ $tableData->id }}" name="employeeId[{{$k}}]" type="checkbox" id="employeeId[{{$k}}]">
                            <label for="employeeId[{{$k}}]"></label>
                        </td>

                        {{--<td>{{ $tableData->admin }}</td>--}}
                    </tr>

                @endforeach
                </tbody>
            </table>
            <button type="submit" class="waves-effect btn">صرف المرتبات</button>
            {{ Form::close() }}
        </div>
    </div>
</div>
