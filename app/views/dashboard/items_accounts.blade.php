@extends('dashboard.main')
@section('content')

      <div id="bank" class="col s12">
            @if(Route::currentRouteName() == 'addItemsBalances')
        {{ Form::open(array('route'=>array('storeItemsBalances'))) }}
            @elseif(Route::currentRouteName() == 'editItem')
              {{ Form::model($item,array('route'=>array('updateItem',$item->id))) }}
              @endif
<div class="card">
          {{--<div class="title">--}}
            {{--<h5><i class="mdi mdi-notification-event-available"></i> {{ @$title }}  </h5>--}}
            {{--<a class="minimize" href="#">--}}
              {{--<i class="mdi-navigation-expand-less"></i>--}}
            {{--</a>--}}
          {{--</div>--}}
      <div class="content">
          <div class="row no-margin-top">

              <div class="col s2 l3">
                  <i class="wi wi-day-cloudy"></i>
                  {{ Form::label('item_id','الصنف') }}
                  {{ Form::select('item_id', $co_info->seasons->lists('name','id'),null,array('id'=>'item_id')) }}
                <p class="parsley-required">{{ $errors ->first('item_id') }} </p>
              </div> {{--item--}}


                {{--name--}}
              <div class="col s12 l4">
                  <div class="input-field">
                      <i class="mdi mdi-editor-attach-money prefix"></i>
                      {{ Form::text('cost',null,array('required','id'=>'cost')) }}
                      {{ Form::label('cost','التكلفة') }}
                      <p class="parsley-required">{{ $errors ->first('cost') }} </p>
                  </div>
              </div> {{--buy--}}

          </div> {{--first row end--}}

          <div class="row no-margin-top">

              @if($co_info->co_use_serial)
              <div class="col s12 m6 l4">
                  <div class="input-field">
                      <i class="fa fa-barcode prefix"></i>
                      {{ Form::text('bar_code',null,array('id'=>'bar_code')) }}
                      {{ Form::label('bar_code','الباركود') }}
                    <p class="parsley-required">{{ $errors ->first('bar_code') }} </p>
                  </div>
              </div>{{--bar_code--}}
              @endif
              <div class="col s12 m6 l4">
                  <div class="input-field">
                      <i class="fa fa-barcode prefix"></i>
                      {{ Form::text('serial_no',null,array('id'=>'serial_no')) }}
                      {{ Form::label('serial_no','السيريال') }}
                    <p class="parsley-required">{{ $errors ->first('serial_no') }} </p>
                  </div>
              </div>{{--bar_code--}}
            <div class="col s12 m6 l2">
                <div class="input-field">
                    <i class="fa fa-cube prefix"></i>
                    {{ Form::text('qty',null,array('id'=>'qty')) }}
                    {{ Form::label('qty','الكمية') }}
                  <p class="parsley-required">{{ $errors ->first('qty') }} </p>
                </div>
            </div>{{--unit--}}
          </div> {{--secound row end--}}
            <br>
          <div class="row">
              <div class="col s12 l12">
              @if(Route::currentRouteName() == 'addItemsBalances')
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

{{--                  @include('dashboard.item_table_view')--}}
</div>
</div>
      @include('include.search')

</section>
@stop