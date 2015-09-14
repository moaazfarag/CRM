@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section   class="content-wrap ecommerce-invoice">
    <div class="card">
    <table id="table_bank" class="display table table-bordered table-striped table-hover">
        <thead>
        <tr>

            <th>@lang('main.invoiceNum')</th>
            <th>@lang('main.branchName') </th>
            <th>@lang('main.theType')</th>
            <th>@lang('main.date') </th>
            <th>@lang('main.total') </th>
            <th>عميل </th>
            <th>@lang('main.view')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $k => $invoice)
            <tr>
                <td>
                    {{ $invoice->invoice_no }}
                </td>
                <td>{{ $invoice->branch->br_name }}</td>

                <th>@lang('main.'.$invoice->invoice_type)</th>
                <td class="green-text">{{ $invoice->date }}</td>
                <td>{{ $invoice->net }}</td>
                <td>{{ @$invoice->accountInfo->acc_name }}</td>
                <td>
                    <a href="{{ URL::route('viewInvoice',array($invoice->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-action-pageview"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</section>
<!-- /Main Content -->

@stop
