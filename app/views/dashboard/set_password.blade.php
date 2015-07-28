@extends('dashboard.main')
@section('content')

    <!-- Breadcrumb -->



    <div class=" card">
    <div class="row">
        {{ Form::open(array('route'=>'storeNewPassword')) }}
        <div class="col m5 s12">
            <div class="input-field">
                <i class="fa fa-unlock-alt prefix"></i>
                {{ Form::password('password',array((Route::currentRouteName()== "addUser")?'required':'','id'=>'password')) }}
                <label for="password">@lang('main.password') </label>
                <ul class="parsley-errors-list filled" id="parsley-id-5202">
                    <li class="parsley-required">{{ $errors ->First('password') }} </li>
                </ul>
            </div>
        </div>
        <div class="col m5 s12">
            <div class="input-field">
                <i class="fa fa-unlock-alt prefix"></i>
                {{ Form::password('confirm_password',array((Route::currentRouteName()== "addUser")?'required':'','id'=>'confirm_password')) }}
                <label for="confirm_password">@lang('main.confirm_password') </label>
                <ul class="parsley-errors-list filled" id="parsley-id-5202">
                    <li class="parsley-required">{{ $errors ->First('confirm_password') }} </li>
                </ul>
            </div>
        </div>
        <div class="col m2 s12">
            <div class="input-field">
                <button class="waves-effect btn">@lang('main.submit') </button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

</section>

    @endsection