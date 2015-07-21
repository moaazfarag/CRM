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
    <div class=" card minimized">
      <div class="title">
                <h5>
                    <i class="fa fa-cog"></i> اضف موظف </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
              <div class="content">

                  <div class="row no-margin-top">
                      <div class="col s12 l1">
                          <label for="ecommerce-name">
                              الاسم            </label>
                      </div>
                      <div class="col s4 m6 l5">
                          <div class="input-field">
                              <i class="mdi mdi-action-home prefix"></i>
                              <input id="ecommerce-name" type="text" placeholder="اسم الموظف">
                          </div>
                      </div>


                      <div class="col s2 l1">
                          <label for="ecommerce-adress">
                              تاريخ التعين
                          </label>
                      </div>
                      <div class="col s4 l5">
                          <div class="input-field">
                              <i class="mdi mdi-action-language prefix"></i>
                              <input id="ecommerce-adress" type="text" placeholder="العنوان">
                          </div>
                      </div>
                  </div>

                  <div class="row no-margin-top">
                      <div class="col s2 l1">
                          <label for="ecommerce-tel">
                              الرقم القومي
                          </label>
                      </div>
                      <div class="col s4 l5">
                          <div class="input-field">
                              <i class="mdi mdi-communication-phone prefix"></i>
                              <input id="ecommerce-tel" type="text" placeholder="الرقم القومي ">
                          </div>
                      </div>

                      <div class="col s2 l1">
                          <label for="ecommerce-printsize">
                              الفرع
                          </label>
                      </div>
                      <div class="col s2 l5">
                          <select id="ecommerce-printsize">
                              <option selected value="0" disabled>اختر اسم الفرع </option>
                              <option value="big_size" > النزهة </option>
                              <option value="mid_size" >الجيزة </option>
                              <option value="small_size"> الدقي</option>
                          </select>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col s2 l1">
                          <label for="ecommerce-currency">
                              المرتب
                          </label>
                      </div>
                      <div class="col s4 l5">
                          <div class="input-field">
                              <i class="mdi mdi-editor-attach-money prefix"></i>
                              <input id="ecommerce-currency" type="text" placeholder="المرتب">
                          </div>
                      </div>          <div class="col s2 l1">
                          <label for="ecommerce-currency">
                              المؤهل
                          </label>
                      </div>
                      <div class="col s4 l5">
                          <div class="input-field">
                              <i class="mdi mdi-editor-attach-money prefix"></i>
                              <input id="ecommerce-currency" type="text" placeholder="المؤهل">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col s2 l1">
                          <label for="ecommerce-currency">
                              الوظيفة
                          </label>
                      </div>
                      <div class="col s4 l5">
                          <div class="input-field">
                              <i class="mdi mdi-editor-attach-money prefix"></i>
              <input id="ecommerce-currency" type="text" placeholder="الوظيفة">
            </div>
          </div>          <div class="col s2 l1">
            <label for="ecommerce-currency">
ارقام الهاتف
            </label>
          </div>
          <div class="col s4 l5">
            <div class="input-field">
              <i class="mdi mdi-editor-attach-money prefix"></i>
              <input id="ecommerce-currency" type="text" placeholder="ارقام الهاتف">
            </div>
          </div>
        </div>
                        <div class="row">

                  <div class="col s2 l1">
                    <label for="ecommerce-printsize">
القسم
                    </label>
                  </div>
                  <div class="col s2 l5">
                    <select id="ecommerce-printsize">
                      <option selected value="0" disabled>اختر القسم  </option>
                        <option value="big_size" > المبيعات </option>
                        <option value="mid_size" >الحسابات </option>
                    </select>
                  </div>
                  </div>
                <div class="row">
          <div class="col s2 l2">
            <label for="">
اعدادات  المستخدم
            </label>
            </div>
        <p>
          <input name="use_serial_no" type="checkbox" id="use_serial_no" value="use_serial_no"  >
          <label for="use_serial_no">مستخدم  للنظام</label>
          <input name="enter_supplier" type="checkbox" id="enter_supplier" value="enter_supplier" >
          <label for="enter_supplier">كل الفروع</label>
          <input name="enter_supplier2" type="checkbox" id="enter_supplier2" value="enter_supplier2" >
          <label for="enter_supplier2">يستحق عمولة</label>
          <div class="col s4 l5">
              <div class="input-field">
                <i class="mdi mdi-editor-attach-money prefix"></i>
                <input id="enter_supplier2" type="text" placeholder="نسبة العمولة ">
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

            <button class="waves-effect btn">اضف </button>
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