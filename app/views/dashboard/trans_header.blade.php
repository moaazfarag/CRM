@extends('dashboard.main')
@section('content')
    {{ HTML::script('dashboard/assets/angular.min.js') }}
    {{ HTML::script('dashboard/scripts/app.js') }}
    {{ HTML::script('dashboard/scripts/itemService.js') }}
    {{ HTML::script('dashboard/scripts/mainCtrl.js') }}
    {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>--}}
    {{--<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script> <!-- load angular -->--}}
      <div id="bank" class="col s12">
            {{--@if(Route::currentRouteName() == 'addTransHeader')--}}
                      {{--{{ Form::open(array('route'=>array('storeTopic',$topic_type),'files'=>'true','data-parsley-validate')) }}--}}
              {{ Form::open(array('route'=>array('transJson'))) }}
          {{--@elseif(Route::currentRouteName() == 'editItemsBalances')--}}
              {{--{{ Form::model($item,array('route'=>array('updateItemsBalances',$item->id))) }}--}}
          {{--@endif--}}
<div ng-app="itemApp"  ng-controller="mainController" class="card">
          <div class="title">
                <h5><i class="mdi mdi-notification-event-available"></i> {{ @$title }}  </h5>
                <a class="minimize" href="#">
                  <i class="mdi-navigation-expand-less"></i>
                </a>
          </div>
      <div class="content">
          <div class="row no-margin-top">
             <div class="col s2 l3">
                 @if($branch == 1)
                      <i class="wi wi-day-cloudy"></i>
                      {{ Form::label('branch_id','الفرع') }}
                     {{ Form::select('branch_id', $co_info->branches->lists('br_name','id'),null,array('id'=>'branch_id')) }}
                        <p class="parsley-required">{{ $errors ->first('branch_id') }} </p>
                 @else
                        <br>

                    <b> فرع :{{ $branch }}</b>
                 @endif
             </div>{{--branch--}}

             <div class="col s2 l3">

                 {{ Form::text('data',null,array('required','class'=>'pikaday','id'=>'data')) }}
                 {{ Form::label('data','التاريخ') }}
                 <p class="parsley-required">{{ $errors ->first('data') }} </p>
              </div> {{--data--}}
          </div>
          <div class="row no-margin-top">
             <div class="col s2 l1">
                 {{ Form::label('item_id','الصنف') }}
             </div>


             <div class="col s2 l3">
                  <i class="wi wi-day-cloudy"></i>

                {{ Form::text('name',null,array('autofocus','ng-model'=>"search",'id'=>'item_id')) }}

                 <p class="parsley-required">{{ $errors ->first('item_id') }} </p>
              </div> {{--item--}}
    @{{ items | filter:search }}
              <div class="col s12 l2">
                <div class="input-field">
                    <i class="mdi mdi-editor-attach-money prefix"></i>
                    {{ Form::number('quantity',null,array('ng-model'=>"item.quantity",'required','id'=>'quantity')) }}
                    {{ Form::label('quantity','الكمية') }}
                    <p class="parsley-required">{{ $errors ->first('quantity') }} </p>
                </div>
            </div> {{--quantity--}}


              <div class="col s12 l2">
                <div class="input-field">
                    <i class="mdi mdi-editor-attach-money prefix"></i>

                    {{ Form::number('cost',null,array('ng-enter'=>"addItem()", 'ng-model'=>"item.cost",'required','id'=>'cost')) }}
                    {{ Form::label('cost','القيمة') }}

                    <p class="parsley-required">{{ $errors ->first('cost') }} </p>
                </div>
            </div>
              <div class="col s12 l2">
                <div class="input-field">
                    <i class="mdi mdi-editor-attach-money prefix"></i>
                  <label for="item_id">
                      <a ng-click="addItem()" class="waves-effect btn">اضف </a>
                  </label>
                </div>
            </div>


          </div> {{--first row end--}}
          @include('dashboard.selected_items')


          <pre>

     @{{ item }}
    @{{ invoiceItems }}
    @{{ invoice_sub_total() }}
</pre>





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

                  <button  type="submit" class="waves-effect btn">@lang('main.add')</button>

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