@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    <div ng-init='invoiceItems ={{ isset($newArray)?json_encode($newArray):'[]' }}' ng-app="itemApp"
         ng-controller="mainController" class="card">
        {{ Form::open(array('route'=>array('storeTrans',$type,$branch->id),'name'=>'form','novalidate')) }}
        <div class="title">
            <h5>
                <i class="mdi mdi-notification-event-available"></i>
                {{ @$title }}

                فرع
                :{{ $branch->br_name }}
            </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
            <a style="float: left;height:30px;line-height:32px;font-size: medium" type="button"
               href="{{URL::route('viewTransactions',[$type,$branch->id]) }}" class="btn btn-small z-depth-0">
                {{ @$name}}
            </a>
        </div>
        <input name="trans_id" type="hidden" value="@{{ header.id }}">
        @if(PermissionController::isTrans('add',$type))
            <div class="content">
                <div class="row">
                    {{-- ##### date start ######--}}
                    <div class="col s12 l3">
                        <i class="fa fa-calendar"></i>
                        {{ Form::label('data',Lang::get('main.date')) }}
                        <?php $date = new dateTime;
                        ?>

                        <input required="required"
                               type="date"
                                {{--ng-model="date = Date()"--}}
                               autofocus="autofocus"
                               id="data"
                               value="{{$date->format('Y-m-d')}}"
                               max="{{$date->modify('+1 day')->format('Y-m-d')}}"
                               min="{{$date->modify('-1 day')->format('Y-m-d')}}"
                               name="date">

                        <p class="parsley-required">{{ $errors ->first('data') }} </p>
                    </div> {{--date--}}

                    <div class="col s12 l3">

                        <i class="mdi mdi-editor-attach-money prefix active"></i>
                        {{ Form::label('pay_type',Lang::get('main.payment')) }}
                        {{ Form::select('pay_type',$pay_type,null,array('id'=>'pay_type','ng-model'=>'pay_type','required', 'class'=>'browser-default')) }}
                        <p class="parsley-required">{{ $errors ->first('pay_type') }} </p>
                    </div>{{--pay_type--}}
                    <div class="col s12 l3">

                        <i class="mdi mdi-communication-import-export"></i>
                        {{ Form::label('account',lang::get('main.account')) }}
                        {{ Form::select('account',array(null=>lang::get('main.select_account'))+ $account_type,null,array('id'=>'account','ng-required'=>'pay_type == "on_account"','ng-model'=>'account.type','ng-change'=>'getAccountsByType()')) }}
                        <p class="parsley-required">{{ $errors ->first('account') }} </p>
                    </div>{{--account--}}
                    <div ng_show="account.type" class="col s2 l3">

                        <i class="mdi mdi-communication-import-export"></i>
                        {{ Form::label('account',Lang::get('main.account')) }}
                        <select name="account_id" ng-required='pay_type == "on_account"' ng-change='getAccountInfo()'
                                ng-model="account.id" class='browser-default'>
                            <option value="@{{ account.id }}"
                                    ng-repeat="account in accounts">@{{ account.acc_name }}</option>
                        </select>
              <span style="color: red">
                  @{{ isLimit() }}
              </span>
                        @{{  seletedAccount.pricing }}
                        {{--{{ Form::select('account',array(null=>"اختر   نوع الحساب ")+ $account_type,null,array('id'=>'account','ng-model'=>'account.type','ng-change'=>'getAccountsByType()','class'=>'browser-default')) }}--}}
                        <p class="parsley-required">{{ $errors ->first('account') }} </p>
                    </div>{{--account--}}
                </div>
                <div class="row">
                    <div class="col s12 l4" style="margin: 2% 1%;">
                        <div class="input-field">
                            <i class="fa fa-database prefix"></i>
                            {{ Form::label('invoice_no',"رقم الفاتورة") }}
                            {{ Form::number('invoice_no',null,array('ng-model'=>"invoice.invoiceNo",'ng-minlength'=>"1",'ng-pattern'=>"/^[0-9]+$/",'id'=>'invoice_no')) }}

                            <button href="#addItem" ng-disabled="!invoice.invoiceNo" type="button"
                                    ng-click="invoiceData('{{$type }}','{{ $branch->id}}')"
                                    class="waves-effect btn modal-trigger">
                                @lang('main.add')
                            </button>

                        </div>

                        <button ng-show="account.id" href="#addFromInvoices" ng-disabled=" !account.id" type="button"
                                ng-click="invoiceData('{{$type }}','{{ $branch->id}}')"
                                class="waves-effect btn modal-trigger">
                            مرتجعات من فواتير عميل محدد
                        </button>


                    </div>
                </div>


                {{--@{{ accounts }}--}}


                {{-- start acount,item and quaintity  --}}

                {{--<button  type="button" ng-disabled="!invoice.invoiceNo" class="waves-effect btn" ng-click="invoiceData()">@lang('view')</button>--}}


                <br>

                <div ng-show="header.invoice_no && invoiceItems">
                    رقم الفاتورة : @{{ header.invoice_no }}
                    تاريخ الفاتورة : @{{ header.date }}
                    طريقة الدفع : @{{ header.pay_type }}

                </div>

                @include('dashboard.transaction._table._return')
                {{-- start sum , discount ,tax and net--}}
                <div class="row no-margin-top">

                    <div class="col s2 ">

                        <i class="fa fa-cart-arrow-down"></i>
                        {{ Form::label('sum',Lang::get('main.total')) }}
                        <br>
                        @{{ returnInvoiceTotal() }}
                        {{--{{ Form::text('sum',null,array('id'=>'sum')) }}--}}
                        <p class="parsley-required">{{ $errors ->first('sum') }} </p>
                    </div>{{--sum--}}




                </div>
                {{-- end sum , discount ,tax and net --}}
                <div class="row">
                    <div class="col s12 l12">
                        <button ng-disabled="form.$invalid" type="submit"
                                class="waves-effect btn">@lang('main.add')</button>
                    </div>
                    {{ Form::close() }}
                    @include('dashboard.transaction._pop_up._return')
                    @include('dashboard.transaction._pop_up._return_invoices')

                </div>
            </div> {{--secound row end--}}
        @endif

    </div>


</section>
@stop