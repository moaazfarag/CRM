@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section ng-app="itemApp" ng-controller="mainController" class="content-wrap ecommerce-dashboard">
    <!--  addUser addUser  اضف مستخدم للنظام      -->
    @if(PerC::isShow('main_info','users','show_edit_add'))
        <div class=" card minimized">
            <div class="title">
                <h5>
                    <i class="fa fa-cog"></i> المستخدمين الحاليين </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
            <div class="content">
                @include('dashboard.users._view_table')
            </div>
        </div>
        <br>
    @endif
        @if(PerC::isShow('main_info','users','add','addUser') || PerC::isShow('main_info','users','edit','editUser'))

    <div class=" card">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i> {{ $title }} </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">

            @if(Route::currentRouteName()== "addUser" )
                {{ Form::open(array('route'=>'storeUser','data-parsley-validate')) }}
            @elseif(Route::currentRouteName()== "editUser")
                {{ Form::model($user,array('route'=>array('updateUser',$user->id),'data-parsley-validate')) }}
            @endif
            <div class="row">
                <div class="col m5 s12">
                    <div class="input-field">
                        <i class="fa fa-user prefix"></i>
                        {{ Form::text('name',null,array('required','id'=>'name')) }}
                        <label for="name">@lang('main.name')</label>
                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                            <li class="parsley-required">{{ $errors ->First('name') }} </li>
                        </ul>
                    </div>
                </div>
                <div class="col m5 s12">
                    <div class="input-field">
                        <i class="fa fa-user prefix"></i>
                        @if(Route::currentRouteName()== "addUser" )
                        {{ Form::text('username',null,array('required','id'=>'username')) }}
                        @elseif(Route::currentRouteName()== "editUser")
                            {{ Form::text('username',null,array('required','id'=>'username','readonly')) }}
                        @endif
                        <label for="username">@lang('main.username')</label>
                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                            <li class="parsley-required">{{ $errors ->First('username') }} </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col m5 s12">
                    <div class="input-field">
                        <i class="fa fa-envelope prefix"></i>
                        {{ Form::email('email',null,array('id'=>'email')) }}
                        <label for="email"> @lang('main.email')</label>
                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                            <li class="parsley-required">{{ $errors ->First('email') }} </li>
                        </ul>
                    </div>
                </div>
                <div class="col s12 l4">
                    <?php $branch = Lang::get('main.branch');
                    $choseBranch = Lang::get('main.choseBranch') ?>
                    {{--{{ Form::label('br_id',$branch) }}--}}
                    {{ Form::select('br_id', array('' => $choseBranch )+$company->branches->lists('br_name','id'),null,array('id'=>'br_id')) }}
                    <p class="parsley-required">
                        {{ $errors ->first('br_id') }}
                    </p>
                </div>
                <div class="col s12 l2">
                    <p>
                    <?php $allParts = Lang::get('main.allParts') ?>
                    {{ Form::checkbox('all_br',1,null,array('id'=>'all_br')) }}
                    {{ Form::label('all_br',$allParts) }}
                    <p class="parsley-required">
                        {{ $errors ->first('all_br') }}
                    </p>
                    {{--<input name="use_serial_no" type="checkbox" id="use_serial_no" value="use_serial_no"  >--}}
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col m5 s12">
                    <div class="input-field">
                        <i class="mdi mdi-action-lock prefix active"></i>
                        {{ Form::password('password',array((Route::currentRouteName()== "addUser")?'required':'','id'=>'password')) }}
                        <label for="password">@lang('main.password')</label>
                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                            <li class="parsley-required">{{ $errors ->First('password') }} </li>
                        </ul>
                    </div>
                </div>
                <div class="col m5 s12">
                    <div class="input-field">
                        <i class="mdi mdi-action-lock prefix active"></i>
                        {{ Form::password('confirm_password',array((Route::currentRouteName()== "addUser")?'required':'','id'=>'confirm_password')) }}
                        <label for="confirm_password"> @lang('main.confirm_password') </label>
                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                            <li class="parsley-required">{{ $errors ->First('confirm_password') }} </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                @include('dashboard.users._premisions')
            </div>

            <div class="row">
                <div class="col s10 l10">
                    <button class="waves-effect btn">{{ $button }} </button>
                </div>
            </div>


        </div>
    </div>

    <!--    /Store Settings -->
            @endif

</section>
<!-- /Main Content -->


@stop