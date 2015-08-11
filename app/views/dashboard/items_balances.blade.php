@extends('dashboard.main')
@section('content')


    {{--{{         Request::header('application/json') }}--}}
    {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>--}}
    {{--<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->--}}
    <div id="bank" class="col s12">
        {{--@if(Route::currentRouteName() == 'addTransHeader')--}}
        {{--{{ Form::open(array('route'=>array('storeTopic',$topic_type),'files'=>'true','data-parsley-validate')) }}--}}
        {{--@elseif(Route::currentRouteName() == 'editItemsBalances')--}}
        {{--{{ Form::model($item,array('route'=>array('updateItemsBalances',$item->id))) }}--}}
        {{--@endif--}}
        <div ng-app="itemApp"  ng-controller="mainController" class="card">
            {{ Form::open(array('route'=>array('storeItemsBalances'),'name'=>'form','novalidate')) }}
            {{--<form name="form" novalidate>--}}
            <div class="title">
                <h5><i class="mdi mdi-notification-event-available"></i> {{ @$title }}  </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
            <div class="content">
                <div class="row no-margin-top">


                    {{--<div class="col s2 l3">--}}

                        {{--{{ Form::label('data','التاريخ') }}--}}
                        {{--{{ Form::text('date',null,array('class'=>'pikaday','required','ng-model'=>'date','id'=>'data')) }}--}}
                        {{--<p class="parsley-required">{{ $errors ->first('data') }} </p>--}}
                    {{--</div> --}}{{--data--}}
                </div>
                <div class="row no-margin-top">
                    <div class="col s2 l1">
                        {{ Form::label('item_id','الصنف') }}
                    </div>


                    <div class="col s2 l3">
                        <i class="wi wi-day-cloudy"></i>

                        <input   ng-focus="displayOn()"   autocomplete="off" ng-model="item.name" id="item_id" autofocus="autofocus">

                        <ul id="itemsView" style="position: absolute ; margin:0px ;  box-shadow: -4px 4px 15px #888888"  ng-show="item">
                            <li  ng-model="item.name" style="width: 250px;background-color: #fff;cursor: pointer;display: list-item;margin:2px 2px 3px 2px "  ng-repeat="dbitem in items| filter:item.name" ng-click="selectItem(dbitem.item_name,dbitem.id)">@{{dbitem.item_name }}</li>
                        </ul>

                        {{--<select ng-model="item.id" id="item_id"  class="select2" >--}}
                        {{--<option  ng-repeat="dbitem in items" value="@{{ dbitem.id }}/@{{ dbitem.item_name }}" > @{{ dbitem.item_name }} </option>--}}
                        {{--</select>--}}



                        {{--{{ Form::text('name',null,array('autofocus','ng-model'=>"search",'id'=>'item_id')) }}--}}

                        <p class="parsley-required">{{ $errors ->first('item_id') }} </p>
                    </div> {{--item--}}
                    {{--@{{ items | filter:search | orderBy : item_name }}--}}
                    <div class="col s12 l2">
                        <div class="input-field">
                            <i class="mdi mdi-editor-attach-money prefix"></i>
                            {{ Form::number('quantity',null,array('ng-model'=>"item.quantity",'ng-minlength'=>"1",'ng-pattern'=>"/^[0-9]+$/",'id'=>'quantity')) }}
                            <div ng-show="form.$submitted || form.quantity.$touched">
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
                    </div> {{--quantity--}}

                    <div class="col s12 l2">
                        <div class="input-field">
                            <i class="mdi mdi-editor-attach-money prefix"></i>

                            {{ Form::number('costs',null,array('ng-enter'=>"addItem()", 'ng-model'=>"item.cost",'id'=>'cost')) }}
                            {{ Form::label('cost','القيمة') }}

                            <p class="parsley-required">{{ $errors ->first('cost') }} </p>
                        </div>
                    </div>

                    <div class="col s12 l2">
                        <div class="input-field">
                            <i class="mdi mdi-editor-attach-money prefix"></i>
                            <label for="item_id">
                                <button  type="button" ng-disabled="form.$invalid || hasItem(item.quantity) " ng-click="addItem()" class="waves-effect btn">اضف </button >
                            </label>
                        </div>
                    </div>
                </div> {{--first row end--}}
                <div class="row">

                </div>
                @include('dashboard.selected_items')


                <pre>
     {{--@{{ invoiceItems }}--}}

                    {{--@{{ invoice_sub_total() }}--}}
</pre>




                <style type="text/css">
                    input.ng-invalid.ng-touched {
                        background-color: #FA787E!important;
                    }

                    input.ng-valid.ng-touched {
                        background-color: #78FA89!important;
                    }
                </style>

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
            <div class="row">
                <div class="col s12 l12">

                    <button ng-disabled="form.$invalid || hasInvoiceItems()" type="submit" class="waves-effect btn">@lang('main.add')</button>

                    {{--<button  ng-click="submitItem" type="submit" class="waves-effect btn">تعديل </button>--}}

                </div>
                {{ Form::close() }}
            </div>{{--submit  row end--}}
        </div>
    </div>
    </div>
    </div>
    @include('include.search')

    </section>
@stop