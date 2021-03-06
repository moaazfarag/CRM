@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section ng-app="itemApp" ng-controller="mainController" class="content-wrap ecommerce-dashboard">
    <!--  addUser addUser  اضف مستخدم للنظام      -->
    @if(PerC::isShow('main_info','users','show_edit_add'))
        <div class=" card minimizex">
            <div class="title">
                <h5>
                    <i class="fa fa-cog"></i> المستخدمين الحاليين </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
            <div class="content">
                @include('include.messages')
                <div class="row">
                    @if(count($suspended))
                    <div class="col s12 m9 l10">
                        <div class="ecommerce-title">
                        <nav  style="height: 66px !important;line-height: 69px !important;">
                            <ul class="left">

                                <li id="suspended_li"><a onClick="hide('existing'); show('suspended');$('#suspended_li').addClass('active');$('#existing_li').removeClass('active');"  href="#" > الموقوفين</a>
                                </li>

                                <li id="existing_li" class="active"><a onClick="hide('suspended'); show('existing'); $('#existing_li').addClass('active');$('#suspended_li').removeClass('active')" href="#" > الحاليين</a>
                                </li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                    @endif
                    <div class="col s12 m9 l10" id="existing">
                        @include('dashboard.users._view_table')
                    </div>
                    @if(count($suspended))
                       <div class="col s12 m9 l10" id="suspended" style="display: none;">
                            @include('dashboard.users._view_suspended_table')
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <br>
    @endif
        @if(PerC::isShow('main_info','users','add','addUser') || PerC::isShow('main_info','users','edit','editUser'))

    <div class=" card">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i>
                @if(Route::currentRouteName()== "editUser")
                    @if($user->owner != 'acount_creator')
                    {{ $title }}
                    @else
                        تعديل البيانات الشخصية
                    @endif
                @elseif(Route::currentRouteName()== "addUser" )
                    إضافة مستخدم جديد
                @endif
            </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">

            <h5 style=" color:#000000; font-weight: 500; width: 100%; padding: 1%; border-radius: 2%;" >   بيانات المستخدم</h5>
            <hr/>
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
                        {{ Form::text('username',null,array('required','id'=>'username','data-parsley-id'=>'4370','class'=>($errors->first('username'))?'parsley-error':null)) }}
                        @elseif(Route::currentRouteName()== "editUser")
                            {{ Form::text('username',null,array('required','id'=>'username','readonly')) }}
                        @endif
                        <label for="username">@lang('main.admin_user_name')</label>
                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                            <li class="parsley-required">{{ $errors ->First('username') }} </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(Route::currentRouteName()== "editUser" && $user->owner == 'acount_creator' )
                <div class="col m5 s12">
                    <div class="input-field">
                        <i class="fa fa-envelope prefix"></i>
                        {{ Form::email('email',null,array('id'=>'email','data-parsley-id'=>'4370','class'=>($errors->first('email'))?'parsley-error':null)) }}
                        <label for="email"> @lang('main.email')</label>
                        <ul class="parsley-errors-list filled" id="parsley-id-5202">
                            <li class="parsley-required">{{ $errors ->First('email') }} </li>
                        </ul>
                    </div>
                </div>
                @endif
                @if(Route::currentRouteName()== "editUser" && $user->owner != 'acount_creator' ||Route::currentRouteName()== "addUser" )
                <div class="col s12 l4">
                    <?php $branch        = Lang::get('main.branch');
                          $choseBranch   = Lang::get('main.choseBranch') ?>
                    {{--{{ Form::label('br_id',$branch) }}--}}
                    {{ Form::select('br_id', array('all' => 'كل الفروع' )+$company->branches->lists('br_name','id'),null,array('id'=>'br_id')) }}
                    <p class="parsley-required">
                        {{ $errors ->first('br_id') }}
                    </p>
                </div>
                @endif
                @if(Route::currentRouteName()== "editUser" && $user->owner != 'acount_creator')
                <div class="col s12 l4">
                   <p>
                   <?php //$allParts = Lang::get('main.allParts')
                       ?>
                   {{ Form::checkbox('reset_password',1,null,array('id'=>'reset_password')) }}
                   {{ Form::label('reset_password','تغيير كلمة المرور إلى (12345678)') }}
                   <p class="parsley-required">
                       {{ $errors ->first('all_br') }}
                   </p>
                   <input name="use_serial_no" type="checkbox" id="use_serial_no" value="use_serial_no"  >
                   </p>
               </div>
               @endif
           </div>
           @if(Route::currentRouteName()== "editUser")
                   @if($user->owner != 'acount_creator')
                   <div class="row">
                       @include('dashboard.users._premisions')
                   </div>
                   @endif
           @else
                       @include('dashboard.users._premisions')
           @endif
           <div class="row">
               <div class="col s10 l10" style="margin: 5px 20px 5px 5px;">
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