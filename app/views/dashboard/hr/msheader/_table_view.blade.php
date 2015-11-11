<div class="row">
    <div class="col  l12">
        <div class="card-panel">
            <div  class="card-panel blue lighten-5 center_title" style="margin-bottom: 1%;" >



 مرتبات
                        شهر: {{ Input::get('for_month') }}
                        لسنة: {{ Input::get('for_year') }}

            </div>
                        @if($net && !$net->isEmpty())
            {{ Form::open(array('route'=>array('readyToPay'))) }}
                        @endif
            <div class="table-responsive" >
                <table  class="display table table-bordered table-striped table-hover">

                <thead>
                <tr>

                        <th>@lang('main.employee_name')</th>
                        <th> @lang('main.basic')</th>
                        <th>@lang('main.all_debt')</th>
                        <th>@lang('main.all_credit')</th>
                        <th>@lang('main.periodic_loan')</th>
                        <th>@lang('main.net') </th>


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
                            {{ $tableData->net  }}
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
          </div>
            {{ Form::hidden('for_month',Input::get('for_month')) }}
            {{ Form::hidden('for_year',Input::get('for_year')) }}

            @if($net && !$net->isEmpty())
            <button type="submit" class="waves-effect btn">صرف المرتبات</button>
            {{ Form::close() }}
            @endif
        </div>
    </div>
    {{--{{dd(DB::getQueryLog())}}--}}
</div>
