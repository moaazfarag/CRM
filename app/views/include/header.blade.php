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
    <title>الراصد | {{ @$title }} </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>

  <link rel="icon" type="image/png" href="{{ URL::asset('dashboard/assets/_con/images/icon.png') }}">
        <style>
          @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
        </style>
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
           <img src="{{ URL::asset('dashboard/assets/_con/images/user.jpg') }}" alt="John Doe" class="circle">@lang('main.memberName')<i class="mdi-navigation-expand-more right"></i>
          </a>

          <ul id="user-dropdown" class="dropdown-content">
            <li><a href="page-profile.html"><i class="fa fa-user"></i>@lang('main.yourAccount') </a>
            </li>
            <li><a href="#!"><i class="fa fa-cogs"></i> @lang('main.settings')</a>
            </li>
            <li class="divider">

            </li>
            <li>
                <a href="/logout">
                    <i class="fa fa-sign-out"></i> @lang('main.login') </a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- /Menu -->

    </div>
  </nav>
  <!-- /Top Navbar -->