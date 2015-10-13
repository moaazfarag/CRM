<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/12/2015
 * Time: 12:23 PM
 */

?>

@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard" ng-app="itemApp"  ng-controller="mainController">
    {{ Form::open(array('route'=>array('resultTheBalanceOfTheStores'))) }}
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


                {{--branches start--}}
                @if($branch == 1)

                    <div class="col s6 l2">
                        {{ Form::select('br_id',array(null=>"كل المخازن")+ $co_info->branches->lists('br_name','id'),null,array('id'=>'br_id')) }}
                        <p class="parsley-required">{{ $errors ->first('br_id') }} </p>
                    </div>

                @endif
                {{--branches end--}}

                {{--category--}}
                <div class="col s12 l2">

                    {{ Form::select('cat_id', array('' => 'كل الفئات') + $co_info->cat->lists('name','id'),null,array('id'=>'cat_id')) }}

                    <p class="parsley-required">{{ $errors ->first('cat_id') }} </p>
                </div> {{--category--}}
                {{--end category --}}

                {{--with_zero_results--}}
                <div class="col s12 l3">

                    <p>
                        <input name="with_zero_results" type="checkbox" id="checkbox1" />
                        <label for="checkbox1">عرض الأرصدة التى تساوى 0 </label>
                    </p>

                    <p class="parsley-required">{{ $errors ->first('cat_id') }} </p>
                </div> {{--with_zero_results--}}
                {{--end category --}}

            </div> <!-- end row -->



            <div class="row">
                <div class="col s12 l12" style="padding: 2%;">

                    <button type="submit" class="waves-effect btn">
                        عرض
                    </button>
                </div>


                {{ Form::hidden('type',$type) }}
                {{ Form::close() }}
            </div>{{--submit  row end--}}
        </div>



    </div>
    @if(Route::currentRouteName() == "prepMsHeader")
        @include('dashboard.hr.msheader._table_view');
    @endif
</section>
@stop