@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section   class="content-wrap ecommerce-invoice" ng-app>
    <div class="card" style="padding:1%;">
        <div class="right-align invoice-print">
            <span class="btn indigo" onclick="javascript:window.print();"><i class="ion-printer"></i></span>
        </div>
    	<div  class="card-panel blue lighten-5 center_title">{{ $title }}</div>
        <div class="table-responsive" >
            <table id="table_bank" class="display table table-bordered table-striped table-hover">
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
            <th>@lang('main.sum_')</th>
            <th>@lang('main.result_sum')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as  $invoice)

            @foreach($invoice->details as $details)
                <tr>

                    <td>{{ $invoice->invoice_no }}</td>
                    <td>{{ $invoice->date }}</td>
                    <td>{{ $invoice->branch->br_name }}</td>
                    <td>{{ $details->item_name }}</td>
                    <td>{{ Category::find($details->cat_id)->name }}</td>
                    <td>{{ $details->qty }}</td>
                    <td>{{ $details->unit_price }}</td>
                    <td>{{  $details->qty * $details->unit_price}}</td>

                </tr>
            @endforeach

        @endforeach
        </tbody>
    </table>
   </div>
    </div>
</section>
<!-- /Main Content -->

@stop
