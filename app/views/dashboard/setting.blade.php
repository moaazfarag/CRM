 @extends('dashboard.main')
 @section('content')
     <!-- Breadcrumb -->
     <div class="ecommerce-title">

       <div class="row">
         <div class="col s12 m9 l10">
           <!--h1>@@title</h1-->
           <nav>
             <ul class="left">
               <li class="active"  >
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
     <!-- /Breadcrumb -->
 <!-- Store Settings  بيانات الشركة  -->
    <div class=" card minimized">
      <div class="title">
        <h5><i class="fa fa-cog"></i> بيانات الشركة</h5>
        <a class="minimize" href="#">
          <i class="mdi-navigation-expand-less"></i>
        </a>
      </div>
      <div class="content">

        <div class="row no-margin-top">
          <div class="col s12 l1">
            <label for="ecommerce-name">
              اسم الشركة
            </label>
          </div>
          <div class="col s4 m6 l5">
            <div class="input-field">
              <i class="mdi mdi-action-home prefix"></i>
              <input id="ecommerce-name" type="text" placeholder="اسم الشركة">
            </div>
          </div>


          <div class="col s2 l1">
            <label for="ecommerce-adress">
              العنوان
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
       رقم الهاتف
            </label>
          </div>
          <div class="col s4 l5">
            <div class="input-field">
              <i class="mdi mdi-communication-phone prefix"></i>
              <input id="ecommerce-tel" type="text" placeholder="رقم الهاتف ">
            </div>
          </div>

          <div class="col s2 l1">
            <label for="ecommerce-printsize">
              حجم الطباعة
            </label>
          </div>
          <div class="col s2 l5">
            <select id="ecommerce-printsize">
              <option selected value="0" disabled>اختر حجم الطباعة </option>
                <option value="big_size" > كبير </option>
                <option value="mid_size" >متوسط </option>
                <option value="small_size"> صغير</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col s2 l1">
            <label for="ecommerce-currency">
              العملة
            </label>
          </div>
          <div class="col s4 l5">
            <div class="input-field">
              <i class="mdi mdi-editor-attach-money prefix"></i>
              <input id="ecommerce-currency" type="text" placeholder="العملة">
            </div>
          </div>
        </div>
                <div class="row">
          <div class="col s2 l2">
            <label for=""">
اعدادات الموقع
            </label>
            </div>
        <p>
          <input name="use_serial_no" type="checkbox" id="use_serial_no" value="use_serial_no"  >
          <label for="use_serial_no">استخدام مسلسل للاصناف</label>
          <input name="enter_supplier" type="checkbox" id="enter_supplier" value="enter_supplier" >
          <label for="enter_supplier">ادخال المورد اجباري عند تعريف الصنف </label>
          <input name="use_season" type="checkbox" id="use_season" value="use_season">
          <label for="use_season">استخدام المواسم عند تعريف الصنف </label>
          <input name="use_trademark" type="checkbox" id="use_trademark" value="use_trademark">
          <label for="use_trademark">استخدام الماركات لشركات السيارات </label>
          <input name="use_model" type="checkbox" id="use_model" value="use_model">
          <label for="use_model">استخدام الموديلات لشركات السيارات</label>

        </p>
    </div>
      <div class="row">
        <div class="col s10 l10">

            <button class="waves-effect btn">تعديل </button>
        </div>
    </div>


      </div>

    </div>
    <!-- /Store Settings -->


    <!-- Owner Information بيانات المالك  -->
    <div class="card minimized">
      <div class="title">
        <h5><i class="mdi mdi-social-person"></i> معلومات المالك</h5>
        <a class="minimize" href="#">
          <i class="mdi-navigation-expand-less"></i>
        </a>
      </div>
      <div class="content">

        <div class="row no-margin-top">
          <div class="col s12 l2">
            <label for="ecommerce-account-fname">
              الاسم
            </label>
          </div>
          <div class="col s12 m6 l4">
            <div class="input-field">
              <i class="mdi mdi-social-person prefix"></i>
              <input id="ecommerce-account-fname" type="text" placeholder="برجاء ادخال الاسم">
            </div>
          </div>
          <div class="col s12 m6 l5">
            <div class="input-field">
              <i class="mdi mdi-social-person prefix"></i>
              <input id="ecommerce-account-lname" type="text" placeholder="برجاء ادخال لقب العائلة">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col s12 l2">
            <label for="ecommerce-account-email">
              البريد الاكتروني
            </label>
          </div>
          <div class="col s12 l4">
            <div class="input-field">
              <i class="mdi mdi-communication-email prefix"></i>
              <input id="ecommerce-account-email" type="text" placeholder="عنوان برديك الاكتروني ">
            </div>
          </div>

          <div class="col s12 l1">
            <label for="ecommerce-account-phone">
              رقم الهاتف
            </label>
          </div>
          <div class="col s12 l4">
            <div class="input-field">
              <i class="mdi mdi-communication-phone prefix"></i>
              <input id="ecommerce-account-phone" type="text" placeholder="رقم الهاتف">
            </div>
          </div>
        </div>
     <div class="row">
          <div class="col s12 l2">
            <label for="ecommerce-account-phone">
        رقم الموبيل
            </label>
          </div>
          <div class="col s12 l4">
            <div class="input-field">
              <i class="mdi mdi-communication-phone prefix"></i>
              <input id="ecommerce-account-phone" type="text" placeholder="رقم الموبيل ">
            </div>
                  <div class="row">
                    <div class="col s12 l12">


                        <button class="waves-effect btn">تعديل </button>
                    </div>
                </div>
          </div>

     </div>

      </div>
    </div>
    <!-- /Owner Information -->
 <!-- الفروع -->
        <div class="card minimized">
          <div class="title">
            <h5><i class="mdi mdi-notification-event-available"></i> الفروع</h5>
            <a class="minimize" href="#">
              <i class="mdi-navigation-expand-less"></i>
            </a>
          </div>
          <div class="content">
        <div class="row no-margin-top">
          <div class="col s12 l2">
            <label for="branch-name">
اسم الفرع
            </label>
          </div>
          <div class="col s12 m6 l6">
            <div class="input-field">
              <i class="mdi mdi-social-person prefix"></i>
              <input id="branch-name" type="text" placeholder="  اسم الفرع">
            </div>
          </div>

        </div>
                <div class="row no-margin-top">
                  <div class="col s12 l2">
                    <label for="branch-address">
عنوان الفرع
                    </label>
                  </div>
                  <div class="col s12 m6 l8">
                    <div class="input-field">
                      <i class="mdi mdi-social-person prefix"></i>
                      <input id="branch-address" type="text" placeholder="عنوان  الفرع">
                    </div>
                  </div>

                </div>

                  <div class="row">
                    <div class="col s12 l12">


                        <button class="waves-effect btn">اضف </button>
                    </div>
                </div>
        <!-- /عرض الفروع -->
@include('dashboard.branchview')
          </div>
        </div>
        <!-- /Store Policies -->

  </section>
  <!-- /Main Content -->

@include('include.search')
  @stop