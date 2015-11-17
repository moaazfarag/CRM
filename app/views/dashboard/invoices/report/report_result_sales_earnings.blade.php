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

              <div class="table-responsive" >
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
             </div>




            @else
                <div class="table-responsive" >
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
                        <th>@lang('main.invoice_type')</th>
                        <th>@lang('main.item_name_')</th>
                        <th>@lang('main.category')</th>
                        <th>@lang('main.qty_')</th>
                        <th>@lang('main.buy_prise_avg')</th>
                        <th>@lang('main.sales_prise')</th>
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

                                        <?php

                                        $earnings =  ($details->unit_price - $details->avg_cost) * $details->qty ;

                                        if($invoice->invoice_type == 'salesReturn'){

                                            $true_earning = $earnings * -1 ;

                                        }else{

                                            $true_earning = $earnings;
                                        }
                                        ?>
                                        <td>{{ $invoice->invoice_no }}</td>
                                        <td>{{ $invoice->date }}</td>
                                        <td>{{ $invoice->branch->br_name }}</td>
                                        <td>{{ lang::get('main.'.$invoice->invoice_type) }}</td>
                                        <td>{{ $details->item_name }}</td>
                                        <td>{{ Category::find($details->cat_id)->name }}</td>
                                        <td>{{ $details->qty }}</td>
                                        <td>{{ $details->avg_cost }}</td>
                                        <td>{{ $details->unit_price }}</td>
                                        <td>{{ $true_earning }}</td>

                                    </tr>
                                    <?php  $i++; $all_earnings[$i] = $true_earning; $all_qty[$i] = $details->qty; $all_invoice[$invoice->invoice_no] = $invoice->invoice_no; $all_items[$details->id] = $details->item_name;  ?>
                                @endif

                            @elseif($cat_id == '' &&  $item_id != '')

                                @if($details->item_id == $item_id )

                                    <tr>
                                        <?php

                                        $earnings =  ($details->unit_price - $details->avg_cost) * $details->qty ;

                                        if($invoice->invoice_type == 'salesReturn'){

                                            $true_earning = $earnings * -1 ;

                                        }else{

                                            $true_earning = $earnings;
                                        }
                                        ?>
                                        <td>{{ $invoice->invoice_no }}</td>
                                        <td>{{ $invoice->date }}</td>
                                        <td>{{ $invoice->branch->br_name }}</td>
                                        <td>{{ lang::get('main.'.$invoice->invoice_type) }}</td>
                                        <td>{{ $details->item_name }}</td>
                                        <td>{{ Category::find($details->cat_id)->name }}</td>
                                        <td>{{ $details->qty }}</td>
                                        <td>{{ $details->avg_cost }}</td>
                                        <td>{{ $details->unit_price }}</td>
                                        <td>{{  $true_earning }}</td>

                                    </tr>
                                    <?php  $i++; $all_earnings[$i] = $true_earning; $all_qty[$i] = $details->qty; $all_invoice[$invoice->invoice_no] = $invoice->invoice_no; $all_items[$details->id] = $details->item_name;  ?>
                                @endif

                            @elseif($cat_id != '' &&  $item_id == '')

                                @if($details->cat_id == $cat_id )

                                    <tr>
                                        <?php

                                        $earnings =  ($details->unit_price - $details->avg_cost) * $details->qty ;

                                        if($invoice->invoice_type == 'salesReturn'){

                                            $true_earning = $earnings * -1 ;

                                        }else{

                                            $true_earning = $earnings;
                                        }
                                        ?>
                                        <td>{{ $invoice->invoice_no }}</td>
                                        <td>{{ $invoice->date }}</td>
                                        <td>{{ $invoice->branch->br_name }}</td>
                                        <td>{{ lang::get('main.'.$invoice->invoice_type) }}</td>

                                        <td>{{ $details->item_name }}</td>
                                        <td>{{ Category::find($details->cat_id)->name }}</td>
                                        <td>{{ $details->qty }}</td>
                                        <td>{{ $details->avg_cost }}</td>
                                        <td>{{ $details->unit_price }}</td>
                                        <td>{{  $true_earning}}</td>
                                    </tr>
                                    <?php  $i++; $all_earnings[$i] = $true_earning; $all_qty[$i] = $details->qty; $all_invoice[$invoice->invoice_no] = $invoice->invoice_no; $all_items[$details->id] = $details->item_name;  ?>
                                @endif



                            @else
                                <tr>
                                    <?php

                                    $earnings =  ($details->unit_price - $details->avg_cost) * $details->qty ;

                                    if($invoice->invoice_type == 'salesReturn'){

                                        $true_earning = $earnings * -1 ;

                                    }else{

                                        $true_earning = $earnings;
                                    }
                                    ?>
                                    <td>{{ $invoice->invoice_no }}</td>
                                    <td>{{ $invoice->date }}</td>
                                    <td>{{ $invoice->branch->br_name }}</td>
                                    <td>{{ lang::get('main.'.$invoice->invoice_type) }}</td>
                                    <td>{{ $details->item_name }}</td>
                                    <td>{{ Category::find($details->cat_id)->name }}</td>
                                    <td>{{ $details->qty }}</td>
                                    <td>{{ $details->avg_cost }}</td>
                                    <td>{{ $details->unit_price }}</td>
                                    <td>{{  $true_earning  }}</td>
                                </tr>
                                <?php  $i++; $all_earnings[$i] = $true_earning; $all_qty[$i] = $details->qty; $all_invoice[$invoice->invoice_no] = $invoice->invoice_no; $all_items[$details->id] = $details->item_name;  ?>
                            @endif


                        @endforeach




                    @endforeach
                    <?php  $count_invoices  = $i; ?>
                    </tbody>
                </table>
                </div>

                {{--##### discount   #####--}}

                <?php $all_discount = array(); ?>
                @foreach($invoices as  $i=>$invoice)

                    @if($invoice->discount != 0)
                        <?php $all_discount[$i] = $invoice->discount ?>
                    @endif
                @endforeach

                @if(array_sum($all_discount) != 0)
                    <div class="table-responsive" >
                        <table   class="display table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <caption class="caption-style">
                                    الخصم على الفواتير

                                </caption>

                            </tr>

                            <tr>

                                <th>@lang('main.invoiceNum')</th>
                                <th>@lang('main.date')</th>
                                <th>@lang('main.branchName')</th>
                                <th>@lang('main.discount')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $all_discount = array(); ?>
                            @foreach($invoices as  $i=>$invoice)

                                @if($invoice->discount != 0)
                                    <tr>
                                        <td>{{ $invoice->invoice_no }}</td>
                                        <td>{{ $invoice->date }}</td>
                                        <td>{{ $invoice->branch->br_name }}</td>
                                        <td>{{ $invoice->discount }}</td>
                                    </tr>
                                    <?php $all_discount[$i] = $invoice->discount ?>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                {{--end discount --}}
                <div class="table-responsive" >
                    <table  style="width:80%; margin:1% auto;" class="display table table-bordered table-striped table-hover">
                    <thead>

                    <tr>
                        <th>عدد الفواتير </th>
                        <th> إجمالى الكميات </th>
                        <th> إجمالى الأصناف </th>
                        <th>إجمالى الخصومات</th>
                        <th> إجمالى الأرباح </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ count($all_invoice) }}</td>
                        <td>{{ array_sum($all_qty) }}</td>
                        <td>{{ count($all_items) }}</td>
                        <td>{{ array_sum($all_discount) }}</td>
                        <td>{{ array_sum($all_earnings) -array_sum($all_discount) }}</td>
                    </tr>
                    </tbody>
                </table>
              </div>


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

