<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 9/28/2015
 * Time: 1:29 PM
 */

?>
@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard" ng-app="itemApp"  ng-controller="mainController">
    {{ Form::open(array('route'=>array('reportResultItemCard'))) }}
    <div class=" card ">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i>
             {{--{{ $title }}--}}
            </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">
            <div class="row">
                <div class="col s12 l3">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::text('date_from',null,array('required','id'=>'date_from','class'=>'pikaday')) }}
                        <p class="parsley-required">{{ $errors ->first('date_from') }} </p>

                        <label for="date_from">
                            بداية من
                        </label>
                    </div>
                </div>


                <div class="col s12 l3">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::text('date_to',null,array('required','id'=>'date_to','class'=>'pikaday')) }}
                        <p class="parsley-required">{{ $errors ->first('date_to') }} </p>

                        <label for="date_to">
                            حتى
                        </label>
                    </div>
                </div>

                {{--branches start--}}
                @if($branch == 1)


                        <div class="col s6 l2">
                            {{ Form::select('br_id',array(null=>"اختر الفرع")+ $co_info->branches->lists('br_name','id'),null,array('id'=>'br_id')) }}
                            <p class="parsley-required">{{ $errors ->first('br_id') }} </p>
                        </div>
                @endif
                {{--branches end--}}

                {{--category--}}
                <div class="col s12 l2">

                    {{ Form::select('cat_id', array('' => 'اختر الفئة') + $co_info->cat->lists('name','id'),null,array('id'=>'cat_id')) }}

                    <p class="parsley-required">{{ $errors ->first('cat_id') }} </p>
                </div> {{--category--}}
                {{--end category --}}

                </div> <!-- end row -->

                <div class="row">




                    {{--item --}}

                    <div class="col s2 l3">

                        {{ Form::select('item_id',array(null=>"اختر الصنف")+$items ,null,array('id'=>'item_id')) }}
                        <p class="parsley-required">{{ $errors ->first('item_id') }} </p>
                    </div>
                    {{--end item--}}

            </div>

            <div class="row">
                <div class="col s12 l12" style="padding: 2%;">

                    <button type="submit" class="waves-effect btn">
                        عرض
                    </button>
                </div>


                {{ Form::hidden('sum',$sum) }}
                {{ Form::hidden('invoice_type',$type) }}
                {{ Form::close() }}
            </div>{{--submit  row end--}}
        </div>



    </div>
    @if(Route::currentRouteName() == "prepMsHeader")
        @include('dashboard.hr.msheader._table_view');
    @endif
</section>
@stop

