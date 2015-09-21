@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section   class="content-wrap ecommerce-invoice" ng-app>
    <div class="card">
    <table id="table_bank" class="display table table-bordered table-striped table-hover">
        <thead>
        <tr>

            <th>@lang('main.number') </th>
            <th>@lang('main.branchName') </th>
            <th>@lang('main.invoiceNum')</th>
            <th>@lang('main.theType')</th>
            <th>@lang('main.date') </th>
            <th>@lang('main.view')</th>
            <th>@lang('main.cancel')</th>
            <th>@lang('main.cancel_cause')</th>

        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $k => $invoice)
            <tr>
                <td>{{ $k }}</td>
                <td>{{ $invoice->branch->br_name }}</td>
                <td>
                        {{ $invoice->invoice_no }}
                </td>
                <td>@lang('main.'.$invoice->invoice_type)</td>
                <td class="green-text">{{ $invoice->date }}</td>
                <td>
                    <a href="{{ URL::route('viewSettle',array($invoice->id)) }}" class="btn btn-small z-depth-0">
                        <i class="mdi mdi-action-pageview"></i>
                    </a>
                </td>
                <td>
                    @if($invoice->deleted == 1)
                    تم الإلغاء
                    @else
                    <a  href="#modal{{$invoice->invoice_no}}" class="btn waves-effect btn-danger red modal-trigger">[X]</a>
                    @endif
                </td>
                <td>
                        {{ $invoice->notes }}
                </td>
            </tr>

            <!--/////////// model start }}}}}}}}}}}}}}-->
            @unless($invoice->deleted == 1)
            <!-- Modal Structure -->
            <div id="modal{{$invoice->invoice_no}}" class="modal">
                <div class="modal-content">
                    <div class="card-panel red lighten-4">
                    <h4>
                    إلغاء الفاتورة رقم
                        {{ $invoice->invoice_no }}

                    </h4>
                    </div>
                    <p>
                        {{ Form::open(array('route'=>'cancelInvoice','name'=>'form')) }}

                    <div class="col s12 l10">
                        <div class="input-field">
                            <?php $cancel_cause=Lang::get('main.cancel_cause') ?>
                                {{ Form::label('cancel_cause',$cancel_cause)}}
                                {{ Form::text('cancel_cause',null,array('id'=>'cancel_cause','ng-model'=>'cancel_cause','class'=>"materialize-textarea" ,'length'=>"200")) }}



                            <p class="parsley-required">{{ $errors ->first('notes') }} </p>
                        </div>
                    </div> {{--notes--}}



                    </p>
                </div>
                <div class="modal-footer">
                    <button ng-disabled="!cancel_cause" class="modal-action modal-close waves-effect waves-red btn  ">إلغاء الفاتورة</button>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">تراجع</a>
                    {{ Form::hidden('invoice_no',$invoice->invoice_no) }}
                    {{ Form::hidden('invoice_type',$invoice->invoice_type) }}
                    {{ Form::close() }}
                </div>
            </div>
            @endunless
            <!--/////////// model end }}}}}}}}}}}}}}-->

        @endforeach
        </tbody>
    </table>
    </div>
</section>
<!-- /Main Content -->

@stop
