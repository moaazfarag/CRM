@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    {{--{{         Request::header('application/json') }}--}}
    {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>--}}
    {{--<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->--}}
        {{--@if(Route::currentRouteName() == 'addTransHeader')--}}
        {{--{{ Form::open(array('route'=>array('storeTopic',$topic_type),'files'=>'true','data-parsley-validate')) }}--}}
        {{--@elseif(Route::currentRouteName() == 'editItemsBalances')--}}
        {{--{{ Form::model($item,array('route'=>array('updateItemsBalances',$item->id))) }}--}}
        {{--@endif--}}
        <div ng-app="itemApp"  ng-controller="mainController" class="card">
            {{ Form::open(array('route'=>array('storeItemsBalances'),'name'=>'form','novalidate')) }}
            <div class="title">
                <h5>
                    <i class="mdi mdi-notification-event-available"></i>
                    {{ @$title }}
                    {{--title of card--}}
                </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
            <div class="content">
                <div class="row no-margin-top">
                    <div class="col s2 l1">
                        {{ Form::label('item_id','الصنف') }}
                    </div>
                    <div class="col s2 l3">
                        <i class="mdi-action-label"></i>
                        <input   ng-focus="displayOn()"   autocomplete="off" ng-model="item.name" id="item_id" autofocus="autofocus">
                        <ul id="itemsView" class="drop-down-menu"  ng-show="item">
                            <li  ng-model="item.name" class="li-drop-down-menu"  ng-repeat="dbitem in items| filter:item.name" ng-click="selectItem(dbitem.item_name,dbitem.id,dbitem.has_serial)">@{{dbitem.item_name }}</li>
                        </ul>
                        <p class="parsley-required">
                            {{ $errors ->first('item_id') }}
                        </p>
                    </div>  {{-- item div--}}
                    <div class="col s12 l2">
                        <div class="input-field">
                            <i class="fa fa-database prefix"></i>
                            {{ Form::number('quantity',null,array('ng-model'=>"item.quantity",'ng-pattern'=>"/^[0-9]+$/",'id'=>'quantity')) }}
                            <div class="error-div" ng-show="form.$submitted || form.quantity.$touched">
                                <span ng-show="form.quantity.$error.pattern">
                                    برجاء ادخل رقم صحيح
                                </span>
                                <span ng-show="form.quantity.$error.required">
                                        هذا الحقل مطلوب
                                </span>
                            </div>
                            {{ Form::label('quantity','الكمية') }}
                            <p class="parsley-required">{{ $errors ->first('quantity') }} </p>
                        </div>
                    </div> {{-- quantity div --}}
                    <div class="col s12 l2">
                        <div class="input-field">
                            <i class="mdi mdi-editor-attach-money prefix"></i>
                            {{ Form::number('cost',null,array('ng-pattern'=>"/^[0-9]+$/", 'ng-model'=>"item.cost",'id'=>'cost')) }}
                            <div class="error-div" ng-show="form.$submitted || form.cost.$touched">
                                <span class="errorMessage" ng-show="form.cost.$error.pattern">
                                    برجاء ادخل رقم صحيح
                                </span>
                                <span ng-show="form.cost.$error.required">
                                        هذا الحقل مطلوب
                                </span>
                            </div>
                            {{ Form::label('cost','القيمة') }}

                            <p class="parsley-required">{{ $errors ->first('cost') }} </p>
                        </div>
                    </div> {{-- cost div --}}
                    <div class="col s12 l2">
                        <div class="input-field">
                            <label for="item_id">
                                <button ng-hide="item.has_serial" href="#addItem" type="button" ng-disabled="form.$invalid || hasItemBalance(item.cost) " ng-click="addItem()" class="waves-effect btn">اضف </button >
                                <button ng-show="item.has_serial"  href="#addItem"  type="button" ng-disabled="form.$invalid || hasItem(item.quantity) " ng-click="addItem()" class="waves-effect btn modal-trigger">
                                    اضف
                                </button >
                                @include('dashboard.settle._popup_div')
                            </label>
                        </div>
                    </div> {{-- button of one item div--}}
                </div> {{--first row end--}}
                @include('dashboard.items_balances._view_table')
                <br>
                <br>
                <div class="row">
                    <div class="col s12 l12">
                        <button ng-disabled="form.$invalid || hasInvoiceItems()" type="submit" class="waves-effect btn">@lang('main.add')</button>
                        {{ Form::close() }}{{--<button  ng-click="submitItem" type="submit" class="waves-effect btn">تعديل </button>--}}
                    </div>

                </div>{{--submit  row end--}}

                {{--<div class="col s12 m6 l4">--}}
                {{--<div class="input-field">--}}
                {{--<i class="fa fa-barcode prefix"></i>--}}
                {{--{{ Form::text('serial_no',null,array('id'=>'serial_no')) }}--}}
                {{--{{ Form::label('serial_no','السيريال') }}--}}
                {{--<p class="parsley-required">{{ $errors ->first('serial_no') }} </p>--}}
                {{--</div>--}}
                {{--</div>--}}{{--bar_code--}}

            </div> {{--secound row end--}}
            <br>

        </div>
    </div>



    </section>
@stop