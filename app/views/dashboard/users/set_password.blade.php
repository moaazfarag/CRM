@extends('dashboard.main')
@section('content')


    <!-- Breadcrumb -->

<section class="content-wrap ecommerce-dashboard">

    <div class=" card" style="padding: 1%;">

        <div  class="card-panel blue lighten-5 center_title">
        تغيير كلمة المرور 
        </div>
        @include('include.messages')
        <div class="row">

        {{ Form::open(array('route'=>'storeNewPassword')) }}

        <div class="col s12 m3">
            <div class="input-field">
                <i class="mdi mdi-action-lock-outline prefix"></i>
                {{ Form::password('old_password',array((Route::currentRouteName()== "addUser")?'required':'','id'=>'old_password','data-parsley-id'=>'4370','class'=>($errors->first('old_password'))?'parsley-error':null)) }}
                <label for="old_password">@lang('main.old_password') </label>
                <ul class="parsley-errors-list filled" id="parsley-id-5202">
                    <li class="parsley-required">{{ $errors ->First('old_password') }} </li>
                </ul>
            </div>
        </div>
        <div class="col s12 m3">
            <div class="input-field">
                <i class="mdi mdi-action-lock prefix"></i>
                {{ Form::password('new_password',array((Route::currentRouteName()== "addUser")?'required':'','id'=>'new_password','data-parsley-id'=>'4370','class'=>($errors->first('new_password'))?'parsley-error':null)) }}
                <label for="new_password">@lang('main.new_password') </label>
                <ul class="parsley-errors-list filled" id="parsley-id-5202">
                    <li class="parsley-required">{{ $errors ->First('new_password') }} </li>
                </ul>
            </div>
        </div>
        <div class="col m3 s12">
            <div class="input-field">
                <i class="mdi mdi-action-lock prefix"></i>
                {{ Form::password('confirm_new_password',array((Route::currentRouteName()== "addUser")?'required':'','id'=>'confirm_new_password','data-parsley-id'=>'4370','class'=>($errors->first('confirm_new_password'))?'parsley-error':null)) }}
                <label for="confirm_new_password">@lang('main.confirm_new_password') </label>
                <ul class="parsley-errors-list filled" id="parsley-id-5202">
                    <li class="parsley-required">{{ $errors ->First('confirm_new_password') }} </li>
                </ul>
            </div>
        </div>
        </div>
            <div class="row" style="margin: 1%;">
                <div class="col m12 s12">
                    <div class="input-field">
                        <button class="waves-effect btn">@lang('main.submit') </button>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>


    </div>



</section>

    @endsection