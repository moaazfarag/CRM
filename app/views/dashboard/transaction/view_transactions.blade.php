@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-invoice" ng-app>
    <div class="card" style="padding: 1%;">
        <div class="card-panel blue lighten-5 center_title">
            @lang('main.'.$type)
            فرع :
            {{ $branch->br_name }}
        </div>

        @include('include.messages')
        <div class="table-responsive" >

        <table id="table_bank" class="display table table-bordered table-striped table-hover">
            <thead>
            <tr>

                <th>@lang('main.invoiceNum')</th>
                <th>@lang('main.branchName') </th>
                @if($type != 'itemBalance')
                    <th>@lang('main.theType')</th>
                @endif
                <th>@lang('main.date') </th>
                @if(!TransController::isSettle($type))
                    <th>@lang('main.total') </th>
                    @if(PermissionController::isTrans('delete',$type))
                        <th>عميل</th>
                    @endif
                @endif
                <th>@lang('main.view')</th>
                @if(PermissionController::isTrans('delete',$type))
                    <th>@lang('main.cancel')</th>
                @endif
                <th>@lang('main.cancel_cause')</th>
                <th>بواسطة</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $k => $invoice)
                <tr>
                    <td>
                        {{ $invoice->invoice_no }}
                    </td>
                    <td>{{ $invoice->branch->br_name }}</td>
                    @if($type != 'itemBalance')
                        <th>@lang('main.'.$invoice->pay_type)</th>
                    @endif
                    <td class="green-text">{{ $invoice->date }}</td>
                    @if(!TransController::isSettle($type))
                        <td>{{ $invoice->net }}</td>
                        @if(PermissionController::isTrans('delete',$type))

                            <td>{{ @$invoice->accountInfo->acc_name }}</td>
                        @endif

                    @endif
                    <td>
                        <a href="{{ URL::route('viewTransaction',array($invoice->invoice_type,$branch->id,$invoice->invoice_no)) }}"
                           class="btn btn-small z-depth-0">
                            <i class="mdi mdi-action-pageview"></i>
                        </a>
                    </td>
                    @if(PermissionController::isTrans('delete',$type))
                        <td>
                            @if($invoice->deleted == 1)
                                تم الإلغاء
                            @else
                                <a href="#modal{{$invoice->invoice_no}}"
                                   class="btn waves-effect btn-danger red modal-trigger">[X]</a>
                            @endif
                        </td>
                    @endif
                    <td>
                        {{ $invoice->notes }}
                    </td>
                    <td>
                        {{ $invoice->user->name }}
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

                        <div class="col s12 l10">
                            <div class="input-field">
                                <?php $cancel_cause = Lang::get('main.cancel_cause') ?>
                                {{ Form::open(array('route'=>array('cancelTrans'),'name'=>'form')) }}
                                {{ Form::label('cancel_cause',$cancel_cause)}}
                                {{ Form::text('cancel_cause',null,array('required','id'=>'cancel_cause','ng-model'=>'cancel_cause','class'=>"materialize-textarea" ,'length'=>"200")) }}

                                <p class="parsley-required">{{ $errors ->first('notes') }} </p>
                            </div>
                        </div> {{--notes--}}


                        </p>
                    </div>
                    <div class="modal-footer">
                        <button ng-disabled="!cancel_cause"
                                class="modal-action modal-close waves-effect waves-red btn  ">إلغاء الفاتورة
                        </button>
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
    </div>
</section>
<!-- /Main Content -->

@stop
