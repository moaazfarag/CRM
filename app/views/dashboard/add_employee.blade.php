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
                   <a href="/admin/setting"> @lang('main.jobs')</a>
                   </li>
                    <li>
                   <a href="/admin">@lang('main.parts')</a>
                   </li>
                   <li>
                   <a href="/admin/hr">@lang('main.addEmployee')</a>
                   </li>
                     <li class="active"  >
                   <a href="/admin/hr"> @lang('main.addSysUser') </a>
                   </li>
                 </ul>
               </nav>

             </div>

           </div>

         </div>
                  <br>
     <!-- /Breadcrumb -->
 <!--  addUser addUser  اضف مستخدم للنظام      -->
    <div class=" card minimized">
      <div class="title">
                <h5>
                    <i class="fa fa-cog"></i> @lang('main.addEmployee')  </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
              <div class="content">

                  <div class="row no-margin-top">
                      <div class="col s12 l1">
                          <label for="ecommerce-name">
                              @lang('main.name')
                          </label>
                      </div>
                      <div class="col s4 m6 l5">
                          <div class="input-field">
                              <i class="mdi mdi-action-home prefix"></i>

                              <input id="ecommerce-name" type="text" placeholder= @lang('main.empName') >
                          </div>
                      </div>


                      <div class="col s2 l1">
                          <label for="ecommerce-adress">
                              @lang('main.joinDate')
                          </label>
                      </div>
                      <div class="col s4 l5">
                          <div class="input-field">
                              <i class="mdi mdi-action-language prefix"></i>
                              <input id="ecommerce-adress" type="text" placeholder=@lang('main.address') >
                          </div>
                      </div>
                  </div>

                  <div class="row no-margin-top">
                      <div class="col s2 l1">
                          <label for="ecommerce-tel">
                              @lang('main.tel')
                          </label>
                      </div>
                      <div class="col s4 l5">
                          <div class="input-field">
                              <i class="mdi mdi-communication-phone prefix"></i>
                              <input id="ecommerce-tel" type="text" placeholder=@lang('main.tel')>
                          </div>
                      </div>

                      <div class="col s2 l1">
                          <label for="ecommerce-printsize">
                              @lang('main.branch')
                          </label>
                      </div>
                      <div class="col s2 l5">
                          <select id="ecommerce-printsize">
                              <option selected value="0" disabled> @lang('main.choseBraNum')</option>
                              <option value="big_size" >  @lang('main.nozha') </option>
                              <option value="mid_size" > @lang('main.dokki') </option>
                              <option value="small_size">  @lang('main.giza')</option>
                          </select>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col s2 l1">
                          <label for="ecommerce-currency">
                              @lang('main.salary')
                          </label>
                      </div>
                      <div class="col s4 l5">
                          <div class="input-field">
                              <i class="mdi mdi-editor-attach-money prefix"></i>
                              <input id="ecommerce-currency" type="text" placeholder= @lang('main.salary')>
                          </div>
                      </div>          <div class="col s2 l1">
                          <label for="ecommerce-currency">
                              @lang('main.qualification')
                          </label>
                      </div>
                      <div class="col s4 l5">
                          <div class="input-field">
                              <i class="mdi mdi-editor-attach-money prefix"></i>
                              <input id="ecommerce-currency" type="text" placeholder= @lang('main.qualification') >
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col s2 l1">
                          <label for="ecommerce-currency">
                              @lang('main.job')
                          </label>
                      </div>
                      <div class="col s4 l5">
                          <div class="input-field">
                              <i class="mdi mdi-editor-attach-money prefix"></i>
              <input id="ecommerce-currency" type="text" placeholder= @lang('main.job') >
            </div>
          </div>          <div class="col s2 l1">
            <label for="ecommerce-currency">
                @lang('main.phoneNum')
            </label>
          </div>
          <div class="col s4 l5">
            <div class="input-field">
              <i class="mdi mdi-editor-attach-money prefix"></i>
              <input id="ecommerce-currency" type="text" placeholder=@lang('main.phoneNum') >
            </div>
          </div>
        </div>
                        <div class="row">

                  <div class="col s2 l1">
                    <label for="ecommerce-printsize">
                        @lang('main.part')
                    </label>
                  </div>
                  <div class="col s2 l5">
                    <select id="ecommerce-printsize">
                      <option selected value="0" disabled> @lang('main.chosePart')</option>
                        <option value="big_size" > @lang('main.sales') </option>
                        <option value="mid_size" >@lang('main.counting') </option>
                    </select>
                  </div>
                  </div>
                <div class="row">
          <div class="col s2 l2">
            <label for="">
                @lang('main.userSetting')
            </label>
            </div>
        <p>
          <input name="use_serial_no" type="checkbox" id="use_serial_no" value="use_serial_no"  >
          <label for="use_serial_no">@lang('main.usedSys')  </label>
          <input name="enter_supplier" type="checkbox" id="enter_supplier" value="enter_supplier" >
          <label for="enter_supplier">@lang('main.allParts') </label>
          <input name="enter_supplier2" type="checkbox" id="enter_supplier2" value="enter_supplier2" >
          <label for="enter_supplier2">@lang('main.commission') </label>
          <div class="col s4 l5">
              <div class="input-field">
                <i class="mdi mdi-editor-attach-money prefix"></i>
                <input id="enter_supplier2" type="text" placeholder= @lang('main.commRate')>
              </div>
          </div>

        </p>
    </div>
             <div class="row">
           <div class="col  l12">
       <div class="card-panel">


            @include('dashboard.premisions')
       </div>
            </div>
            </div>
            </div>
      <div class="row">
        <div class="col s10 l10">

            <button class="waves-effect btn">@lang('main.add') </button>
        </div>
    </div>


      </div>

    </div>
    <!-- /Store Settings -->

@include('dashboard.hr_view_table')


  </section>
  <!-- /Main Content -->

@include('include.search')
  @stop