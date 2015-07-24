@extends('dashboard.main')
@section('content')

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
          <div class="row no-margin-top">
              <div class="col s12 l6">
                  <div class="input-field">
                      <i class="fa fa-tag prefix"></i>
                      {{ Form::text('item_name',null,array('required','id'=>'item_name')) }}
                      {{ Form::label('item_name','اسم الصنف') }}
                      <p class="parsley-required">{{ $errors ->first('item_name') }} </p>
                  </div>
             </div>  {{--name--}}
              <div class="col s12 l4">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      {{ Form::text('buy',null,array('required','id'=>'buy')) }}
                      {{ Form::label('buy','سعر  الشراء ') }}
                      <p class="parsley-required">{{ $errors ->first('buy') }} </p>
                  </div>
              </div> {{--buy--}}
          </div> {{--first row end--}}
          <div class="row no-margin-top">
              <div class="col s12 l4">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      {{ Form::text('sell_users',null,array('required','id'=>'sell_users')) }}
                      {{ Form::label('sell_users','سعر  البيع ') }}
                      <p class="parsley-required">{{ $errors ->first('sell_users') }} </p>
                  </div>
              </div> {{--sell_users--}}
              <div class="col s12 l2">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      {{ Form::text('sell_nos_gomla',null,array('required','id'=>'sell_nos_gomla')) }}
                      {{ Form::label('sell_nos_gomla','سعر نص الجملة') }}
                    <p class="parsley-required">{{ $errors ->first('sell_nos_gomla') }} </p>
                  </div>
              </div> {{--sell_nos_gomla--}}
              <div class="col s12 l2">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      {{ Form::text('sell_gomla',null,array('required','id'=>'sell_gomla')) }}
                      {{ Form::label('sell_gomla','سعر  الجملة') }}
                    <p class="parsley-required">{{ $errors ->first('sell_gomla') }} </p>
                  </div>
              </div> {{--sell_gomla--}}
              <div class="col s12 l2">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      {{ Form::text('sell_gomla_gomla',null,array('required','id'=>'sell_gomla_gomla')) }}
                      {{ Form::label('sell_gomla_gomla','سعر جملة الجملة') }}
                    <p class="parsley-required">{{ $errors ->first('sell_gomla_gomla') }} </p>
                  </div>
              </div> {{--sell_gomla_gomla--}}

          </div> {{--secound row end--}}
          <div class="row no-margin-top">
              @if($co_info->co_use_serial)
              <div class="col s12 m6 l4">
                  <div class="input-field">
                      <i class="fa fa-barcode prefix"></i>
                      {{ Form::text('bar_code',null,array('id'=>'bar_code')) }}
                      {{ Form::label('bar_code','الباركود') }}
                    <p class="parsley-required">{{ $errors ->first('bar_code') }} </p>
                  </div>
              </div>{{--bra_code--}}
              @endif
              <div class="col s12 m6 l2">
                  <div class="input-field">
                      <i class="fa fa-cube prefix"></i>
                      {{ Form::text('unit',null,array('id'=>'unit')) }}
                      {{ Form::label('unit','الوحدة') }}
                    <p class="parsley-required">{{ $errors ->first('unit') }} </p>
                  </div>
              </div>{{--unit--}}
              <div class="col s12 m6 l2">
                  <div class="input-field">
                      <i class="mdi mdi-alert-error prefix"></i>
                      {{ Form::text('limit',null,array('id'=>'limit')) }}
                      {{ Form::label('limit','حد البيع') }}
                    <p class="parsley-required">{{ $errors ->first('limit') }} </p>
                  </div>
              </div>
          </div>
          <div class="row no-margin-top">
              <div class="col s2 l3">
                  <i class="fa fa-cube prefix"></i>
                  {{ Form::label('cat_id','الفئة') }}
                  {{ Form::select('cat_id', array('' => 'اختر الفئة') + $co_info->cat->lists('name','id'),null,array('id'=>'cat_id')) }}
                <p class="parsley-required">{{ $errors ->first('cat_id') }} </p>
              </div> {{--category--}}
              @if($co_info->co_supplier_must)
              <div class="col s2 l3">
                  <i class="fa fa-truck"></i>
                  {{ Form::label('supplier_id','المورد') }}
                  {{ Form::select('supplier_id', array('' => 'اختر المورد')+ $accounts,null,array('id'=>'supplier_id')) }}
                <p class="parsley-required">{{ $errors ->first('supplier_id') }} </p>
              </div> {{--supplier--}}
              @endif
              @if($co_info->co_use_season)
              <div class="col s2 l3">
                  <i class="wi wi-day-cloudy"></i>
                  {{ Form::label('seasons_id','الموسم') }}
                  {{ Form::select('seasons_id', array('' => 'اختر الموسم ') + $co_info->seasons->lists('name','id'),null,array('id'=>'seasons_id')) }}
                <p class="parsley-required">{{ $errors ->first('seasons_id') }} </p>
              </div> {{--season--}}
              @endif
              @if($co_info->co_use_markes_models)
              <div class="col s2 l3">
                  <i class="fa fa-tags prefix"></i>
                  {{ Form::label('models_id','الموديل') }}
                  {{ Form::select('models_id', array('' => 'اختر الموديل')+$co_info->models->lists('name','id'),null,array('id'=>'models_id')) }}
                  <p class="parsley-required">{{ $errors ->first('models_id') }} </p>
              </div> {{--models--}}
              @endif
          </div> {{--third row end--}}
          <div class="row no-margin-top">
              <div class="col s6 l6">
                  <div class="input-field">
                      <i class="mdi-communication-chat prefix"></i>
                      <textarea name="notes" id="notes" class="materialize-textarea" length="120"> {{ @$item->notes }}</textarea>
                      {{ Form::label('notes','ملاحظات') }}
                    <p class="parsley-required">{{ $errors ->first('notes') }} </p>
                  </div>
              </div> {{--notes--}}
          </div> {{--fourth row end--}}
            <br>
          <div class="row">
              <div class="col s12 l12">
              @if(Route::currentRouteName() == 'addItem')
                  <button type="submit" class="waves-effect btn">اضف </button>
              @elseif(Route::currentRouteName() == 'editItem')
                  <button type="submit" class="waves-effect btn">تعديل </button>
              @endif
              </div>
              {{ Form::close() }}
          </div>{{--submit  row end--}}
      </div>
    </div>
                  <table id="table_bank" class="display table table-bordered table-striped table-hover">

                  @include('dashboard.item_table_view')
</div>
</div>
      @include('include.search')

</section>
@stop