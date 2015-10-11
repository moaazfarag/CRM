<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/5/2015
 * Time: 5:56 PM
 */

?>

@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard" ng-app="itemApp"  ng-controller="mainController">
    <div class="row" style="margin: 1% 0;">
        <div class="col l12 s12" >



        </div>
    </div>
    {{ Form::open(array('route'=>array('dailyTreasuryResult'))) }}
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
                <div class="col s12 l3">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::text('date_from',null,array('required','id'=>'employee_date','class'=>'pikaday')) }}
                        <p class="parsley-required">{{ $errors ->first('employee_date') }} </p>

                        <label for="employee_date">
                            بداية من
                        </label>
                    </div>
                </div>


                <div class="col s12 l3">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::text('date_to',null,array('required','id'=>'employee_date','class'=>'pikaday')) }}
                        <p class="parsley-required">{{ $errors ->first('employee_date') }} </p>

                        <label for="employee_date">
                            حتى
                        </label>
                    </div>
                </div>
                {{--branch --}}
                @if($branch == 1)

                    <div class="col s12 l3">
                        <?php $branch = Lang::get('main.branch');
                        $choseBranch  = Lang::get('main.choseBranch') ?>
                        {{--{{ Form::label('br_id',$branch) }}--}}

                        {{--{{ Form::label('br_code',$branch) }}--}}

                        {{ Form::select('br_id', array('' => $choseBranch )+$company->branches->lists('br_name','id'),null,array('id'=>'br_id','ng-model'=>'br_id')) }}
                        <p class="parsley-required">
                            {{ $errors ->first('br_id') }}
                        </p>
                    </div>
                @endif

            </div>

            <div class="row">
                <div class="col s12 l12" style="padding: 2%;">

                    <button type="submit" class="waves-effect btn">
                        عرض
                    </button>
                </div>



                {{ Form::close() }}
            </div>{{--submit  row end--}}
        </div>



    </div>

</section>
@stop

