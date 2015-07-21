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

          <li  class="label">البيانات الاساسية</li>
          <li class="open">
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i> القائمة الرئيسية<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                </li>
            <ul>
                <li>
                    <a href="{{ URL::route('editCompanyInfo') }}" class="waves-effect waves-blue"> بيانات الشركة </a>
                </li>
                <li>
                    <a href="{{ URL::route('addItem') }}" class="waves-effect waves-blue">اصناف الشركة</a>
                </li>
                <li class="">
                    <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-indent"></i>  الحسابات<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                    <ul>

                        <li>
                            <a href="{{ URL::route('addAccount',array('customers')) }}" class="waves-effect waves-blue">اضف عميل </a>
                        </li>
                        <li>
                            <a href="{{ URL::route('addAccount',array('suppliers')) }}" class="waves-effect waves-blue">اضف مورد </a>
                        </li>
                        <li>
                            <a href="{{ URL::route('addAccount',array('bank')) }}" class="waves-effect waves-blue">اضف بنك </a>
                        </li>
                        <li>
                            <a href="{{ URL::route('addAccount',array('expenses')) }}" class="waves-effect waves-blue">اضف نفاقات </a>
                        </li>
                        <li>
                            <a href="{{ URL::route('addAccount',array('multiple_revenue')) }}" class="waves-effect waves-blue">اضف بنك </a>
                        </li>


                    </ul>
                </li>

            <li>
                <a href="{{  URL::route('addUser') }}" class="waves-effect waves-blue">شئون العاملين </a>
              </li>
            </ul>
            </ul>
          </li>



      </div>
    </div>
  </aside>
  <!-- /Yay Sidebar -->


  <!-- Main Content -->
  <section class="content-wrap ecommerce-dashboard">


