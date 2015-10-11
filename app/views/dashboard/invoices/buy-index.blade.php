@extends('dashboard.main')
@section('content')
        {{--{{ dd(BaseController::getBranchId()) }}--}}
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
<div  ng-init='invoiceItems ={{ isset($newArray)?json_encode($newArray):'[]'}};transType= "{{ $type }}"' ng-app="itemApp"  ng-controller="mainController" class="card">
    {{ Form::open(array('route'=>array('storeInvoice',$type,$br_id),'name'=>'form','novalidate')) }}
    <div class="title">
        <h5>
            <i class="mdi mdi-notification-event-available"></i>
            {{ @$title }}
        </h5>
        <a class="minimize" href="#">
          <i class="mdi-navigation-expand-less"></i>
        </a>
        <a style="float: left;height:30px;line-height:32px;font-size: medium" type="button" href="{{ URL::route('viewInvoices',array('type'=>@$type)) }}" class="btn btn-small z-depth-0">
            @lang('main.view_invoices')  {{ @$name}}
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

{{--{{  dd(Items::getItemsWithBalance()); }}--}}

      </div>{{--first row end--}}

        {{-- start acount,item and quaintity  --}}
        <div class="row no-margin-top">
            <div class="col s2 l3">

                <i class="mdi mdi-editor-attach-money prefix active"></i>
                {{ Form::label('pay_type',Lang::get('main.payment')) }}
                {{ Form::select('pay_type',$pay_type,null,array('id'=>'pay_type','ng-model'=>'pay_type','required', 'class'=>'browser-default')) }}
                <p class="parsley-required">{{ $errors ->first('pay_type') }} </p>
            </div>{{--pay_type--}}
            <div class="col s2 l3">

                <i class="mdi mdi-communication-import-export"></i>
                {{ Form::label('account',lang::get('main.account')) }}
                {{ Form::select('account',array(null=>lang::get('main.select_account'))+ $account_type,null,array('id'=>'account','ng-required'=>'pay_type == "on_account"','ng-model'=>'account.type','ng-change'=>'getAccountsByType()')) }}
                <p class="parsley-required">{{ $errors ->first('account') }} </p>
            </div>{{--account--}}
            <div ng_show="account.type" class="col s2 l3">

                <i class="mdi mdi-communication-import-export"></i>
                {{ Form::label('account',Lang::get('main.account')) }}
                <select  name="account_id" ng-required='pay_type == "on_account"' ng-change='getAccountInfo()' ng-model="account.id"  class='browser-default'>
                        <option value="@{{ account.id }}" ng-repeat="account in accounts">@{{ account.acc_name }}</option>
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
            <div class="col s2 l1">
                {{ Form::label('item_id',lang::get('main.item')) }}
            </div>
            <div class="col s2 l3">
                <i class="mdi-action-label"></i>
                    <input   ng-focus="displayOn({{ $br_id }})"   autocomplete="off" ng-model="item.item_name" id="item_id" autofocus="autofocus">

                <ul id="itemsView" class="drop-down-menu" ng-show="item">
                    <li  ng-model="item.item_name"
                         class="li-drop-down-menu"
                         ng-repeat="dbitem in items| filter:item.item_name"
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
                <div class="col s12 l2">
                <div class="input-field">
                    <i class="fa fa-database prefix"></i>
                    {{ Form::number('cost',null,array('ng-model'=>"item.cost",'ng-minlength'=>"1",'ng-pattern'=>"/^[0-9]+$/",'id'=>'cost')) }}
                    <div ng-show="form.$submitted || form.cost.$touched">
                    <span ng-show="form.cost.$error.pattern">
                        @lang('main.please_enter_valid_number')
                    </span>
                    <span ng-show="form.cost.$error.required">
                         @lang('main.please_enter_valid_number')
                    </span>

                    </div>
                    {{ Form::label('cost',Lang::get('main.cost')) }}
                    <p class="parsley-required">{{ $errors ->first('cost') }} </p>
                </div>
            </div> {{-- cost div--}}
                <div class="col s2 ">
                    <div class="input-field">
                        <label for="item_id">
                                <button ng-show="item.has_serial"  href="#addItem"  type="button" ng-disabled="form.$invalid || hasItem() "  ng-click=" serialItem({{ $br_id}},item.id)" class="waves-effect btn modal-trigger">
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

        {{--@{{  form.pay_type }}--}}

        @include('dashboard.settle._add_popup_div')


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
                {{ Form::number('discount',0,array('id'=>'discount','ng-model'=>'discount')) }}
                <p class="parsley-required">{{ $errors ->first('discount') }} </p>
            </div>{{--discount--}}


            <div class="col s2 ">

                <i class="mdi mdi-maps-local-atm"></i>
                {{ Form::label('tax',Lang::get('main.tax_')) }}
                {{ Form::number('tax',null,array('id'=>'tax')) }}
                <p class="parsley-required">{{ $errors ->first('tax') }} </p>
            </div>{{--tax--}}

            <div class="col s2 ">

                <i class="fa fa-exchange"></i>
                <br>
                @{{ afterDiscount() }}
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
                      {{--{{ Form::label('serial_no','السيريال') }}--}}
                    {{--<p class="parsley-required">{{ $errors ->first('serial_no') }} </p>--}}
                  {{--</div>--}}
              {{--</div>--}}{{--bar_code--}}
      </div> {{--secound row end--}}

</div>



</section>
@stop