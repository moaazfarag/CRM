<div class="card">
    <div class="content">
        <div class="table-responsive" >
          <table id="" class="display table table-bordered table-striped table-hover">
            <thead>

            <tr>

                <th>@lang('main.date') </th>
                <th>@lang('main.employee')  </th>
                <th>@lang('main.for_year') </th>
                <th>@lang('main.for_month') </th>
                <th>@lang('main.clause')</th>
                <th>@lang('main.value') </th>
                <th>@lang('main.amount_or_days')</th>
                {{--<th>@lang('main.reason')</th>--}}
                <th>@lang('main.canceld')</th>
                <th>@lang('main.cancellation_reason') </th>
                <th>@lang('main.data_entry')</th>
                @if(PerC::isShow('hr','MonthChange','edit'))
                    <th>@lang('main.edit')</th>
                @endif
                @if(PerC::isShow('hr','MonthChange','delete'))
                    <th>@lang('main.delete')</th>
                    <th>
                        {{ Form::open(array('route'=>'multiDeleteMonthChange')) }}
                        <button  class="btn btn-small red" style="float: right;">إلغاء  المحدد</button>
                    </th>
                @endif
            </tr>
            </thead>
            <tbody>
            {{--@if($tablesData->isEmpty())--}}
            @if(!empty($tablesData))
                @foreach($tablesData as $k=>$tableData)
                    <tr>
                        <th>{{ $tableData->trans_date }}</th>
                        <th>{{ $tableData->employees->name }}</th>
                        <th>{{ $tableData->for_year }}</th>
                        <th>{{ $tableData->for_month }}</th>
                        <th>{{ $tableData->desded->name }}</th>
                        <th>{{ $tableData->val }}</th>
                        <th>{{ $tableData->day_cost }}</th>
                        <td>
                            @if($tableData->canceled == '0')
                                @lang('main.no')
                            @else
                                @lang('main.yes')
                            @endif

                        </td>

                        <th>{{ $tableData->cancel_cause }}</th>
                        <th>{{ $tableData->users->name }}</th>
                        @if(PerC::isShow('hr','MonthChange','edit'))
                            <td>
                                <a href="{{ URL::route('editMonthChange',array($tableData->id)) }}"
                                   class="btn btn-big z-depth-0">
                                    <i class="mdi mdi-editor-mode-edit"></i>
                                </a>
                            </td>
                        @endif
                        @if(PerC::isShow('hr','MonthChange','delete'))
                            <td>
                                <a onclick="return confirm('هل تريد بالفعل حذف هذا التغير الشهرى ')"
                                   href="{{ URL::route('deleteMonthChange',array($tableData->id)) }}"
                                   class="btn btn-danger red">[X]</a>
                            </td>

                            <td>
                                <input type="checkbox" id="checkbox{{ $k }}" name="checkbox[]"  value="{{ $tableData->id }}" />
                                <label for="checkbox{{ $k }}"></label>
                            </td>
                        @endif
                    </tr>

                @endforeach
                {{ Form::close() }}
            @else
                <tr>

                    <td style="text-align: center" colspan="11">
                        لا يوجد تغيرات شهرية
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
       </div>
    </div>
</div>