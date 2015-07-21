 @extends('dashboard.main')
 @section('content')
     <!-- Breadcrumb -->
     <div class="ecommerce-title">

       <div class="row">
         <div class="col s12 m9 l10">
           <!--h1>@@title</h1-->
           {{--<nav>--}}
             {{--<ul class="left">--}}
            {{--<li class="{{ @$active }}"  >--}}
            {{--<a href="/admin/hr">شئون العاملين </a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="/admin/accounts">الحسابات </a>--}}
            {{--</li>--}}
               {{--<li>--}}
               {{--<a href="/admin/product">الاصناف </a>--}}
               {{--</li>--}}
               {{--<li>--}}
               {{--<a href="/admin/setting">بيانات الموقع</a>--}}
               {{--</li>--}}
                {{--<li>--}}
               {{--<a href="/admin">الرئيسية</a>--}}
               {{--</li>--}}
             {{--</ul>--}}
           {{--</nav>--}}

         </div>

       </div>

         </div>

             <div class="title">

           <div class="row">
             <div class="col s12 m9 l10">
               <!--h1>@@title</h1-->
               <nav>
                 <ul class="left">


                   <li>
                   <a href="/admin/setting"> الوظائف</a>
                   </li>
                    <li>
                   <a href="/admin">الاقسام</a>
                   </li>
                   <li>
                   <a href="/admin/hr">اضف موظف  </a>
                   </li>
                     <li class="active"  >
                   <a href="/admin/hr">اضف مستخدم للنظام  </a>
                   </li>
                 </ul>
               </nav>

             </div>

           </div>

         </div>
                  <br>
     <!-- /Breadcrumb -->
 <!--  addUser addUser  اضف مستخدم للنظام      -->
    <div class=" card">
      <div class="title">
                <h5>
                    <i class="fa fa-cog"></i>  {{ $title }} </h5>
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
                      <div class="col m6 s6">
                          <div class="input-field">
                              <i class="fa fa-user prefix"></i>
                              {{ Form::text('name',null,array('required','id'=>'name')) }}
                              <label for="name">الاسم</label>
                              <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                  <li class="parsley-required">{{ $errors ->First('name') }} </li>
                              </ul>
                          </div>
                      </div>
                      <div class="col m6 s6">
                          <div class="input-field">
                              <i class="fa fa-user prefix"></i>
                              {{ Form::text('username',null,array('required','id'=>'username')) }}
                              <label for="username">اسم المستخدم </label>
                              <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                  <li class="parsley-required">{{ $errors ->First('username') }} </li>
                              </ul>
                          </div>
                      </div>
                  </div>

                  <div class="input-field">
                      <i class="fa fa-envelope prefix"></i>
                      {{ Form::email('email',null,array('id'=>'email')) }}
                      <label for="email">البريد الاكتروني</label>
                      <ul class="parsley-errors-list filled" id="parsley-id-5202">
                          <li class="parsley-required">{{ $errors ->First('email') }} </li>
                      </ul>
                  </div>

                  <div class="row">
                      <div class="col m6 s12">
                          <div class="input-field">
                              <i class="fa fa-unlock-alt prefix"></i>
                              {{ Form::password('password',array((Route::currentRouteName()== "addUser")?'required':'','id'=>'password')) }}
                              <label for="password">كلمة المرور</label>
                              <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                  <li class="parsley-required">{{ $errors ->First('password') }} </li>
                              </ul>
                          </div>
                      </div>
                      <div class="col m6 s12">
                          <div class="input-field">
                              <i class="fa fa-unlock-alt prefix"></i>
                              {{ Form::password('confirm_password',array((Route::currentRouteName()== "addUser")?'required':'','id'=>'confirm_password')) }}
                              <label for="confirm_password">تاكيد كلمة المرور</label>
                              <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                  <li class="parsley-required">{{ $errors ->First('confirm_password') }} </li>
                              </ul>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col s2 l6">
                          {{ Form::label('br_code','الفرع') }}
                          {{ Form::select('br_code', array('' => 'اختر الفرع')+$company->branches->lists('br_name','id'),null,array('id'=>'br_code')) }}
                          <p class="parsley-required">
                              {{ $errors ->first('br_code') }}
                          </p>
                      </div>
                      <div class="col s2 l6">
                          <p>
                              {{ Form::checkbox('all_br',1,null,array('id'=>'all_br')) }}
                              {{ Form::label('all_br','كل الفروع') }}
                              <p class="parsley-required">
                                  {{ $errors ->first('all_br') }}
                              </p>
                              {{--<input name="use_serial_no" type="checkbox" id="use_serial_no" value="use_serial_no"  >--}}
                          </p>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col s10 l10">
                          <button class="waves-effect btn">{{ $button }} </button>
                      </div>
                  </div>
              </div>
            </div>



      </div>

    </div>
    <!-- /Store Settings -->

@include('dashboard.users_view_table')


  </section>
  <!-- /Main Content -->

@include('include.search')
  @stop