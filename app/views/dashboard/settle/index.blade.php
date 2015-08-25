@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
<div  ng-init='invoiceItems ={{ isset($newArray)?json_encode($newArray):'[]' }}' ng-app="itemApp"  ng-controller="mainController" class="card">
    {{ Form::open(array('route'=>array('storeSettle',$type),'name'=>'form','novalidate')) }}
    <div class="title">
        <h5>
            <i class="mdi mdi-notification-event-available"></i>
            {{ @$title }}
        </h5>
        <a class="minimize" href="#">
          <i class="mdi-navigation-expand-less"></i>
        </a>
        <a style="float: left;height:30px;line-height:32px;font-size: medium" type="button" href="{{ URL::route('viewSettles',array('type'=>$type)) }}" class="btn btn-small z-depth-0">
            عرض تسويات {{ @$name}}
        </a>
    </div>
    <div class="content">
      <div class="row no-margin-top">
         <div class="col s2 l3">
             @if($branch == 1)
                 <i class="mdi mdi-notification-event-available"></i>
                 {{ Form::label('branch_id','الفرع') }}
                 {{ Form::select('branch_id',array(null=>"اختر الفرع")+ $co_info->branches->lists('br_name','id'),null,array('id'=>'branch_id')) }}
                    <p class="parsley-required">{{ $errors ->first('branch_id') }} </p>
             @else
                    <br>
                <b> فرع :{{ $branch }}</b>
             @endif
         </div>{{--branch--}}
         <div class="col s2 l3">
             <i class="fa fa-calendar"></i>
             {{ Form::label('data','التاريخ') }}
             {{ Form::text('date',null,array('class'=>'pikaday','required','ng-model'=>'date','id'=>'data')) }}
             <p class="parsley-required">{{ $errors ->first('data') }} </p>
          </div> {{--data--}}

          <div class="col s2 l3">

              <i class="mdi mdi-editor-attach-money prefix active"></i>
              {{ Form::label('pay_type','طرق السداد') }}
              {{ Form::select('pay_type',array(null=>"أختر طريقة السداد ")+ $pay_type,null,array('id'=>'pay_type')) }}
              <p class="parsley-required">{{ $errors ->first('pay_type') }} </p>
          </div>{{--pay_type--}}


      </div>{{--first row end--}}

        {{-- start acount,item and quaintity  --}}
        <div class="row no-margin-top">

            <div class="col s2 l3">

                <i class="mdi mdi-communication-import-export"></i>
                {{ Form::label('account','الحساب ') }}
                {{ Form::select('account',array(null=>"اختر   نوع الحساب ")+ $account_type,null,array('id'=>'account')) }}
                <p class="parsley-required">{{ $errors ->first('account') }} </p>
            </div>{{--account--}}
            <div class="col s2 l1">
                {{ Form::label('item_id','الصنف') }}
            </div>
            <div class="col s2 l3">
                <i class="mdi-action-label"></i>
                <input   ng-focus="displayOn()"   autocomplete="off" ng-model="item.name" id="item_id" autofocus="autofocus">
                <ul id="itemsView" class="drop-down-menu" ng-show="item">
                    <li  ng-model="item.name" class="li-drop-down-menu"  ng-repeat="dbitem in items| filter:item.name" ng-click="selectItem(dbitem.item_name,dbitem.id,dbitem.has_serial)">@{{dbitem.item_name }}</li>
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


        </div>{{-- row end--}}
        {{-- end acount,item and quaintity  --}}


        {{-- start sum , discount ,tax and net--}}
        <div class="row no-margin-top">

            <div class="col s2 ">

                <i class="fa fa-cart-arrow-down"></i>
                {{ Form::label('sum',' الإجمالى') }}
                {{ Form::text('sum',null,array('id'=>'sum')) }}
                <p class="parsley-required">{{ $errors ->first('sum') }} </p>
            </div>{{--sum--}}
            <div class="col s2 ">

                <i class="mdi mdi-content-remove-circle"></i>
                {{ Form::label('discount','الخصم') }}
                {{ Form::text('discount',null,array('id'=>'discount')) }}
                <p class="parsley-required">{{ $errors ->first('discount') }} </p>
            </div>{{--discount--}}


            <div class="col s2 ">

                <i class="mdi mdi-maps-local-atm"></i>
                {{ Form::label('tax','ضريبة') }}
                {{ Form::text('discount',null,array('id'=>'tax')) }}
                <p class="parsley-required">{{ $errors ->first('tax') }} </p>
            </div>{{--tax--}}

            <div class="col s2 ">

                <i class="fa fa-exchange"></i>
                {{ Form::label('net','الصافى') }}
                {{ Form::text('discount',null,array('id'=>'net')) }}
                <p class="parsley-required">{{ $errors ->first('net') }} </p>
            </div>{{--net--}}

            <div class="col s2 ">
                <div class="input-field">
                    <label for="item_id">
                        <button ng-hide="item.has_serial" id="addItemBtn"  href="#addItem"  type="button" ng-disabled="form.$invalid || hasItem(item.quantity) " ng-click="addItem()" class="waves-effect btn">
                            اضف
                        </button >
                </div>
            </div>{{--button--}}


        </div>
        {{-- end sum , discount ,tax and net --}}

        @include('dashboard.settle._popup_div')

        <div class="row no-margin-top">
             <div class="col s12 l2">
                     <button ng-show="item.has_serial"  href="#addItem"  type="button" ng-disabled="form.$invalid || hasItem(item.quantity) " ng-click="addItem()" class="waves-effect btn modal-trigger">
                         اضف
                     </button >

                 </label>
            </div>
         {{-- single item button  div --}}
      </div>{{--seconud row end--}}

        <br>
        @include('dashboard.settle._view_table')
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