<div class="row">
    <div class="col  l12">
        <div class="card-panel">
            <table id="table_customers" class="display table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>لسنه</th>
                    <th>لشهر</th>
                    <th>اسم الموظف</th>
                    <th>الاساسى </th>
                    <th>ج.الاستحقاقات</th>
                    <th>ج.الاستقطاعات</th>
                    <th>سلفه دوريه</th>
                    <th>الصافى </th>
                    <th>تم الصرف </th>
                    {{--<th>القائم بالصرف</th>--}}
                </tr>
                </thead>
                <tbody>

               <?php //print_r($tablesData);die(); ?>
                @foreach($net as $k=>$tableData )
                    <tr>
                        <td>{{ $tableData->for_year }}</td>
                        <td>{{ $tableData->for_month }}</td>
                        <td>{{ $tableData->EmpName }}</td>
                        <td>{{ $tableData->Fixed_Salary }}</td>
                        <td>{{ $tableData->Deserves}}</td>
                        <td>{{ $tableData->deduction }}</td>
                        <td>{{ $tableData->Loans }}</td>
                        <td>
                            <?php
                            $net = $tableData->Fixed_Salary -($tableData->Deserves + $tableData->deduction +  $tableData->Loans);
                            echo $net ;
                            ?>
                        </td>
                        <td>
                            <input name="got_sal_{{$k}}" type="checkbox" id="got_sal_{{$k}}" >
                            <label for="got_sal_{{$k}}"></label>
                        </td>
                        {{--<td>{{ $tableData->admin }}</td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

