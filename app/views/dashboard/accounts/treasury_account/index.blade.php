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
<section ng-app="itemApp"  ng-controller="mainController"  class="content-wrap ecommerce-dashboard">



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

            @elseif(Route::currentRouteName()== "editDirectMovement")
              <?php

                if($movement->debit !=0){
                    $debit = '1';
                     $price = $movement->debit;
                    }
                elseif($movement->credit !=0){
                    $credit = '1';
                    $price = $movement->credit;
                    }else{
                    $price = 0 ;
                }
                ?>
                {{ Form::model($movement,array('route'=>array('updateDirectMovement',$movement->id))) }}
            @endif
            <div class="row">

                {{--date--}}
                <div class="col m3 s12">
                    <div class="input-field">
                        <i class="fa fa-user prefix"></i>
                        {{ Form::text('date',null,array('required','id'=>'date','class'=>'pikaday')) }}
                        <label for="date">@lang('main.date')</label>
                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                            <li class="parsley-required">{{ $errors ->First('date') }} </li>
                        </ul>
                    </div>
                </div>
                {{--branch --}}
                @if($branch == 1)

                <div class="col s12 l4">
                    <?php $branch =Lang::get('main.branch');
                    $choseBranch =Lang::get('main.choseBranch') ?>
                    {{--{{ Form::label('br_id',$branch) }}--}}

                    {{--{{ Form::label('br_code',$branch) }}--}}

                    {{ Form::select('br_id', array('' => $choseBranch )+$company->branches->lists('br_name','id'),null,array('id'=>'br_id')) }}
                    <p class="parsley-required">
                        {{ $errors ->first('br_id') }}
                    </p>
                </div>
                @endif

            </div>

            <div class="row">



                {{--price--}}
                <div class="col m2 s12">
                    <div class="input-field">
                        <i class="mdi mdi-editor-attach-money prefix active"></i>
                        {{ Form::number('price',isset($price) ? $price:null,array('id'=>'price','step'=>'0.01')) }}

                        <label for="price"> @lang('main.price')</label>
                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                            <li class="parsley-required">{{ $errors ->First('price') }} </li>
                        </ul>
                    </div>
                </div>

                {{--credit & debit--}}
                <div class="col s12 l1">

                        <input name="price_type"  {{ isset($credit) ?'checked':'' }} value="credit" type="radio" id="radios1-1"  />
                        <label for="radios1-1">قبض</label>
                        <input name="price_type" value="debit" {{ isset($debit) ?'checked':'' }} type="radio" id="radios1-2" />
                        <label for="radios1-2">صرف</label>


                </div>



               {{--account  name--}}
                <div class="col s12 l2">

                    <i class="mdi mdi-communication-import-export"></i>
                    {{ Form::label('account',lang::get('main.account')) }}
                    {{ Form::select('account',array(null=>lang::get('main.select_account'))+ $account_type,null,array('id'=>'account','ng-required'=>'pay_type == "on_account"','ng-model'=>'account.type','ng-change'=>'getAccountsByType()')) }}
                    <p class="parsley-required">{{ $errors ->first('account') }} </p>
                </div>{{--account--}}
                <div ng_show="account.type" class="col s12 l2">

                    <i class="mdi mdi-communication-import-export"></i>
                    {{ Form::label('account',Lang::get('main.account')) }}
                    <select  name="account_id" ng-required='pay_type == "on_account"' ng-change='getAccountInfo()' ng-model="account.id"  class='browser-default'>
                        <option value="@{{ account.id }}" ng-repeat="account in accounts">@{{ account.acc_name }}</option>
                    </select>
              <span style="color: red">
                  @{{ isLimit() }}
              </span>
                    @{{  seletedAccount.pricing }}
                    {{--{{ Form::select('account',array(null=>"اختر   نوع الحساب ")+ $account_type,null,array('id'=>'account','ng-model'=>'account.type','ng-change'=>'getAccountsByType()','class'=>'browser-default')) }}--}}
                    <p class="parsley-required">{{ $errors ->first('account') }} </p>
                </div>{{--account--}}

                {{--end account name --}}

            </div>


                <div class="row">

                {{--notes--}}
                <div class="col s12 l9">
                    <div class="input-field" >
                        <i class="fa fa-tag prefix"></i>
                        {{ Form::text('notes',null,array('id'=>'note','class'=>"materialize-textarea" ,'length'=>"200")) }}
                        {{ Form::label('notes',lang::get('main.note'))     }}
                        <p class="parsley-required">{{ $errors ->first('note') }} </p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col s10 l10" style="margin: 1%">
                    @if(Route::currentRouteName()== "addDirectMovement" )

                    <button class="waves-effect btn"> @lang('main.save') </button>
                    @elseif(Route::currentRouteName()== "editDirectMovement")
                   <button class="waves-effect btn"> @lang('main.edit') </button>
                    @endif
                </div>
            </div>
        </div>
    </div>


</div>

    <!-- /Store Settings -->
    <table id="table_bank" class="display table table-bordered table-striped table-hover">

    @include('dashboard.accounts.treasury_account._table_view')
</table>

</section>
<!-- /Main Content -->


@stop