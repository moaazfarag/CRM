@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section   class="content-wrap ecommerce-invoice">
    <table id="table_bank" class="display table table-bordered table-striped table-hover">
        <thead>
        <tr>

            <th>@lang('main.number') </th>
            <th>@lang('main.branchName') </th>
            <th>@lang('main.invoiceNum')</th>
            <th>@lang('main.theType')</th>
            <th>@lang('main.date') </th>
            <th>@lang('main.view')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $k => $invoice)
            <tr>

                <th>{{ $k }}</th>
                <td>{{ $invoice->branch->br_name }}</td>
                <td>
                        {{ $invoice->invoice_no }}
                </td>
                <th>@lang('main.'.$invoice->invoice_type)</th>
                <td class="green-text">{{ $invoice->date }}</td>
                <td>
                    <a href="{{ URL::route('viewSettle',array($invoice->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-editor-mode-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</section>
<!-- /Main Content -->
@stop
