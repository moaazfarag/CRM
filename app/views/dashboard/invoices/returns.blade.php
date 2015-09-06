@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    <div  ng-init='invoiceItems ={{ isset($newArray)?json_encode($newArray):'[]' }}' ng-app="itemApp"  ng-controller="mainController" class="card">
        {{ Form::open(array('route'=>array('storeSettle',@$type),'name'=>'form','novalidate')) }}
        <div class="title">
            <h5>
                <i class="mdi mdi-notification-event-available"></i>
                {{ @$title }}
            </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
            <a style="float: left;height:30px;line-height:32px;font-size: medium" type="button" href="{{ URL::route('viewSettles',array('type'=>@$type)) }}" class="btn btn-small z-depth-0">
                 {{ @$name}}
            </a>
        </div>
        <div class="content">
            <div class="row no-margin-top">
                <div class="col s2 l3">
                    @if($branch == 1)
                        <i class="mdi mdi-notification-event-available"></i>
                        {{ Form::label('branch_id',Lang::get('main.branch')) }}
                        <?php $select_branch = Lang::get('main.select_branch'); ?>
                        {{ Form::select('branch_id',array(null=>$select_branch)+ $co_info->branches->lists('br_name','id'),null,array('id'=>'branch_id')) }}
                        <p class="parsley-required">{{ $errors ->first('branch_id') }} </p>
                    @else
                        <br>
                        <b> @lang('main.branch') :{{ $branch }}</b>
                    @endif
                </div>{{--branch--}}
                <div class="col s2 l3">
                    <i class="fa fa-calendar"></i>
                    {{ Form::label('data',Lang::get('main.date')) }}
                    {{ Form::text('date',null,array('class'=>'pikaday','required','ng-model'=>'date','id'=>'data')) }}
                    <p class="parsley-required">{{ $errors ->first('data') }} </p>
                </div> {{--data--}}



                {{--@{{ accounts }}--}}
            </div>{{--first row end--}}

            {{-- start acount,item and quaintity  --}}
            <div class="row no-margin-top">
                <div class="col s2 l3">

                    <i class="mdi mdi-editor-attach-money prefix active"></i>
                    {{ Form::label('pay_type',Lang::get('main.payment')) }}
                    {{ Form::select('pay_type',array(null=>Lang::get('main.select_payment'))+ $pay_type,null,array('id'=>'pay_type','ng-model'=>'pay_type')) }}
                    <p class="parsley-required">{{ $errors ->first('pay_type') }} </p>
                </div>{{--pay_type--}}
                <div class="col s2 l3">

                    <i class="mdi mdi-communication-import-export"></i>
                    {{ Form::label('account',lang::get('main.account')) }}
                    {{ Form::select('account',array(null=>lang::get('main.select_account'))+ $account_type,null,array('id'=>'account','ng-required'=>'pay_type == 1','ng-model'=>'account.type','ng-change'=>'getAccountsByType()')) }}
                    <p class="parsley-required">{{ $errors ->first('account') }} </p>
                </div>{{--account--}}
                <div ng_show="account.type" class="col s2 l3">

                    <i class="mdi mdi-communication-import-export"></i>
                    {{ Form::label('account',Lang::get('main.account')) }}
                    <select  class='browser-default'>
                        <option value="@{{ account.id }}" ng-repeat="account in accounts">@{{ account.acc_name }}</option>
                    </select>
                    {{--{{ Form::select('account',array(null=>"«Œ —   ‰Ê⁄ «·Õ”«» ")+ $account_type,null,array('id'=>'account','ng-model'=>'account.type','ng-change'=>'getAccountsByType()','class'=>'browser-default')) }}--}}
                    <p class="parsley-required">{{ $errors ->first('account') }} </p>
                </div>{{--account--}}
            </div>
            <div class="row">
                <div class="col s2 l1">
                    {{ Form::label('item_id',lang::get('main.item')) }}
                </div>
                <div class="col s2 l3">
                    <i class="mdi-action-label"></i>
                    <input   ng-focus="displayOn()"   autocomplete="off" ng-model="item.name" id="item_id" autofocus="autofocus">
                    <ul id="itemsView" class="drop-down-menu" ng-show="item">
                        <li  ng-model="item.name" class="li-drop-down-menu"  ng-repeat="dbitem in items| filter:item.name" ng-click="selectItem(dbitem.item_name,dbitem.id,dbitem.has_serial,dbitem.sell_users)">@{{dbitem.item_name }}</li>
                    </ul>
                    <p class="parsley-required">{{ $errors ->first('item_id') }} </p>
                </div> {{-- item div --}}
                <div class="col s12 l2">
                    <div class="input-field">
                        <i class="fa fa-database prefix"></i>
                        {{ Form::number('quantity',null,array('ng-model'=>"item.quantity",'ng-minlength'=>"1",'ng-pattern'=>"/^[0-9]+$/",'id'=>'quantity')) }}
                        <div ng-show="form.$submitted || form.quantity.$touched">
                    <span ng-show="form.quantity.$error.pattern">
                        @lang('main.please_enter_valid_number')
                    </span>
                    <span ng-show="form.quantity.$error.required">
                         @lang('main.please_enter_valid_number')
                    </span>

                        </div>
                        {{ Form::label('quantity',Lang::get('main.quantity')) }}
                        <p class="parsley-required">{{ $errors ->first('quantity') }} </p>
                    </div>
                </div> {{-- quantity div--}}
                <div class="col s2 ">
                    <div class="input-field">
                        <label for="item_id">
                            <button ng-show="item.has_serial"  href="#addItem"  type="button" ng-disabled="form.$invalid || hasItem(item.quantity) " ng-click="addItem()" class="waves-effect btn modal-trigger">
                                @lang('main.add')
                            </button >
                            <button ng-hide="item.has_serial" id="addItemBtn"  href="#addItem"  type="button" ng-disabled="form.$invalid || hasItem(item.quantity) " ng-click="addItem()" class="waves-effect btn">
                                @lang('main.add')
                            </button >
                        </label>
                    </div>
                </div>{{-- single item button  div --}}
            </div>


            {{-- end acount,item and quaintity  --}}




            @include('dashboard.settle._popup_div')


            <br>
            @include('dashboard.invoices._view_table')
            {{-- start sum , discount ,tax and net--}}
            <div class="row no-margin-top">

                <div class="col s2 ">

                    <i class="fa fa-cart-arrow-down"></i>
                    {{ Form::label('sum',Lang::get('main.total')) }}
                    <br>
                    @{{ invoice_sub_total() }}
                    {{--{{ Form::text('sum',null,array('id'=>'sum')) }}--}}
                    <p class="parsley-required">{{ $errors ->first('sum') }} </p>
                </div>{{--sum--}}
                <div class="col s2 ">

                    <i class="mdi mdi-content-remove-circle"></i>
                    {{ Form::label('discount',Lang::get('main.discount_')) }}
                    {{ Form::text('discount',null,array('id'=>'discount','ng-model'=>'discount')) }}
                    <p class="parsley-required">{{ $errors ->first('discount') }} </p>
                </div>{{--discount--}}


                <div class="col s2 ">

                    <i class="mdi mdi-maps-local-atm"></i>
                    {{ Form::label('tax',Lang::get('main.tax_')) }}
                    {{ Form::number('discount',null,array('id'=>'tax')) }}
                    <p class="parsley-required">{{ $errors ->first('tax') }} </p>
                </div>{{--tax--}}

                <div class="col s2 ">

                    <i class="fa fa-exchange"></i>
                    <br>
                    @{{ invoice_sub_total() - (invoice_sub_total()*(discount/100)) }}
                    <p class="parsley-required">{{ $errors ->first('net') }} </p>
                </div>{{--net--}}

            </div>
            {{-- end sum , discount ,tax and net --}}
            <div class="row">
                <div class="col s12 l12">
                    <button ng-disabled="form.$invalid || hasInvoiceItems()" type="submit" class="waves-effect btn">@lang('main.add')</button>
                </div>
                {{ Form::close() }}
            </div>{{--submit  row end--}}
            {{--<div class="col s12 m6 l4">--}}
            {{--<div class="input-field">--}}
            {{--<i class="fa fa-barcode prefix"></i>--}}
            {{--{{ Form::text('serial_no',null,array('id'=>'serial_no')) }}--}}
            {{--{{ Form::label('serial_no','«·”Ì—Ì«·') }}--}}
            {{--<p class="parsley-required">{{ $errors ->first('serial_no') }} </p>--}}
            {{--</div>--}}
            {{--</div>--}}{{--bar_code--}}
        </div> {{--secound row end--}}

    </div>



</section>
@stop