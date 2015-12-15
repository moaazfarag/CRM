@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard" ng-app="itemApp" ng-controller="mainController">
    {{ Form::open(array('route'=>array('barcode'))) }}
    <div class=" card ">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i>
                {{ $title }}
            </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">
            <div class="row">
                {{--items--}}
                <div class="col s12 l2">
                    {{ Form::select('item_id', array('' => 'كل الاصناف') + $co_info->itemsHasLabel->lists('item_name','id'),null,array('id'=>'item_id','ng-model'=>'item_id')) }}
                    <p class="parsley-required">{{ $errors ->first('item_id') }} </p>
                </div> {{--items--}}
                {{--category--}}
                <div ng-hide='item_id' class="col s12 l2">

                    {{ Form::select('cat_id', array('' => 'كل الفئات') + $co_info->cat->lists('name','id'),null,array('id'=>'cat_id')) }}

                    <p class="parsley-required">{{ $errors ->first('cat_id') }} </p>
                </div>
                {{--end category --}}
                {{--season--}}
                <div  ng-hide='item_id' class="col s12 l2">
                    {{ Form::select('seasons_id', array('' => 'كل  المواسم') + $co_info->seasons->lists('name','id'),null,array('id'=>'seasons_id')) }}
                    <p class="parsley-required">{{ $errors ->first('seasons_id') }} </p>
                </div> {{--end season --}}
            </div> <!-- end row -->


            <div class="row">
                <div class="col s12 l12" style="padding: 2%;">

                    <button type="submit" class="waves-effect btn">
                        عرض
                    </button>
                </div>
                {{--{{ Form::hidden('type',$type) }}--}}
                {{ Form::close() }}
            </div>{{--submit  row end--}}
        </div>
    </div>

    @if(Route::currentRouteName() == "prepMsHeader")
        @include('dashboard.hr.msheader._table_view');
    @endif
</section>
@stop