@extends('dashboard.main')
@section('content')

        <style>
            .receipt ul {
                padding-right: 5%;
                /*background-color: #33aaff;*/

            }
            .receipt ul li{
                font-size: 1em;
                font-weight: 500;
                list-style: circle;
                /*display: inline;*/
                margin: 4%;
            }

            .border-solid{

                border-left: 1px solid #999;
                border-right: 1px solid #999;
                border-bottom: 1px solid #999;
                border-top: 1px solid #999;
            }



            .padding-1{
                padding: 1%;
            }

            .bold-text{
                font-weight: 700;
                /*color: red;*/
            }

        </style>

        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard" id="print-content">

    <div class="right-align invoice-print">
        <span class="btn indigo" onclick="javascript:window.print();"><i class="ion-printer"></i></span>
    </div>

    @foreach($headers as $header)
        <div class="card-panel border-solid" style="padding:2% ;min-height: 450px">
    <div class="card-panel grey lighten-4 border-solid" style="text-align: center;">
        @lang('main.receipt_salary') <strong> {{ $header->employee->name }} </strong>
    </div>
            <!-- Invoice Number and Date -->
    <div class="row" style="font-style: italic; margin: 2%;">

       <div class="col s4 l4" style=""> @lang('main.delivery_no') {{ $header->ms_header_id }} </div>
       <div class="col s4 l4" style="  text-align: center;">  @lang('main.for_month')  {{ Input::get('for_month') }}  @lang('main.for_year_')      {{ Input::get('for_year') }}  </div>
       <div class="col s4 l4" style="  text-align: left;">@lang('main.exchange_date') {{ BaseController::ViewDate($header->created_at) }} </div>

    </div>
        <hr />
    <div class="row receipt">
         <div class="col s6 l6">
             <ul>
             <li>@lang('main.employee/') {{ $header->employee->name }}</li>
             <li>@lang('main.job/') {{ $header->job->name }}</li>
            </ul>
         </div>

        <div class="col s6 l6">
            <ul>
                <li>@lang('main.department/') {{ $header->department->name }}</li>
                <li>@lang('main.main/') {{ $header->fixed_salary }}</li>
            </ul>
        </div>
    </div>


        <!-- /Invoice Number and Date -->

    <br>

            <!-- Table with products -->
            <div class="row padding-1">
            @if(!$header->detailsDes->isEmpty())

                <div class="col s6">
                     <div class="">
                        <table id="table1" class="display table table-bordered table-hover">
                            <thead>
                            <tr>
                                <caption class="caption-style"  >جميع الإستحقاقات</caption>

                            </tr>
                            <tr>
                                <th>الاستحقاق</th>
                                <th >القيمة</th>
                                <th >الفئة</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($header->detailsDes as $k => $detail)
                                <tr>
                                <td>
                                    {{ $detail->name }}
                                </td>
                                <td>
                                    {{ $detail->total_val}}
                                </td>

                                <td>
                                {{ $detail->ds_cat  }}
                                </td>
                            </tr>
                            @endforeach
                     </tbody>
                </table>
                </div>
                </div>


                @endif

            @if(!$header->detailsDed->isEmpty())

                    <div class="col s6">
                        <div class="table-responsive">
                            <table id="table1" class="display table table-bordered table-hover">
                                <thead>
                                <tr>

                                    <caption class="caption-style"  >جميع الإستقطاعات</caption>
                                </tr>
                                <tr>
                                    <th>الاستقطاع</th>
                                    <th >القيمة</th>
                                    <th >الفئة</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($header->detailsDed as $k => $detail)
                                    <tr>
                                        <td>
                                            {{ $detail->name }}
                                        </td>
                                        <td>
                                            {{ $detail->total_val}}
                                        </td>

                                        <td>
                                            {{ $detail->ds_cat }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


            @endif
            </div>
            {{--start sum --}}

                <div class="row padding-1" >
                    <div class="col m12 s12">
                        <div class="table-responsive">
                            <table id="table1" class="display table table-bordered table-hover">
                                <thead>
                                <tr>

                                    <caption class="caption-style"  >الإجمالى  </caption>
                                </tr>

                                    <th> @lang('main.main/') </th>
                                    <th> @lang('main.all_debt') </th>
                                     <th> @lang('main.all_credit')</th>
                                     <th  class="bold-text">  @lang('main.sum')</th>
                                </tr>
                                </thead>
                                <tbody>

                                    <tr>

                                        <td> {{ $header->fixed_salary }}  </td>

                                        <td>  {{ $header->deserves or 0}}   </td>

                                        <td>  {{ $header->deductions or 0 }}   </td>

                                        <td class="bold-text">{{ $header->net }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            {{--end sum--}}
        </div>
        @endforeach
</section>
@stop

