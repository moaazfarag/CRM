<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 9/15/2015
 * Time: 12:33 PM
 */
?>
@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">



    <div class=" card">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i>  {{ $title }} </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">
            @if(Route::currentRouteName()== "addDirectMovement" )
                {{ Form::open(array('route'=>'storeDirectMovement','data-parsley-validate')) }}
            @elseif(Route::currentRouteName()== "editUser")
                {{ Form::model($user,array('route'=>array('updateUser',$user->id),'data-parsley-validate')) }}
            @endif
            <div class="row">

                {{--date--}}
                <div class="col m5 s12">
                    <div class="input-field">
                        <i class="fa fa-user prefix"></i>
                        {{ Form::text('movement_date',null,array('required','id'=>'movement_date','class'=>'pikaday')) }}
                        <label for="movement_date">@lang('main.date')</label>
                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                            <li class="parsley-required">{{ $errors ->First('movement_date') }} </li>
                        </ul>
                    </div>
                </div>
                {{--branch --}}
                @if($branch == 1)

                <div class="col s12 l4">

                    <?php $branch =Lang::get('main.branch');
                    $choseBranch =Lang::get('main.choseBranch') ?>
                    {{--{{ Form::label('br_id',$branch) }}--}}
                    {{ Form::select('br_id', array('' => $choseBranch )+$company->branches->lists('br_name','id'),null,array('id'=>'br_id')) }}
                    <p class="parsley-required">
                        {{ $errors ->first('br_id') }}
                    </p>
                </div>
                @endif



            <div class="row">

                {{--of_account--}}
                <div class="col m4 s12" >
                    <div class="input-field" style="padding-right: 4%;">
                        {{ Form::select('of_account', $of_account,null,array('id'=>'of_account')) }}
                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                            <li class="parsley-required">{{ $errors ->First('of_account') }} </li>
                        </ul>
                    </div>
                </div>

                {{--prise--}}
                <div class="col m3 s12">
                    <div class="input-field">
                        <i class="mdi mdi-editor-attach-money prefix active"></i>
                        {{ Form::number('prise',null,array('id'=>'prise','step'=>'0.01')) }}

                        <label for="prise"> @lang('main.prise')</label>
                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                            <li class="parsley-required">{{ $errors ->First('prise') }} </li>
                        </ul>
                    </div>
                </div>

                {{--credit & debit--}}
                <div class="col s12 l2">

                        <input name="prise_type" value="credit" type="radio" id="radios1-1"  />
                        <label for="radios1-1">قبض</label>
                        <input name="prise_type" value="debit" type="radio" id="radios1-2" />
                        <label for="radios1-2">صرف</label>


                </div>

            </div>


            <div class="row">

                {{--notes--}}
                <div class="col s12 l9">
                    <div class="input-field" >
                        <i class="fa fa-tag prefix"></i>
                        {{ Form::text('note',null,array('id'=>'note','class'=>"materialize-textarea" ,'length'=>"200")) }}
                        {{ Form::label('note',lang::get('main.note'))     }}
                        <p class="parsley-required">{{ $errors ->first('note') }} </p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col s10 l10" style="margin: 1%">
                    <button class="waves-effect btn"> @lang('main.save') </button>
                </div>
            </div>
        </div>
    </div>


</div>

    <!-- /Store Settings -->

    {{--@include('dashboard.users._view_table')--}}


</section>
<!-- /Main Content -->


@stop