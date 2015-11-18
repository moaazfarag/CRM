<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الراصد | تسجيل الدخول</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">

    {{ HTML::style('frontend/login_assets/assets/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('frontend/login_assets/assets/font-awesome/css/font-awesome.min.css') }}
    {{ HTML::style('frontend/login_assets/assets/css/form-elements.css') }}
    {{ HTML::style('frontend/login_assets/assets/css/style.css') }}

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="frontend/login_assets/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="frontend/login_assets/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="frontend/login_assets/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="frontend/login_assets/assets/ico/apple-touch-icon-57-precomposed.png">
    <style>
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);

        body{

            font-family: 'Droid Arabic Kufi', sans-serif;
            font-size: 18px;
            font-weight: 600;

        }
        .kufifont{
            font-family: 'Droid Arabic Kufi', sans-serif;
            font-size: 18px;
        }
    </style>
</head>

<body>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container" style="padding: 5%;">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <div class="description">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <i class="fa fa-key"></i>
                        </div>
                        <div class="form-top-right">
                            <h3>موقع الراصد لإدارة المحلات والشركات</h3>
                            <p>تسجيل دخول لوحة التحكم </p>
                        </div>

                    </div>
                    <div class="form-bottom" dir="rtl">
                        {{ Form::open(array('route'=>'login','class'=>'login-form'))}}
                        {{--<form role="form" action="" method="post" class="login-form">--}}
                            <div class="form-group @if ($errors->has('username')) has-error @endif">
                                <input type="text" name="username" placeholder="اسم المستخدم ..." class="form-username form-control" id="form-username">
                                @if ($errors->has('username')) <p style="text-align: right;" class="help-block">{{ $errors->first('username') }}</p> @endif
                            </div>

                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                <input type="password" name="password" placeholder="كلمة المرور ..." class="form-password form-control" id="form-password">
                                @if ($errors->has('password')) <p style="text-align: right;" class="help-block">{{ $errors->first('password') }}</p> @endif

                            </div>
                            <div class="form-group @if ($errors->has('co_id')) has-error @endif">
                                <input type="text" name="co_id" placeholder="رقم الشركة ... " class="form-password form-control" id="form-password">
                                @if ($errors->has('co_id')) <p style="text-align: right;"  class="help-block">{{ $errors->first('co_id') }}</p> @endif
                            </div>
                        @if(Session::has('error'))
                            <div class="form-group has-error">

                            <p class="help-block" style="text-align: right;">
                               <?php $msg =  Session::get('error'); echo $msg;?>
                            </p>
                        @endif
                            <button type="submit" class="btn kufifont">تسجيل الدخول</button>
                                <div dir="rtl">
                                    <a style="font-size: 14px !important; text-align: right; text-decoration: underline; color: #0a8ec4; text-align: right; " href="add-new-company"> تسجيل شركة جديدة  </a>
                                </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            {{--<div class="row">--}}
                {{--<div class="col-sm-6 col-sm-offset-3 social-login">--}}
                    {{--<h3>...or login with:</h3>--}}
                    {{--<div class="social-login-buttons">--}}
                        {{--<a class="btn btn-link-1 btn-link-1-facebook" href="#">--}}
                            {{--<i class="fa fa-facebook"></i> Facebook--}}
                        {{--</a>--}}
                        {{--<a class="btn btn-link-1 btn-link-1-twitter" href="#">--}}
                            {{--<i class="fa fa-twitter"></i> Twitter--}}
                        {{--</a>--}}
                        {{--<a class="btn btn-link-1 btn-link-1-google-plus" href="#">--}}
                            {{--<i class="fa fa-google-plus"></i> Google Plus--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>

</div>


<!-- Javascript -->
{{ HTML::script('frontend/login_assets/assets/js/jquery-1.11.1.min.js') }}
{{ HTML::script('frontend/login_assets/assets/bootstrap/js/bootstrap.min.js') }}
{{ HTML::script('frontend/login_assets/assets/js/jquery.backstretch.min.js') }}
{{ HTML::script('frontend/login_assets/assets/js/scripts.js') }}

<!--[if lt IE 10]>
{{ HTML::script('frontend/login_assets/assets/js/placeholder.js') }}
<![endif]-->

</body>

</html>