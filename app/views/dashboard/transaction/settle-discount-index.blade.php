@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
<div  ng-init='invoiceItems ={{ isset($newArray)?json_encode($newArray):'[]' }}' ng-app="itemApp"  ng-controller="mainController" class="card">
    {{ Form::open(array('route'=>array('storeTrans',$type,$branch->id),'name'=>'form','novalidate')) }}
    <div class="title">
        <h5>
            <i class="mdi mdi-notification-event-available"></i>
            {{ @$title }}
        </h5>
        <a class="minimize" href="#">
          <i class="mdi-navigation-expand-less"></i>
        </a>
        <a style="float: left;height:30px;line-height:32px;font-size: medium" type="button" href="{{ URL::route('viewTransactions',[$type,$branch->id]) }}" class="btn btn-small z-depth-0">
            عرض تسويات {{ @$name}}
        </a>
    </div>
    <div class="content">
      <div class="row no-margin-top">
          <div class="col s2 l3">

              <br>
              <b> @lang('main.branch') :{{ $branch->br_name }}</b>

          </div>{{--branch--}}
          <div class="col s2 l3">
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



      </div>{{--first row end--}}

        {{-- start acount,item and quaintity  --}}
        <div class="row no-margin-top">


            <div class="col s2 l1">
                {{ Form::label('item_id','الصنف') }}
            </div>
            <div class="col s2 l3">
                <i class="mdi-action-label"></i>
                <input   ng-focus="displayOn(br_id)"   autocomplete="off" ng-model="item.item_name" id="item_id" autofocus="autofocus">
                <ul id="itemsView" class="drop-down-menu" ng-show="item">
                    <li  ng-model="item.item_name"
                         class="li-drop-down-menu"
                         ng-repeat="dbitem in items| filter:item.name"
                         ng-click="selectItem(dbitem)">
                        @{{dbitem.item_name }}
                    </li>
                </ul>
                <p class="parsley-required">{{ $errors ->first('item_id') }} </p>
            </div> {{-- item div --}}
            <div class="col s12 l2">
                <div class="input-field">
                    <i class="fa fa-database prefix"></i>
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
            </div> {{-- quantity div--}}
            <div class="col s2 ">
                <div class="input-field">
                    <label for="item_id">
                        <button ng-click=" serialItem(br_id,item.id)"  ng-show="item.has_serial"  href="#addItem"  type="button" ng-disabled="form.$invalid || hasItem(item.quantity)|| itemBalance() "  class="waves-effect btn modal-trigger">
                            اضف
                        </button >
                        <button ng-hide="returnBalance(item)" id="addItemBtn"  href="#addItem"  type="button" ng-disabled="form.$invalid || hasItem(item.quantity)||itemBalance() " ng-click="addItem()" class="waves-effect btn">
                            اضف
                        </button >
                        </label>
                </div>

            </div>{{-- single item button  div --}}
            <div style="margin-right:10px" class="col s12 l2  " ng-show="item.item_name && item.id" >
                الرصيد الحالي هو
                @{{ item.balance - item.quantity }}
                <div style="color: #ea1c18;clear: both"  ng-show="itemBalance() && item.id">
                    لا يوجد رصيد لهذا المنتج
                </div>
            </div>

        </div>{{-- row end--}}
        {{-- end acount,item and quaintity  --}}



        @include('dashboard.transaction._pop_up._discount')
        @include('dashboard.transaction._table._table')

        <br>
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
                      {{--{{ Form::label('serial_no','السيريال') }}--}}
                    {{--<p class="parsley-required">{{ $errors ->first('serial_no') }} </p>--}}
                  {{--</div>--}}
              {{--</div>--}}{{--bar_code--}}
      </div> {{--secound row end--}}

</div>



</section>
@stop