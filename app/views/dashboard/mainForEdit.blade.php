<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="lt-ie7"> <![endif]-->
<!--[if IE 7]>     <html class="lt-ie8"> <![endif]-->
<!--[if IE 8]>     <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="rtl">
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Con - Admin Dashboard with Material Design</title>

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>

  <link rel="icon" type="image/png" href="assets/_con/images/icon.png">

  <!-- nanoScroller -->

    {{ HTML::style('dashboard/assets/nanoScroller/nanoscroller.css') }}

  <!-- FontAwesome -->
  {{ HTML::style('dashboard/assets/font-awesome/css/font-awesome.min.css') }}

  <!-- Material Design Icons -->
  {{ HTML::style('dashboard/assets/material-design-icons/css/material-design-icons.min.css') }}

  <!-- IonIcons -->
  {{ HTML::style('dashboard/assets/ionicons/css/ionicons.min.css') }}

  <!-- WeatherIcons -->
  {{ HTML::style('dashboard/assets/weatherIcons/css/weather-icons.min.css') }}

  <!-- Google Prettify -->
  {{ HTML::style('dashboard/assets/google-code-prettify/prettify.css') }}
  <!-- Main -->
  {{ HTML::style('dashboard/assets/_con/css/_con.min.css') }}

  <!--[if lt IE 9]>
    <script src="assets/html5shiv/html5shiv.min.js') }}
  <![endif]-->
</head>

<body>


  <!--
  Top Navbar
    Options:
      .navbar-dark - dark color scheme
      .navbar-static - static navbar
      .navbar-under - under sidebar
-->
  <nav class="navbar-top">
    <div class="nav-wrapper">

      <!-- Sidebar toggle -->
      <a href="#" class="yay-toggle">
        <div class="burg1"></div>
        <div class="burg2"></div>
        <div class="burg3"></div>
      </a>
      <!-- Sidebar toggle -->

      <!-- Logo -->
      <a href="#!" class="brand-logo">
       <img src="{{ URL::asset('dashboard/assets/_con/images/logo.png') }}" alt="Con">
      </a>
      <!-- /Logo -->

      <!-- Menu -->
      <ul>
        <li><a href="#!" class="search-bar-toggle"><i class="mdi-action-search"></i></a>
        </li>
        <li class="user">
          <a class="dropdown-button" href="#!" data-activates="user-dropdown">
           <img src="{{ URL::asset('dashboard/assets/_con/images/user.jpg') }}" alt="John Doe" class="circle">John Doe<i class="mdi-navigation-expand-more right"></i>
          </a>

          <ul id="user-dropdown" class="dropdown-content">
            <li><a href="page-profile.html"><i class="fa fa-user"></i> Profile</a>
            </li>
            <li><a href="mail-inbox.html"><i class="fa fa-envelope"></i> Messages <span class="badge new">2</span></a>
            </li>
            <li><a href="#!"><i class="fa fa-cogs"></i> Settings</a>
            </li>
            <li class="divider"></li>
            <li><a href="page-sign-in.html"><i class="fa fa-sign-out"></i> Logout</a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- /Menu -->

    </div>
  </nav>
  <!-- /Top Navbar -->


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
         <img src="{{ URL::asset('dashboard/assets/_con/images/logo-white.png') }}" alt="Con">
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


    <!-- Breadcrumb -->
    <div class="ecommerce-title">

      <div class="row">
        <div class="col s12 m9 l10">
          <!--h1>@@title</h1-->
          <nav>
            <ul class="left">
              <li class="active"><a href="ecommerce-dashboard.html">Dashboard</a>
              </li>
              <li><a href="ecommerce-products.html">Products</a>
              </li>
              <li><a href="ecommerce-orders.html">Orders</a>
              </li>
              <li><a href="ecommerce-customers.html">Customers</a>
              </li>
              <li><a href="ecommerce-settings.html">Settings</a>
              </li>
            </ul>
          </nav>

        </div>
        <div class="col s12 m3 l2 right-align">
          <a href="#!" class="btn grey lighten-3 grey-text z-depth-0 chat-toggle"><i class="fa fa-comments"></i></a>
        </div>
      </div>

    </div>
    <!-- /Breadcrumb -->


    @yield('content')


      <footer>&copy; 2015 <strong>nK</strong>. All rights reserved. <a href="http://themeforest.net/item/con-material-admin-dashboard-template/10621512?ref=nKdev">Purchase</a>
      </footer>
      <!-- DEMO [REMOVE IT ON PRODUCTION] -->
      {{ HTML::script('dashboard/assets/_con/js/_demo.js') }}

      <!-- jQuery -->
      {{ HTML::script('dashboard/assets/jquery/jquery.min.js') }}

      <!-- jQuery RAF (improved animation performance) -->
      {{ HTML::script('dashboard/assets/jqueryRAF/jquery.requestAnimationFrame.min.js') }}

      <!-- nanoScroller -->
      {{ HTML::script('dashboard/assets/nanoScroller/jquery.nanoscroller.min.js') }}

      <!-- Materialize -->
      {{ HTML::script('dashboard/assets/materialize/js/materialize.min.js') }}


      <!-- Flot -->
      {{ HTML::script('dashboard/assets/flot/jquery.flot.min.js') }}
      {{ HTML::script('dashboard/assets/flot/jquery.flot.time.min.js') }}
      {{ HTML::script('dashboard/assets/flot/jquery.flot.pie.min.js') }}
      {{ HTML::script('dashboard/assets/flot/jquery.flot.tooltip.min.js') }}
      {{ HTML::script('dashboard/assets/flot/jquery.flot.categories.min.js') }}
      <!-- Sortable -->
      {{ HTML::script('dashboard/assets/sortable/Sortable.min.js') }}

      <!-- Main -->
      {{ HTML::script('dashboard/assets/_con/js/_con.min.js') }}


      <!-- Google Prettify -->
      {{ HTML::script('dashboard/assets/google-code-prettify/prettify.js') }}
      <script>
        /*
         * Revenue Line Chart
         */
        (function() {
          var chart = $("#revenueLineChart");
          var dataPhones = {
            data: [[1,1396.49],[2,1223.26],[3,1185.82],[4,1203.58],[5,1028.26],[6,1260.74],[7,1169.33],[8,1068.55],[9,1267.51],[10,1331.9],[11,1065.97],[12,1162.62]],
            idx: 0,
            label: "Phones"
          };
          var dataTablets = {
            data: [[1,1042.49],[2,1096.24],[3,868.09],[4,848.95],[5,1153.2],[6,822.75],[7,857.52],[8,755.9],[9,993.13],[10,1193.1],[11,790.67],[12,937.19]],
            idx: 1,
            label: "Tablets"
          };
          var dataWatches = {
            data: [[1,631.99],[2,585.23],[3,731.48],[4,450.13],[5,592.13],[6,743.91],[7,616.52],[8,570.09],[9,722.23],[10,525.69],[11,563.85],[12,519.79]],
            idx: 2,
            label: "Watches"
          };
          var dataTVs = {
            data: [[1,1131.78],[2,1305.13],[3,1392.68],[4,1055.79],[5,1432.01],[6,1098.6],[7,1280.68],[8,1010.23],[9,1267.37],[10,1447.23],[11,1447.43],[12,1073.42]],
            idx: 3,
            label: "TVs"
          };
          var options = {
            series: {
              lines: {
                show: true,
                lineWidth: 1,
                fill: false
              },
              points: {
                show: true,
                lineWidth: 2,
                radius: 3
              },
              shadowSize: 0,
              stack: true
            },
            grid: {
              hoverable: true,
              clickable: true,
              tickColor: "#f9f9f9",
              borderWidth: 0
            },
            legend: {
              // show: false
              backgroundOpacity: 0,
              labelBoxBorderColor: "#fff",
              labelFormatter: function(label, series){
                return '<a href="#" onClick="togglePlot('+series.idx+'); return false;" style="color: inherit">'+label+'</a>';
              }
            },
            colors: ["#ab47bc", "#5c6bc0", "#26a69a", "#ef5350"],
            xaxis: {
              ticks: [[1, "Jan"], [2, "Feb"], [3, "Mar"], [4,"Apr"], [5,"May"], [6,"Jun"],
                         [7,"Jul"], [8,"Aug"], [9,"Sep"], [10,"Oct"], [11,"Nov"], [12,"Dec"]],
              font: {
                family: "Roboto,sans-serif",
                color: "#A5A5A5"
              }
            },
            yaxis: {
              ticks:7,
              font: {color: "#A5A5A5"}
            }
          };

          var plot;
          function initFlot() {
            plot = $.plot(chart, [dataPhones, dataTablets, dataWatches, dataTVs], options);
            chart.css({
                marginTop: 25
              })
              .find('.legend table')
                .css({
                  marginTop: -35,
                  width: 'auto'
                })
              .find('td').css({
                padding: 5
              })
            chart.find('tr').css({
              display: 'block',
               'float': 'left'
             });
          }
          initFlot();
          $(window).on('resize', initFlot);


          window.togglePlot = function(seriesIdx) {
            var someData = plot.getData();
            someData[seriesIdx].lines.show = !someData[seriesIdx].lines.show;
            someData[seriesIdx].points.show = !someData[seriesIdx].points.show;
            plot.setData(someData);
            plot.draw();
          }

          function showTooltip(x, y, contents) {
            var tooltip = $('<div id="tooltip">' + contents + '</div>').css( {
              position: 'absolute',
              display: 'none',
              top: y - 60,
              color: "#fff",
              padding: '5px 10px',
              marginLeft: '-10px',
              'border-radius': '3px',
              'background-color': 'rgba(0,0,0,0.6)'
            }).appendTo("body");

            tooltip.css({
              left: x - tooltip.width() / 2
            }).fadeIn(200);
          }

          var previousPoint = null;
          chart.bind("plothover", function (event, pos, item) {
            if (item) {
              if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;

                $("#tooltip").remove();
                var x = item.datapoint[0].toFixed(0),
                    y = item.datapoint[1].toFixed(0);

                var month = item.series.xaxis.ticks[item.dataIndex].label;

                showTooltip(item.pageX, item.pageY, month + "<br>" + item.series.label + " : $" + y);
              }
            }
            else {
              $("#tooltip").remove();
              previousPoint = null;
            }
          });
        }());



        /*
         * Revenue Bar Chart
         */
        $(function() {
          var chart = $("#revenueBarChart");
          var data = [
            {data: [["Phones", 1287]], color: "#ab47bc"},
            {data: [["Tablets", 976]], color: "#5c6bc0"},
            {data: [["Watches", 649]], color: "#26a69a"},
            {data: [["TVs", 1389]], color: "#ef5350"}
          ];
          var options = {
            series: {
              bars: {
                show: true,
                barWidth: 0.5,
                lineWidth: 0,
                align: "center",
                fill: 1
              }
            },
            grid: {
              hoverable: true,
              tickColor: "#f9f9f9",
              borderWidth: 0
            },
            xaxis: {
              mode: "categories",
              font: {
                family: "Roboto,sans-serif",
                color: "#A5A5A5"
              }
            },
            yaxis: {
              ticks:7,
              font: {
                family: "Roboto,sans-serif",
                color: "#A5A5A5"
              }
            }
          };

          var plot;
          function initFlot() {
            plot = $.plot(chart, data, options);
            chart.css({
              marginTop: 25
            });
          }
          initFlot();
          $(window).on('resize', initFlot);


          function showTooltip(x, y, contents) {
            var tooltip = $('<div id="tooltip">' + contents + '</div>').css( {
              position: 'absolute',
              display: 'none',
              top: y - 40,
              color: "#fff",
              padding: '5px 10px',
              marginLeft: '-10px',
              'border-radius': '3px',
              'background-color': 'rgba(0,0,0,0.6)'
            }).appendTo("body");

            tooltip.css({
              left: x - tooltip.width() / 2
            }).fadeIn(200);
          }

          var previousPoint = null;
          chart.bind("plothover", function (event, pos, item) {
            if (item) {
              if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;

                $("#tooltip").remove();
                var x = item.datapoint[0].toFixed(0),
                    y = item.datapoint[1].toFixed(0);

                var month = item.series.xaxis.ticks[item.dataIndex].label;

                showTooltip(item.pageX, item.pageY, item.series.data[0][0] + " : $" + y);
              }
            }
            else {
              $("#tooltip").remove();
              previousPoint = null;
            }
          });
        });
      </script>

    </body>

    </html>




