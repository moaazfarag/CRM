@extends('dashboard.main')
@section('content')

      <div id="bank" class="col s12">

<div ng-app="accountApp" ng-controller="accountController" class="card">
{{--        {{ Form::open(array('route'=>array('test'),'ng-submit'=>"submitItem()",'name'=>'form')) }}--}}
    <form ng-submit='submitItem()' name='form'>

          <div class="title">
                <h5><i class="mdi mdi-notification-event-available"></i> {{ @$title }}  </h5>
                <a class="minimize" href="#">
                  <i class="mdi-navigation-expand-less"></i>
                </a>
          </div>
      <div class="content">
          <div class="row no-margin-top">

              <div class="col s2 l3">
                  <i class="wi wi-day-cloudy"></i>
                  {{ Form::label('account_type','الحسابات') }}

                  {{--<select ng-show="accountType" class="select2"  id="account_id" name="account_id">--}}
                          {{--<option ng-repeat="account.DESC group by account.acc_type for account in accounts" value="account.id">--}}
                              {{--@{{  account.acc_name }}--}}
                          {{--</option>--}}
                  {{--</select>--}}

                  <select id="account_id"   name="account_id" class="select2" ng-model="account"
                                  ng-options="account.acc_name group by account.acc_type for account in accounts track by account.id">
                  </select>
                  {{--{{ Form::select('item_id', $co_info->seasons->lists('name','id'),null,array('id'=>'item_id')) }}--}}
                <p class="parsley-required">{{ $errors ->first('account_id') }} </p>
              </div>  {{-- account div --}}



              {{--name--}}
              <div class="col s12 l4">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      {{ Form::number('debit',null,array('ng-pattern'=>"/^[0-9]+$/",'id'=>'debit','ng-model'=>'account.debit','ng-disabled'=>'account.credit')) }}
                      <?php $debit=Lang::get('main.debit') ?>
                      {{ Form::label('debit',$debit) }}
                      <div class="error-div-for-table" ng-show="form.$submitted || form.debit.$touched">
                          <div ng-show="form.debit.$error.pattern">
                              برجاء ادخال رقم صحيح
                          </div>
                      </div>
                      <p class="parsley-required">{{ $errors ->first('debit') }} </p>
                  </div>
              </div> {{--debit--}}

              <div class="col s12 l4">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      {{ Form::number('credit',null,array('ng-pattern'=>"/^[0-9]+$/",'id'=>'credit','ng-model'=>'account.credit','ng-disabled'=>'account.debit')) }}
                      <?php $Credit=Lang::get('main.Credit') ?>
                      {{ Form::label('credit',$Credit) }}
                      <div class="error-div-for-table" ng-show="form.$submitted || form.credit.$touched">
                          <div ng-show="form.credit.$error.pattern">
                              برجاء ادخال رقم صحيح
                          </div>
                      </div>
                      <p class="parsley-required">{{ $errors ->first('credit') }} </p>
                  </div>
              </div> {{--credit--}}

              <div class="col s6 l6">
                  <div class="input-field">
                      <i class="mdi-communication-chat prefix"></i>
                      <textarea  ng-model='account.note' name="notes" id="notes" class="materialize-textarea" length="120"> {{ @$item->notes }}</textarea>
                      <?php $notes=Lang::get('main.notes') ?>
                      {{ Form::label('notes',$notes) }}
                    <p class="parsley-required">{{ $errors ->first('notes') }} </p>
                  </div>
              </div> {{--notes--}}
              <div class="col s12 l2">
                  <button ng-disabled="form.credit.$invalid ||form.debit.$invalid || hasBalance()"
                          type="button"
                          ng-click="addAccount()"
                          class="waves-effect btn">@lang('main.add') </button>
              </div>
          </div> {{--first row end--}}
@{{  form.credit.$viewValue  }}
          {{--<div class="row no-margin-top">--}}

              {{--@if($co_info->co_use_serial)--}}
              {{--<div class="col s12 m6 l4">--}}
                  {{--<div class="input-field">--}}
                      {{--<i class="fa fa-barcode prefix"></i>--}}
                      {{--{{ Form::text('bar_code',null,array('id'=>'bar_code')) }}--}}
                      {{--{{ Form::label('bar_code','الباركود') }}--}}
                    {{--<p class="parsley-required">{{ $errors ->first('bar_code') }} </p>--}}
                  {{--</div>--}}
              {{--</div>--}}{{--bar_code--}}
              {{--@endif--}}
              {{--<div class="col s12 m6 l4">--}}
                  {{--<div class="input-field">--}}
                      {{--<i class="fa fa-barcode prefix"></i>--}}
                      {{--{{ Form::text('serial_no',null,array('id'=>'serial_no')) }}--}}
                      {{--{{ Form::label('serial_no','السيريال') }}--}}
                    {{--<p class="parsley-required">{{ $errors ->first('serial_no') }} </p>--}}
                  {{--</div>--}}
              {{--</div>--}}{{--bar_code--}}
            {{--<div class="col s12 m6 l2">--}}
                {{--<div class="input-field">--}}
                    {{--<i class="fa fa-cube prefix"></i>--}}
                    {{--{{ Form::text('qty',null,array('id'=>'qty')) }}--}}
                    {{--{{ Form::label('qty','الكمية') }}--}}
                  {{--<p class="parsley-required">{{ $errors ->first('qty') }} </p>--}}
                {{--</div>--}}
            {{--</div>--}}{{--unit--}}
          {{--</div> --}}{{--secound row end--}}
            <br>
      </div>
    @include('dashboard.accounts_balances_table_view')
        <br>
        <br>
        <div class="row">
            <div class="col s12 l2">
                <button type="submit" ng-disabled="form.$invalid || hasBalances()"

                        class="waves-effect btn">
                    @lang('main.add')
                </button>
            </div>
        </div>
    {{ Form::close() }}
</div>


</div>
</div>
      @include('include.search')

</section>
@stop