@extends('dashboard.main')
@section('content')

      <div id="bank" class="col s12">
            @if(Route::currentRouteName() == 'addTransHeader')
{{--        {{ Form::open(array('route'=>array('storeTopic',$topic_type),'files'=>'true','data-parsley-validate')) }}--}}
        {{ Form::open(array('route'=>array('storeTransHeader',$type))) }}
            @elseif(Route::currentRouteName() == 'editItemsBalances')
              {{ Form::model($item,array('route'=>array('updateItemsBalances',$item->id))) }}
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

             <div class="col s2 l3">
                  <i class="wi wi-day-cloudy"></i>
                 <?php $item=Lang::get('main.item') ?>
                  {{ Form::label('item_id',$item) }}
                {{ Form::select('item_id', $co_info->items->lists('item_name','id'),null,array('id'=>'item_id')) }}
               <p class="parsley-required">{{ $errors ->first('item_id') }} </p>
              </div> {{--item--}}

              <div class="col s2 l3">
                  <i class="wi wi-day-cloudy"></i>
                  <?php $account=Lang::get('main.account') ?>
                  {{ Form::label('accounts',$account) }}
                {{ Form::select('accounts', $co_info->accounts->lists('acc_name','id'),null,array('id'=>'accounts')) }}
               <p class="parsley-required">{{ $errors ->first('accounts') }} </p>
              </div> {{--accounts--}}

              <div class="col s12 l4">
                <div class="input-field">
                    <i class="mdi mdi-editor-attach-money prefix"></i>
                    <?php $name=Lang::get('main.name') ?>
                    {{ Form::text('cost',null,array('required','id'=>'cost')) }}
                    {{ Form::label('cost',$name) }}
                    <p class="parsley-required">{{ $errors ->first('cost') }} </p>
                </div>
            </div> {{--buy--}}

            {{--<div class="col s12 m6 l2">--}}
                {{--<div class="input-field">--}}
                    {{--<i class="fa fa-cube prefix"></i>--}}
                    {{--{{ Form::text('qty',null,array('id'=>'qty')) }}--}}
                    {{--{{ Form::label('qty','الكمية') }}--}}
                  {{--<p class="parsley-required">{{ $errors ->first('qty') }} </p>--}}
                {{--</div>--}}
            {{--</div>--}}{{--unit--}}



          </div> {{--first row end--}}

      <div class="row no-margin-top">

             <div class="col s12 m6 l4">
                  <div class="input-field">
                     <i class="fa fa-barcode prefix"></i>
                      <?php $discount=Lang::get('main.discount') ?>
                      {{ Form::text('discount',null,array('id'=>'discount')) }}
                    {{ Form::label('discount',$discount) }}
                    <p class="parsley-required">{{ $errors ->first('discount') }} </p>
                </div>
              </div>{{--discount--}}

             <div class="col s12 m6 l4">
                  <div class="input-field">
                     <i class="fa fa-barcode prefix"></i>
                      <?php $tax=Lang::get('main.tax') ?>
                      {{ Form::text('tax',null,array('id'=>'tax')) }}
                    {{ Form::label('tax',$tax) }}
                    <p class="parsley-required">{{ $errors ->first('tax') }} </p>
                </div>
              </div>{{--tax--}}



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
              @if(Route::currentRouteName() == 'addTransHeader')
                  <button type="submit" class="waves-effect btn">@lang('main.add')</button>
              @elseif(Route::currentRouteName() == 'editItemsBalances')
                  <button type="submit" class="waves-effect btn">@lang('main.edit') </button>
              @endif
              </div>
              {{ Form::close() }}
          </div>{{--submit  row end--}}
      </div>
    </div>
                  <table id="table_bank" class="display table table-bordered table-striped table-hover">

                  @include('dashboard.items_balances_table_view')
</div>
</div>
      @include('include.search')

</section>
@stop