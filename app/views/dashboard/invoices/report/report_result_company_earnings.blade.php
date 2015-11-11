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
                <th>@lang('main.trans_type')</th>
                <th>@lang('main.item_name_')</th>
                <th>@lang('main.category')</th>
                <th>@lang('main.qty_')</th>
                <th>@lang('main.buy_prise_avg')</th>
                <th>@lang('main.sales_prise')</th>
                <th>@lang('main.debit_')</th>
                <th>@lang('main.credit_')</th>
            </tr>
            </thead>
            <tbody>
            <?php  $credit = array(); $debit = array(); $i = 0;  ?>

            @unless($invoices->isEmpty())


                    @foreach($invoices as  $invoice)

                        @foreach($invoice->details as $details)
                                <tr>
                                    <?php
                                    $earnings =  ($details->unit_price - $details->avg_cost) * $details->qty ;
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
                                        @if($invoice->invoice_type == 'sales')
                                        <td> 0.00</td>
                                            <td>{{  $earnings  }}
                                            <?php $credit[$i]= $earnings ?>
                                            </td>

                                        @elseif($invoice->invoice_type =='salesReturn')
                                            <td>{{  $earnings  }}</td>
                                            <td> 0.00</td>
                                            <?php $debit[$i] = $earnings ?>

                                        @endif
                                </tr>
                                <?php  $i++;  ?>
                             @endforeach
                        @endforeach
                    @endunless
                    @unless($expenses_and_revenue->isEmpty())
                       @foreach($expenses_and_revenue as  $expensesAndRevenu)
                           <?php  $i++;  ?>
                           <tr>
                            <td>{{ $expensesAndRevenu->account_trans_no }}</td>
                            <td>{{ BaseController::ViewDate($expensesAndRevenu->date) }}</td>
                            <td>{{ $expensesAndRevenu->branch->br_name }}</td>
                            <td>{{ lang::get('main.'.$expensesAndRevenu->account) }}</td>
                            <td>{{ Accounts::company()->find($expensesAndRevenu->account_id)->acc_name }}</td>
                            <td> -- </td>
                            <td> -- </td>
                            <td> -- </td>
                            <td> -- </td>
                            <td>{{ $expensesAndRevenu->debit }} </td>
                            <td>{{ $expensesAndRevenu->credit }}</td>
                            <?php $debit[$i]= $expensesAndRevenu->debit; $credit[$i]=  $expensesAndRevenu->credit ?>
                        </tr>
                        @endforeach
                    @endunless
                    </tbody>
                </table>
                </div>
        <div class="table-responsive" >
            <table  style="width:80%; margin:1% auto;" class="display table table-bordered table-striped table-hover">
                    <thead>

                    <tr>
                        <th>مدين</th>
                        <th>  دائن </th>
                        <th>  رصيد </th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        <td>{{ array_sum($debit) }}</td>
                        <td>{{ array_sum($credit) }}</td>
                        <td>{{ BaseController::negativeValue(array_sum($credit)-array_sum($debit)) }}</td>
                    </tr>
                    </tbody>
                </table>
                </div>





                {{--<div class="alert  orange lighten-4 orange-text text-darken-2">--}}
                    {{--<strong>عفواً!</strong>--}}
                    {{--لا يوجد نتائج--}}
                {{--</div>--}}

    </div>
</section>
<!-- /Main Content -->

@stop

