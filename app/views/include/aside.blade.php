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


    <div class="nano">
      <div class="nano-content">

        <ul>
          <li>
            <a href="angularjs/" class="waves-effect waves-blue"><i class="ion ion-social-angular"></i> Open Angular Version <span class="badge new"></span></a>
          </li>
          <li class="label">Menu</li>
          <li>
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i> Dashboards<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
            <ul>
              <li>
                <a href="dashboard.html" class="waves-effect waves-blue"> Dashboard</a>
              </li>
              <li>
                <a href="dashboard-v1.html" class="waves-effect waves-blue"> Dashboard v1</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="widgets.html" class="waves-effect waves-blue"><i class="fa fa-magic"></i> Widgets</a>
          </li>

          <li>
            <a href="layouts.html" class="waves-effect waves-blue"><i class="mdi mdi-av-web"></i> Layouts</a>
          </li>

          <li>
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-indent"></i> Menu Levels<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
            <ul>
              <li>
                <a class="yay-sub-toggle waves-effect waves-blue" href="#!">Second Level<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                <ul>
                  <li>
                    <a class="yay-sub-toggle waves-effect waves-blue" href="#!">Third Level<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                    <ul>
                      <li><a href="#!" class="waves-effect waves-blue">Fourth Level</a>
                      </li>
                      <li><a href="#!" class="waves-effect waves-blue">Fourth Level</a>
                      </li>
                      <li><a href="#!" class="waves-effect waves-blue">Fourth Level</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a class="yay-sub-toggle waves-effect waves-blue" href="#!">Third Level<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                    <ul>
                      <li><a href="#!" class="waves-effect waves-blue">Fourth Level</a>
                      </li>
                      <li><a href="#!" class="waves-effect waves-blue">Fourth Level</a>
                      </li>
                      <li><a href="#!" class="waves-effect waves-blue">Fourth Level</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>

          <li class="label">Elements</li>
          <li>
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-css3"></i> CSS<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
            <ul>
              <li><a class="waves-effect waves-blue" href="css-alerts.html"><i class="mdi-alert-warning"></i> Alerts</a>
              </li>
              <li><a class="waves-effect waves-blue" href="css-badges.html"><i class="mdi-action-stars"></i> Badges</a>
              </li>
              <li><a class="waves-effect waves-blue" href="css-colors.html"><i class="mdi-image-palette"></i> Colors</a>
              </li>
              <li><a class="waves-effect waves-blue" href="css-grid.html"><i class="mdi-action-dashboard"></i> Grid</a>
              </li>
              <li><a class="waves-effect waves-blue" href="css-icons.html"><i class="mdi-communication-invert-colors-on"></i> Icons</a>
              </li>
              <li><a class="waves-effect waves-blue" href="css-shadow.html"><i class="mdi-maps-layers"></i> Shadow</a>
              </li>
              <li><a class="waves-effect waves-blue" href="css-typography.html"><i class="fa fa-font"></i> Typography</a>
              </li>
            </ul>
          </li>

          <li>
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-cubes"></i> UI Elements<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
            <ul>
              <li><a class="waves-effect waves-blue" href="ui-buttons.html"><i class="fa fa-square"></i> Buttons</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ui-cards.html"><i class="mdi-av-web"></i> Cards</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ui-collapsible.html"><i class="mdi-action-view-day"></i> Collapsible</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ui-collections.html"><i class="fa fa-server"></i> Collections</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ui-dropdown.html"><i class="mdi-navigation-arrow-drop-down-circle"></i> Dropdown</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ui-modals.html"><i class="fa fa-external-link"></i> Modals</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ui-progress-bars.html"><i class="fa fa-tasks"></i> Progress Bars</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ui-tabs.html"><i class="mdi-action-tab-unselected"></i> Tabs</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ui-toasts.html"><i class="mdi-action-announcement"></i> Toasts</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ui-tooltips.html"><i class="fa fa-comment-o"></i> Tooltips</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ui-waves.html"><i class="mdi-image-blur-on"></i> Waves</a>
              </li>

              <li><a class="waves-effect waves-blue" href="ui-search-bar.html"><i class="mdi-action-search"></i> Search Bar</a>
              </li>
            </ul>
          </li>

          <li class="label">Components</li>
          <li>
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-check-square-o"></i> Forms<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
            <ul>
              <li><a class="waves-effect waves-blue" href="forms-base.html"><i class="fa fa-cube"></i> Base</a>
              </li>
              <li><a class="waves-effect waves-blue" href="forms-advanced.html"><i class="fa fa-cubes"></i> Advanced</a>
              </li>
              <li><a class="waves-effect waves-blue" href="forms-validation.html"><i class="fa fa-check-square-o"></i> Validation</a>
              </li>
              <li><a class="waves-effect waves-blue" href="forms-editors.html"><i class="fa fa-edit"></i> Editors</a>
              </li>
              <li><a class="waves-effect waves-blue" href="forms-checkout.html"> Checkout</a>
              </li>
              <li><a class="waves-effect waves-blue" href="forms-contacts.html"> Contacts</a>
              </li>
              <li><a class="waves-effect waves-blue" href="forms-login.html"> Login</a>
              </li>
              <li><a class="waves-effect waves-blue" href="forms-register.html"> Register</a>
              </li>
            </ul>
          </li>

          <li>
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-globe"></i> Pages<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
            <ul>
              <li><a class="waves-effect waves-blue" href="page-profile.html">Profile</a>
              </li>
              <li><a class="waves-effect waves-blue" href="page-timeline.html">Timeline</a>
              </li>
              <li><a class="waves-effect waves-blue" href="page-calendar.html">Calendar</a>
              </li>
              <li><a class="waves-effect waves-blue" href="page-forgot-password.html">Forgot Password</a>
              </li>
              <li><a class="waves-effect waves-blue" href="page-lock.html">Screen Lock</a>
              </li>
              <li><a class="waves-effect waves-blue" href="page-sign-in.html">Sign In</a>
              </li>
              <li><a class="waves-effect waves-blue" href="page-sign-up.html">Sign Up</a>
              </li>
              <li><a class="waves-effect waves-blue" href="page-404.html">404</a>
              </li>
              <li><a class="waves-effect waves-blue" href="page-500.html">500</a>
              </li>
              <li><a class="waves-effect waves-blue" href="page-blank.html">Blank</a>
              </li>
            </ul>
          </li>

          <li class="label">Extra</li>
          <li>
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-envelope"></i> Mailbox<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
            <ul>
              <li><a class="waves-effect waves-blue" href="mail-inbox.html"><i class="mdi-content-inbox"></i> Inbox</a>
              </li>
              <li><a class="waves-effect waves-blue" href="mail-compose.html"><i class="mdi-content-add-circle"></i> Compose</a>
              </li>
              <li><a class="waves-effect waves-blue" href="mail-view.html"><i class="mdi-content-drafts"></i> View</a>
              </li>
            </ul>
          </li>

          <li class="open">
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="mdi mdi-action-shopping-cart"></i> eCommerce<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
            <ul>
              <li class="active"><a class="waves-effect waves-blue" href="ecommerce-dashboard.html"><i class="fa fa-dashboard"></i> Dashboard</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ecommerce-products.html"><i class="fa fa-tags"></i> Products</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ecommerce-product-single.html"><i class="fa fa-tag"></i> Product Single</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ecommerce-orders.html"><i class="fa fa-cart-plus"></i> Orders</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ecommerce-order-single.html"><i class="fa fa-cart-plus"></i> Order Single</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ecommerce-customers.html"><i class="fa fa-users"></i> Customers</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ecommerce-settings.html"><i class="fa fa-cog"></i> Settings</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ecommerce-invoice.html"><i class="ion ion-android-list"></i> Invoice</a>
              </li>
            </ul>
          </li>

          <li>
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-bar-chart"></i> Charts<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
            <ul>
              <li><a class="waves-effect waves-blue" href="charts-flot.html">Flot</a>
              </li>
              <li><a class="waves-effect waves-blue" href="charts-rickshaw.html">Rickshaw</a>
              </li>
              <li><a class="waves-effect waves-blue" href="charts-sparkline.html">Sparkline</a>
              </li>
              <li><a class="waves-effect waves-blue" href="charts-nvd3.html">NVD3</a>
              </li>
            </ul>
          </li>

          <li>
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="mdi mdi-maps-place"></i> Maps<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
            <ul>
              <li><a class="waves-effect waves-blue" href="maps-google.html">Google Maps</a>
              </li>
              <li><a class="waves-effect waves-blue" href="maps-vector.html">Vector Maps</a>
              </li>
            </ul>
          </li>

          <li>
            <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-table"></i> Tables<span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
            <ul>
              <li><a class="waves-effect waves-blue" href="ui-tables.html">Base Tables</a>
              </li>
              <li><a class="waves-effect waves-blue" href="ui-datatables.html">Data Tables</a>
              </li>
            </ul>
          </li>

          <li class="label">Stats</li>
          <li class="content">
            <span><i class="fa fa-spinner"></i> Server Load</span>
            <div class="progress small light-green lighten-4">
              <div class="light-green accent-5" style="width: 37%"></div>
            </div>

            <span><i class="fa fa-thumbs-o-up"></i> User Satisfaction</span>
            <div class="progress small">
              <div style="width: 91%"></div>
            </div>
          </li>
        </ul>

      </div>
    </div>
  </aside>
  <!-- /Yay Sidebar -->


  <!-- Main Content -->
  <section class="content-wrap ecommerce-dashboard">


