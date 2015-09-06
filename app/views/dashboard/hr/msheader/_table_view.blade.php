<div class="row">
    <div class="col  l12">
        <div class="card-panel">
            <div class="title">
                    <h2>
 مرتبات
                        شهر: {{ Input::get('for_month') }}
                        لسنة: {{ Input::get('for_year') }}
                </h2>
            </div>
                        @if(!$net->isEmpty())
            {{ Form::open(array('route'=>array('readyToPay'))) }}
                        @endif
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
                    <th> تاريخ الصرف</th>
                    {{--<th>القائم بالصرف</th>--}}
                    <th>صرف بواسطة</th>
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
                        <td>
                        </td>
                        <td>
                            @if(in_array($tableData->id,$haveSalary->lists('employee_id')))
                               {{ User::find($haveSalary[BaseController::arraySearch($haveSalary,'employee_id',$tableData->id)]['user_id'])->name}}
                            @endif
                        </td>
                        {{--<td>{{ $tableData->admin }}</td>--}}
                    </tr>
                @endforeach
                @foreach($haveSalary as $k=>$tableData )
                    <tr>
                        <td>{{ $tableData->employees->name }}</td>
                        <?php
                         $dud   =  $tableData->deserves;
                         $dis   =  $tableData->deductions;
                         $loan  =  $tableData->loan;
                        ?>
                        <td>{{ $tableData->fixed_salary }}</td>
                        <td>{{ $dud }}</td>
                        <td>{{ $dis }}</td>
                        <td>{{ $loan }}</td>
                        <td>
                            {{ ($dud+$tableData->fixed_salary)-($dis +$loan)  }}
                        </td>
                        <td>
<span class="green-text">
    تم الصرف
</span>
                        </td>
                        <td>
                            {{ $tableData->created_at }}
                        </td>
                        <td>
                              {{ User::find($tableData->user_id)->name}}
                        </td>
                        {{--<td>{{ $tableData->admin }}</td>--}}
                    </tr>

                @endforeach

                </tbody>
            </table>
            {{ Form::hidden('for_month',Input::get('for_month')) }}
            {{ Form::hidden('for_year',Input::get('for_year')) }}

            @if(!$net->isEmpty())
            <button type="submit" class="waves-effect btn">صرف المرتبات</button>
            {{ Form::close() }}
            @endif
        </div>
    </div>
    {{--{{dd(DB::getQueryLog())}}--}}
</div>
