<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/3/2015
 * Time: 1:02 PM
 */

?>

@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section   class="content-wrap ecommerce-invoice" ng-app>
    <div class="card" style="padding:1%;">
        <div class="right-align invoice-print">
            <span class="btn indigo" onclick="javascript:window.print();"><i class="ion-printer"></i></span>
        </div>

        <div  class="card-panel blue lighten-5 center_title">
            {{ $title }}
        </div>


        @unless($invoices->isEmpty())

            @if($sum == 'sum')

                <?php

                $all_net = array();
                $i       = 0;
                foreach($invoices as $invoice){
                    $i++;

                    $all_net[$i] =  $invoice->transDitails->item_total;

                }
                $count_invoices  = $i;
                ?>


                <table style="width:80%; margin:1% auto;" class="display table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <caption class="caption-style">
                            الفترة من
                            {{ BaseController::ViewDate($date_from) }}
                            حتى
                            {{ BaseController::ViewDate($date_to) }}
                        </caption>

                    </tr>
                    <tr>
                        <th>إجمالى المبيعات</th>
                        <th>عدد الفواتير </th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ array_sum($all_net) }}</td>
                        <td>{{ $count_invoices }}</td>
                    </tr>
                    </tbody>
                </table>





            @else

                <table   class="display table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <caption class="caption-style">
                            الفترة من
                            {{ BaseController::ViewDate($date_from) }}
                            حتى
                            {{ BaseController::ViewDate($date_to) }}
                        </caption>

                    </tr>

                    <tr>

                        <th>@lang('main.invoiceNum')</th>
                        <th>@lang('main.date')</th>
                        <th>@lang('main.branchName')</th>
                        <th>@lang('main.item_name_')</th>
                        <th>@lang('main.category')</th>
                        <th>@lang('main.qty_')</th>
                        <th>@lang('main.buy_prise')</th>
                        <th>@lang('main.sales_prise')</th>
                        <th>@lang('main.sum')</th>
                        <th>@lang('main.earnings')</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php  $all_net = array(); $i = 0;  ?>

                    @foreach($invoices as  $invoice)

                        @foreach($invoice->details as $details)

                            @if($cat_id != '' &&  $item_id != '')

                                @if($details->cat_id == $cat_id && $details->item_id == $item_id )
                                    <tr>


                                        <td>{{ $invoice->invoice_no }}</td>
                                        <td>{{ $invoice->date }}</td>
                                        <td>{{ $invoice->branch->br_name }}</td>
                                        <td>{{ $details->item_name }}</td>
                                        <td>{{ Category::find($details->cat_id)->name }}</td>
                                        <td>{{ $details->qty }}</td>
                                        <td>{{ $details->buy }}</td>
                                        <td>{{ $details->unit_price }}</td>
                                        <td>{{  $details->qty * $details->unit_price}}</td>

                                    </tr>
                                    <?php  $i++; $all_net[$i] =  $details->qty * $details->unit_price;  ?>
                                @endif

                            @elseif($cat_id == '' &&  $item_id != '')

                                @if($details->item_id == $item_id )

                                    <tr>
                                        <td>{{ $invoice->invoice_no }}</td>
                                        <td>{{ $invoice->date }}</td>
                                        <td>{{ $invoice->branch->br_name }}</td>
                                        <td>{{ $details->item_name }}</td>
                                        <td>{{ Category::find($details->cat_id)->name }}</td>
                                        <td>{{ $details->qty }}</td>
                                        <td>{{ $details->buy }}</td>
                                        <td>{{ $details->unit_price }}</td>
                                        <td>{{  $details->qty * $details->unit_price}}</td>

                                    </tr>
                                    <?php  $i++; $all_net[$i] =  $details->qty * $details->unit_price;  ?>
                                @endif

                            @elseif($cat_id != '' &&  $item_id == '')

                                @if($details->cat_id == $cat_id )

                                    <tr>

                                        <td>{{ $invoice->invoice_no }}</td>
                                        <td>{{ $invoice->date }}</td>
                                        <td>{{ $invoice->branch->br_name }}</td>
                                        <td>{{ $details->item_name }}</td>
                                        <td>{{ Category::find($details->cat_id)->name }}</td>
                                        <td>{{ $details->qty }}</td>
                                        <td>{{ $details->buy }}</td>
                                        <td>{{ $details->unit_price }}</td>
                                        <td>{{  $details->qty * $details->unit_price}}</td>

                                    </tr>
                                    <?php  $i++; $all_net[$i] =  $details->qty * $details->unit_price;  ?>
                                @endif



                            @else
                                <tr>
                                    <td>{{ $invoice->invoice_no }}</td>
                                    <td>{{ $invoice->date }}</td>
                                    <td>{{ $invoice->branch->br_name }}</td>
                                    <td>{{ $details->item_name }}</td>
                                    <td>{{ Category::find($details->cat_id)->name }}</td>
                                    <td>{{ $details->qty }}</td>
                                    <td>{{ $details->buy }}</td>
                                    <td>{{ $details->unit_price }}</td>
                                    <td>{{  $details->qty * $details->unit_price}}</td>

                                </tr>
                                <?php  $i++; $all_net[$i] =  $details->qty * $details->unit_price;  ?>
                            @endif


                        @endforeach




                    @endforeach
                    <?php  $count_invoices  = $i; ?>
                    </tbody>
                </table>

                <table  style="width:80%; margin:1% auto;" class="display table table-bordered table-striped table-hover">
                    <thead>

                    <tr>
                        <th>الإجمالى </th>
                        <th>عدد الفواتير </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ array_sum($all_net) }}</td>
                        <td>{{ count($invoices) }}</td>
                    </tr>
                    </tbody>
                </table>



            @endif
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

