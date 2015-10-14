<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 9/28/2015
 * Time: 2:08 PM
 */
        ?>
@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section id="print-content"  class="content-wrap ecommerce-invoice " ng-app>
    <div class="card" style="padding:1%;">
        <div class="right-align invoice-print">
            <span class="btn indigo" onclick="javascript:window.print();"><i class="ion-printer"></i></span>
        </div>

        <div  class="card-panel blue lighten-5 center_title no-print">
            {{ $title }}
        </div>


@if($items)

            {{--<table style="width:80%; margin:1% auto;" class="display table table-bordered table-striped table-hover">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<caption class="caption-style">--}}
                        {{--الفترة من--}}
                        {{--{{ BaseController::ViewDate($date_from) }}--}}
                        {{--حتى--}}
                        {{--{{ BaseController::ViewDate($date_to) }}--}}
                    {{--</caption>--}}

                {{--</tr>--}}

                {{--</thead>--}}
                {{--<tbody>--}}

                {{--</tbody>--}}
            {{--</table>--}}
<br>








        @foreach($items as $k => $itemByItem )
            <div class="page">
        <table   class="display table table-bordered table-striped table-hover">
            <thead>

            <tr>
                <caption>
                 <h4>   {{ $itemByItem[0]->item_name }}</h4>
                </caption>
            </tr>

            <tr>
                    <caption class="caption-style">
                        الفترة من
                        {{ BaseController::ViewDate($date_from) }}
                        حتى
                        {{ BaseController::ViewDate($date_to) }}
                    </caption>
                </tr>
                <tr>
                    <th>@lang('main.date')</th>
                    <th>@lang('main.type')</th>
                    <th>@lang('main.branchName')</th>
                    <th>@lang('main.category')</th>
                    <th>@lang('main.qty_')</th>
                    <th>@lang('main.sum_')</th>
                    <th>@lang('main.result_sum')</th>
                    <th>السيريال</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                    <td colspan="4">رصيد ما قبل</td>
                    <td  colspan="4">{{$balBefore[$itemByItem[0]->item_id]['bal'] }}</td>
            </tr>
            <?php $total = 0 ?>
            @foreach($itemByItem as $item )
                    <tr>
                            <td>{{ BaseController::viewDate($item->date) }}</td>
                            <td>@lang('main.'.$item->invoice_type) فاتورة رقم {{ $item->invoice_no }}</td>
                            <td>{{ $item->br_name }}</td>
                            <td>{{ Category::find($item->cat_id)->name }}</td>
                            <td>{{ BaseController::negativeValue($item->item_bal)  }}</td>
                            <td>{{ $item->unit_price }}</td>
                            <td>{{ $item->qty * $item->unit_price}}</td>
                            <td>{{ $item->serial_no}}</td>
                            {{--<td>{{ $item->item_bal}}</td>--}}
                            <?php $total += $item->item_bal  ?>
                        </tr>
                @endforeach
            <tr>
                <td colspan="4">الرصيد حتى تاريخ {{ $date_to}} </td>
                <td colspan="4">{{ $total +  $balBefore[$itemByItem[0]->item_id]['bal']  }}</td>
            </tr>
            </tbody>
        </table>
            </div>
        @endforeach
{{--<script>--}}
    {{--window.print();--}}
{{--</script>--}}
@else

            <div class="alert  orange lighten-4 orange-text text-darken-2">
                <strong>عفواً!</strong>
                لا يوجد نتائج
            </div>
@endif

    </div>
</section>
<!-- /Main Content -->

@stop
