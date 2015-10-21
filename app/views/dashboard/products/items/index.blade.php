@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section  ng-app="itemApp"  ng-controller="mainController"  class="content-wrap ecommerce-dashboard">
      <div id="bank" class="col s12">



            @if(Route::currentRouteName() == 'addItem')
        {{ Form::open(array('route'=>array('storeItem'))) }}
            @elseif(Route::currentRouteName() == 'editItem')
              {{ Form::model($item,array('route'=>array('updateItem',$item->id))) }}
          @endif
        <div class="card">
          <div class="title">
            <h5><i class="mdi mdi-notification-event-available"></i> {{ @$title }}  </h5>
            <a class="minimize" href="#">
              <i class="mdi-navigation-expand-less"></i>
            </a>
          </div>
      <div class="content">
          @include('include.messages')

          <div class="row no-margin-top">
              <div class="col s12 l4">
                  <div class="input-field">
                      <i class="fa fa-tag prefix"></i>
                      <?php $itemName=Lang::get('main.itemName') ?>
                      {{ Form::text('item_name',null,array('required','id'=>'item_name',)) }}
                      {{ Form::label('item_name',$itemName) }}
                      <p class="parsley-required">{{ $errors ->first('item_name') }} </p>
                  </div>
             </div>  {{--name--}}

              @if($co_info->co_use_serial)
              <div class="col s2 l2">
                  <p>
                      <?php $serial=Lang::get('main.serial') ?>
                      {{ Form::checkbox('has_serial',1,null,array('id'=>'has_serial')) }}
                      {{ Form::label('has_serial',$serial) }}
                  <p class="parsley-required">
                      {{ $errors ->first('has_serial') }}
                  </p>
                  {{--<input name="use_serial_no" type="checkbox" id="use_serial_no" value="use_serial_no"  >--}}
                  </p>
              </div>
              @endif
                  <div class="col s12  l4">
                      <div class="input-field">
                          <i class="fa fa-barcode prefix"></i>
                          <?php $bar_code=Lang::get('main.bar_code') ?>
                          {{ Form::text('bar_code',null,array('id'=>'bar_code')) }}
                          {{ Form::label('bar_code',$bar_code) }}
                          <p class="parsley-required">{{ $errors ->first('bar_code') }} </p>
                      </div>
                  </div>{{--bra_code--}}

          </div> {{--first row end--}}
          <div class="row no-margin-top">
              <div class="col s12 l2">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      <?php $purchPrice=Lang::get('main.purchPrice') ?>
                      {{ Form::text('buy',null,array('required','id'=>'buy')) }}
                      {{ Form::label('buy',$purchPrice) }}
                      <p class="parsley-required">{{ $errors ->first('buy') }} </p>
                  </div>
              </div> {{--buy--}}

                  <div class="col s12 l2">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      <?php $sellPrice=Lang::get('main.sellPrice') ?>
                      {{ Form::text('sell_users',null,array('required','id'=>'sell_users')) }}
                      {{ Form::label('sell_users',$sellPrice) }}
                      <p class="parsley-required">{{ $errors ->first('sell_users') }} </p>
                  </div>
              </div> {{--sell_users--}}
              <div class="col s12 l2">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      <?php $sell_nos_gomla=Lang::get('main.sell_nos_gomla') ?>
                      {{ Form::text('sell_nos_gomla',null,array('required','id'=>'sell_nos_gomla')) }}
                      {{ Form::label('sell_nos_gomla',$sell_nos_gomla) }}
                    <p class="parsley-required">{{ $errors ->first('sell_nos_gomla') }} </p>
                  </div>
              </div> {{--sell_nos_gomla--}}
              <div class="col s12 l2">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      <?php $sell_gomla=Lang::get('main.sell_gomla') ?>
                      {{ Form::text('sell_gomla',null,array('required','id'=>'sell_gomla')) }}
                      {{ Form::label('sell_gomla',$sell_gomla) }}
                    <p class="parsley-required">{{ $errors ->first('sell_gomla') }} </p>
                  </div>
              </div> {{--sell_gomla--}}
              <div class="col s12 l2">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      <?php $sell_gomla_gomla=Lang::get('main.sell_gomla_gomla') ?>
                      {{ Form::text('sell_gomla_gomla',null,array('required','id'=>'sell_gomla_gomla')) }}
                      {{ Form::label('sell_gomla_gomla',$sell_gomla_gomla) }}
                    <p class="parsley-required">{{ $errors ->first('sell_gomla_gomla') }} </p>
                  </div>
              </div> {{--sell_gomla_gomla--}}

          </div> {{--secound row end--}}
          <div class="row no-margin-top">

              <div class="col s12  l2">
                  <div class="input-field">
                      <i class="fa fa-cube prefix"></i>
                      <?php $unit=Lang::get('main.unit') ?>
                      {{ Form::text('unit',null,array('id'=>'unit')) }}
                      {{ Form::label('unit',$unit) }}
                    <p class="parsley-required">{{ $errors ->first('unit') }} </p>
                  </div>
              </div>{{--unit--}}
              <div class="col s12  l2">
                  <div class="input-field">
                      <i class="mdi mdi-alert-error prefix"></i>
                      <?php $sellLimit=Lang::get('main.sellLimit') ?>
                      {{ Form::text('limit',null,array('id'=>'limit')) }}
                      {{ Form::label('limit',$sellLimit) }}
                    <p class="parsley-required">{{ $errors ->first('limit') }} </p>
                  </div>
              </div>

              @if($co_info->co_supplier_must)
                  <div class="col s2 l3">
                      {{ Form::select('account',array(null=>lang::get('main.select_account'))+ $account_type,null,array('id'=>'account','ng-required'=>'pay_type == "on_account"','ng-model'=>'account.type','ng-change'=>'getAccountsByType()')) }}
                      <p class="parsley-required">{{ $errors ->first('account') }} </p>
                  </div>{{--account--}}
                  <div ng_show="account.type" class="col s2 l3">
                      <select  name="account_id" ng-required='pay_type == "on_account"' ng-change='getAccountInfo()' ng-model="account.id"  class='browser-default'>
                          <option value="@{{ account.id }}" ng-repeat="account in accounts">@{{ account.acc_name }}</option>
                      </select>
                  </div>{{--account--}}
              @endif
          </div>
          <div class="row no-margin-top">

              @if($co_info->co_use_season)
                  <div class="col s12 l3">
                      {{--<i class="fa fa-cube prefix"></i>--}}
                      <?php $category=Lang::get('main.category') ?>
                      {{--{{ Form::label('cat_id',$category) }}--}}

                      {{ Form::select('cat_id', array('' => 'اختر الفئة') + $co_info->cat->lists('name','id'),null,array('id'=>'cat_id')) }}

                      <p class="parsley-required">{{ $errors ->first('cat_id') }} </p>
                  </div> {{--category--}}
              <div class="col s2 l3">
                  <i class="wi wi-day-cloudy"></i>
                  <?php $season=Lang::get('main.season');
                  $choseSeason=Lang::get('main.choseSeason')?>
                  {{ Form::label('seasons_id',$season) }}
                  {{ Form::select('seasons_id', array('' => $choseSeason) + $co_info->seasons->lists('name','id'),null,array('id'=>'seasons_id')) }}
                <p class="parsley-required">{{ $errors ->first('seasons_id') }} </p>
              </div> {{--season--}}
              @endif
              @if($co_info->co_use_markes_models)

                  <div class="col s2 l3">
                      <i class="fa fa-tags prefix"></i>
                      <?php $mark =Lang::get('main.mark');
                      $chosemark =Lang::get('main.chosemark') ?>
                      {{ Form::label('mark_id',$mark) }}
                      {{ Form::select('marks_id', array('' => $chosemark )+$co_info->marks->lists('name','id'),null,array('id'=>'mark_select')) }}
                      <p class="parsley-required">{{ $errors ->first('models_id') }} </p>
                  </div> {{--marks--}}


                      <div class="col s2 l3" id="model_select_contenir" style="display: none">

                          <div class="select-wrapper" >
                              <i class="fa fa-tags prefix"></i>
                                 <label for="model"/> الموديل </label>

                                   <select  class="browser-default" id="model_select" name="models_id">


                                   </select>

                              <p class="parsley-required">{{ $errors ->first('models_id') }} </p>
                           </div>
                      </div> {{--models--}}




              @endif
          </div> {{--third row end--}}
          <div class="row no-margin-top">
              <div class="col s12 l10">
                  <div class="input-field">
                      <i class="mdi-communication-chat prefix"></i>
                      <textarea name="notes" id="notes" class="materialize-textarea" length="120"> {{ @$item->notes }}</textarea>
                      <?php $notes=Lang::get('main.notes') ?>
                      {{ Form::label('notes',$notes) }}
                    <p class="parsley-required">{{ $errors ->first('notes') }} </p>
                  </div>
              </div> {{--notes--}}
          </div> {{--fourth row end--}}
            <br>
          <div class="row">
              <div  style=" width:100px; text-align:center;margin:1% auto;" >
              @if(Route::currentRouteName() == 'addItem')
                  <button type="submit" class="waves-effect btn">@lang('main.add') </button>
              @elseif(Route::currentRouteName() == 'editItem')
                  <button type="submit" class="waves-effect btn">@lang('main.edit') </button>
              @endif
              </div>
              {{ Form::close() }}
          </div>{{--submit  row end--}}
      </div>
    </div>
                  <table id="table_bank" class="display table table-bordered table-striped table-hover">

                  @include('dashboard.products.items._table_view')
</div>
</div>


</section>
    {{--{{             dd(DB::getQueryLog()); }}--}}
@stop