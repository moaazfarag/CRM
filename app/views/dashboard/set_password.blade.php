@extends('dashboard.main')
@section('content')

    <!-- Breadcrumb -->
    <div class="ecommerce-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <!--h1>@@title</h1-->
                <nav>
                <ul class="left">
                <li class="{{ @$active }}"  >
                <a href="/admin/hr">شئون العاملين </a>
                </li>
                <li>
                <a href="/admin/accounts">الحسابات </a>
                </li>
                <li>
                <a href="/admin/product">الاصناف </a>
                </li>
                <li>
                <a href="/admin/setting">بيانات الموقع</a>
                </li>
                <li>
                <a href="/admin">الرئيسية</a>
                </li>
                </ul>
                </nav>

            </div>

        </div>

    </div>


    <div class=" card">
    <div class="row">
        {{ Form::open(array('route'=>'storeNewPassword')) }}
        <div class="col m5 s12">
            <div class="input-field">
                <i class="fa fa-unlock-alt prefix"></i>
                {{ Form::password('password',array((Route::currentRouteName()== "addUser")?'required':'','id'=>'password')) }}
                <label for="password">كلمة المرور</label>
                <ul class="parsley-errors-list filled" id="parsley-id-5202">
                    <li class="parsley-required">{{ $errors ->First('password') }} </li>
                </ul>
            </div>
        </div>
        <div class="col m5 s12">
            <div class="input-field">
                <i class="fa fa-unlock-alt prefix"></i>
                {{ Form::password('confirm_password',array((Route::currentRouteName()== "addUser")?'required':'','id'=>'confirm_password')) }}
                <label for="confirm_password">تاكيد كلمة المرور</label>
                <ul class="parsley-errors-list filled" id="parsley-id-5202">
                    <li class="parsley-required">{{ $errors ->First('confirm_password') }} </li>
                </ul>
            </div>
        </div>
        <div class="col m2 s12">
            <div class="input-field">
                <button class="waves-effect btn">{{ "حفظ ' }} </button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>



    @endsection