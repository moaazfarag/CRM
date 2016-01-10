<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 9/29/2015
 * Time: 5:42 PM
 */
    ?>



@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard" id="print-content" ng-app="itemApp"  ng-controller="mainController">
    {{ Form::open(array('route'=>array('reportSettleResult',$type))) }}
    <div class=" card  no-print">
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
                <div class="col s12 l3">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::text('date_from',null,array('data-parsley-id'=>'4370','class'=>($errors->first('date_from'))?'parsley-error pikaday':'pikaday','required','id'=>'employee_date','class'=>'pikaday')) }}
                        <p class="parsley-required">{{ $errors ->first('employee_date') }} </p>

                        <label for="employee_date">
                            بداية من
                        </label>
                    </div>
                </div>


                <div class="col s12 l3">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::text('date_to',null,array('data-parsley-id'=>'4370','class'=>($errors->first('date_to'))?'parsley-error pikaday':'pikaday','required','id'=>'employee_date','class'=>'pikaday')) }}
                        <p class="parsley-required">{{ $errors ->first('employee_date') }} </p>

                        <label for="employee_date">
                            حتى
                        </label>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col s12 l12" style="padding: 2%;">

                    <button type="submit" class="waves-effect btn">
                        عرض
                    </button>
                </div>


                {{ Form::hidden('invoice_type',$type) }}
                {{ Form::close() }}
            </div>{{--submit  row end--}}
        </div>



    </div>
    <br/>
    @if(Route::currentRouteName() == "reportSettleResult")
        @include('dashboard.settle.report.report_result');
    @endif
</section>
@stop

