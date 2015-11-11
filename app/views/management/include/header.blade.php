<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 11/9/2015
 * Time: 1:53 PM
 */
?>

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
    <title> إدارة الراصد | {{ @$title }} </title>
<meta http-equiv="Content-Type" content="application/json; charset=UTF-8">

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
{{ HTML::style('dashboard/assets/select2/css/select2.min.css') }}

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
    {{ HTML::style('dashboard/assets/pikaday/pikaday.css') }}
    {{--custom css--}}
    {{ HTML::style('dashboard/css/style.css') }}

  <!--[if lt IE 9]>
<script src="assets/html5shiv/html5shiv.min.js">
    {{ HTML::script('dashboard/assets/angular.min.js') }}

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



        <!-- Logo -->
        <a href="#!" class="brand-logo">
            <img src="{{ URL::asset('dashboard/assets/_con/images/logo.png') }}" alt="Con">
        </a>
        <!-- /Logo -->

        <!-- Menu -->
        <ul>


            <li class="user">
                <a class="dropdown-button" href="#!" data-activates="user-dropdown">
                    <img src="{{ URL::asset('dashboard/assets/_con/images/user.jpg') }}" alt="John Doe" class="circle">
                    <i class="mdi-navigation-expand-more right"></i>
                </a>
                <ul id="user-dropdown" class="dropdown-content">
                    <li>
                        <a href="page-profile.html">
                            <i class="fa fa-user"></i>
                            @lang('main.yourAccount')
                        </a>
                    </li>
                    <li>
                        <a href="#!">
                            <i class="fa fa-cogs"></i>
                            @lang('main.settings')
                        </a>
                    </li>

                    <li>
                        <a href="{{ URL::route('logOutManagement') }}">
                            <i class="fa fa-sign-out"></i> @lang('main.logout') </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /Menu -->

    </div>
</nav>
<!-- /Top Navbar -->
<section class="content-wrap ecommerce-products" style="margin-left:0 !important;">


    <!-- Breadcrumb -->
    <div class="ecommerce-title">

        <div class="row">
            <div class="col s12 m9 l10">
                <!--h1>@@title</h1-->
                <nav>
                    <ul class="left">

                        <li class="@if($type == 'suspended_companies' || $type == NULL ) active @endif"><a href="{{ URL::route('elrasedManagement','suspended_companies') }}"> الموقوفين</a>
                        </li>

                        <li class="@if($type == 'trial_companies' || $type == NULL ) active @endif"><a href="{{ URL::route('elrasedManagement','trial_companies') }}">الفترة المجانية</a>
                        </li>
                        <li class="@if($type == 'paid_companies' || $type == NULL ) active @endif"><a href="{{ URL::route('elrasedManagement','paid_companies') }}"> المشتركين</a>
                        </li>
                        <li class="@if($type == 'all_companies' || $type == NULL ) active @endif"><a href="{{ URL::route('elrasedManagement','all_companies') }}"> الكل</a>
                        </li>
                    </ul>
                </nav>

            </div>

        </div>

    </div>


<!-- end menu -->
