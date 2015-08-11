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

          <li  class="label">@lang('main.mainInfo') </li>
        <li class="{{@$asideOpen}}">
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i>  @lang('main.mainList')<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>

            <ul>
                <li>
                    <a href="{{ URL::route('editCompanyInfo') }}" class="waves-effect waves-blue">  @lang('main.companyInfo') </a>
                </li>
                <li>
                    <a href="{{ URL::route('addBranch') }}" class="waves-effect waves-blue"> @lang('main.branchInfo')  </a>
                </li>
                <li>
                    <a href="{{ URL::route('addCategory') }}" class="waves-effect waves-blue"> @lang('main.itemCat') </a>
                </li>
                <li>
                    <a href="{{ URL::route('addSeason') }}" class="waves-effect waves-blue"> @lang('main.seasons') </a>
                </li>
                <li>
                    <a href="{{ URL::route('addModel') }}" class="waves-effect waves-blue">  @lang('main.models') </a>
                </li>
                <li>
                    <a href="{{ URL::route('addItem') }}" class="waves-effect waves-blue"> @lang('main.items')</a>
                </li>
                <li>
                    <a  href="{{  URL::route('addAccount','customers') }}" class="waves-effect waves-blue"> @lang('main.accounts') </a>
                </li>
                <li>
                    <a href="{{  URL::route('addUser') }}" class="waves-effect waves-blue"> @lang('main.users')   </a>
                </li>
                <li>
                    <a href="{{  URL::route('set_Password') }}" class="waves-effect waves-blue">     @lang('main.change_password')  </a>
                </li>

            </ul>
        </li>
            </li>
            <li class="{{@$sideOpen}}">
                 <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i>  @lang('main.balances')  <span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                <ul>
                    <li>
                        <a href="{{ URL::route('addItemsBalances') }}" class="waves-effect waves-blue"> @lang('main.balanceItem') </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('addAccountsBalances') }}" class="waves-effect waves-blue"> @lang('main.balanceAccount')</a>
                    </li>
                </ul>
            </li>
            <li class="{{@$TransOpen}}">
                <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i>  @lang('main.stores')<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                <ul>
                    <li>
                        <a href="{{ URL::route('addTransHeader',array('addItems')) }}" class="waves-effect waves-blue">@lang('main.settleAdd')  </a>
                    </li>
                    <li>
                        <a href="{{ URL::route('addTransHeader',array('discountItems')) }}" class="waves-effect waves-blue">  @lang('main.settleDiscount')   </a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-blue">   @lang('main.itemCart') </a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-blue">  @lang('main.inventoryStore')   </a>
                    </li>
                    <li>
                        <a href="#" class="waves-effect waves-blue">@lang('main.balanceStores')  </a>
                    </li>

                </ul>
            </li>
            <li class="{{@$employees}}">
                <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i>  شؤون العاملين <span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                <ul>
                    <li>
                        <a href="{{ URL::route('addEmp') }}" class="waves-effect waves-blue"> اضف موظف  </a>

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


