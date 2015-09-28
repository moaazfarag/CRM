@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section   class="content-wrap ecommerce-invoice" ng-app>
    <div class="card" style="padding:1%;">
    	<div  class="card-panel blue lighten-5 center_title">{{ $title }}</div>
    <table id="table_bank" class="display table table-bordered table-striped table-hover">
        <thead>
        <tr>

            <th>@lang('main.number') </th>
            <th>@lang('main.branchName') </th>
            <th>@lang('main.invoiceNum')</th>
            <th>@lang('main.date') </th>
            <th>@lang('main.view')</th>
            <th>@lang('main.canceld')</th>
            <th>@lang('main.cancel_cause')</th>

        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $k => $invoice)
            <tr>
                <td>{{ $k+1 }}</td>
                <td>{{ $invoice->branch->br_name }}</td>
                <td>
                        {{ $invoice->invoice_no }}
                </td>
                <td class="green-text">{{ $invoice->date }}</td>
                <td>
                    <a href="{{ URL::route('viewSettle',array($invoice->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-action-pageview"></i>
                    </a>
                </td>
                <td>
                    @if($invoice->deleted == 1)
                    نعم
                    @else
                    لا
                    @endif
                </td>
                <td>
                        {{ $invoice->notes }}
                </td>
            </tr>

        
        @endforeach
        </tbody>
    </table>
    </div>
</section>
<!-- /Main Content -->

@stop
