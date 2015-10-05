<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 10/3/2015
 * Time: 3:07 PM
 */
?>
@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section  class="content-wrap ecommerce-dashboard">



    <div class=" card">
        <div class="btn-group" style="margin: 1%  1% 0 0;">
            <a href="{{ URL::route('searchAccounts','bank') }}" class="btn btn-extra black-text grey lighten-2">   البنك</a>
            <a href="{{ URL::route('searchAccounts','partners') }}" class="btn btn-extra black-text grey lighten-2">  جارى الشركاء </a>
            <a href="{{ URL::route('searchAccounts','suppliers') }}" class="btn btn-extra black-text grey lighten-2">  الموردين </a>
            <a href="{{ URL::route('searchAccounts','customers') }}" class="btn btn-extra black-text grey lighten-2 "> العملاء</a>
        </div>
        <hr/>
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i>  {{ $title }} </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">

            {{ Form::open(array('route'=>'resultAccounts','data-parsley-validate')) }}

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



            {{--account name--}}
                    <div class="col s12 l2">

                        {{ Form::select('account_id', array('' => $select_account) + $accounts->lists('acc_name','id'),null,array('id'=>'cat_id')) }}

                        <p class="parsley-required">{{ $errors ->first('account_id') }} </p>
                    </div>
             {{--account name--}}
         </div>

            <div class="row">
                <div class="col s10 l10" style="margin: 1%">

                        <button class="waves-effect btn"> @lang('main.review') </button>

                </div>
                {{ Form::hidden('type',$type) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>


    </div>


</section>
<!-- /Main Content -->


@stop