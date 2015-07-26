  <!--
  Yay Sidebar
  Options [you can use all of theme classnames]:
    .yay-hide-to-small         - no hide menu, just set it small with big icons
    .yay-static                - stop using fixed sidebar (will scroll with content)
    .yay-gestures              - to show and hide menu using gesture swipes
    .yay-light                 - light color scheme
    .yay-hide-on-content-click - hide menu on content click

  Effects [you can use one of these classnames]:
    .yay-overlay  - overlay content
    .yay-push     - push content to right
    .yay-shrink   - shrink content width
-->
  <aside class="yaybar yay-shrink yay-hide-to-small yay-gestures">

    <div class="top">
      <div>
        <!-- Sidebar toggle -->
        <a href="#" class="yay-toggle">
          <div class="burg1"></div>
          <div class="burg2"></div>
          <div class="burg3"></div>
        </a>
        <!-- Sidebar toggle -->

        <!-- Logo -->
        <a href="#!" class="brand-logo">
        {{ URL::asset('dashboard/assets/_con/images/logo-white.png') }}" alt="Con">
        </a>
        <!-- /Logo -->
      </div>
    </div>


    <div class="nano has-scrollbar">
      <div class="nano-content">

        <ul>

          {{--<li  class="label">البيانات الاساسية</li>--}}


            <li class="">
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i> القائمة الرئيسية<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>

            <ul>
                <li>
                    <a href="{{ URL::route('editCompanyInfo') }}" class="waves-effect waves-blue"> بيانات الشركة </a>
                </li>
                <li>
                    <a href="{{ URL::route('addBranch') }}" class="waves-effect waves-blue"> بيانات الفروع </a>
                </li>
                <li>
                    <a href="{{ URL::route('addCategory') }}" class="waves-effect waves-blue"> فئات الاصناف</a>
                </li>
                <li>
                    <a href="{{ URL::route('addSeason') }}" class="waves-effect waves-blue"> المواسم</a>
                </li>
                <li>
                    <a href="{{ URL::route('addModel') }}" class="waves-effect waves-blue"> الماركات والموديلات</a>
                </li>
                <li>
                    <a href="{{ URL::route('addItem') }}" class="waves-effect waves-blue">الاصناف</a>
                </li>
          <li>
                    <a  href="{{  URL::route('addAccount','customers') }}" class="waves-effect waves-blue">أكواد الحسابات</a>
                </li>
                <li>
                    <a href="{{  URL::route('addUser') }}" class="waves-effect waves-blue">المستخدمين   </a>

            </ul>
          </li>
            </li>
            <li>
                 <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i> الارصده الافتتاحيه <span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                <ul>
                    <li>
                        <a href="{{ URL::route('addItemsBalances') }}" class="waves-effect waves-blue">ارصده الاصناف</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('addAccountsBalances') }}" class="waves-effect waves-blue">ارصده الحسابات </a>
                    </li>
                </ul>
            </li>

            <li class="">
                <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-indent"></i>  المخازن<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                <ul>
                    <li>
                        <a href="{{ URL::route('addTransHeader',array('add')) }}" class="waves-effect waves-blue">تسوية اضافة </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('addTransHeader') }}" class="waves-effect waves-blue"> تسوية خصم </a>
                    </li>

                </ul>
            </li>
          </ul>



      </div>
    </div>
  </aside>
  <!-- /Yay Sidebar -->


  <!-- Main Content -->
  <section class="content-wrap ecommerce-dashboard">


