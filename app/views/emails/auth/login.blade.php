
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="lt-ie7"> <![endif]-->
<!--[if IE 7]>     <html class="lt-ie8"> <![endif]-->
<!--[if IE 8]>     <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="rtl">
<!--<![endif]-->
{{ Hash::make('123456') }}
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> الراصد  </title>

  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{ HTML::Style('http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900')}}
  {{ HTML::Style('dashboard/assets/nanoScroller/nanoscroller.css')}}
  {{ HTML::Style('dashboard/assets/font-awesome/css/font-awesome.min.css')}}
  {{ HTML::Style('dashboard/assets/material-design-icons/css/material-design-icons.min.css')}}
  {{ HTML::Style('dashboard/assets/ionicons/css/ionicons.min.css')}}
  {{ HTML::Style('dashboard/assets/weatherIcons/css/weather-icons.min.css') }}
  {{ HTML::Style('dashboard/assets/_con/css/_con.min.css') }}
  

  <link rel="icon" type="image/png" href="assets/_con/images/icon.png">

      <style>
      @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
      
      .body{

 font-family: 'Droid Arabic Kufi', sans-serif;
 font-size: 18px;
      }
    </style>
  <!--[if lt IE 9]>
  {{ HTML::script('dashboard/assets/html5shiv/html5shiv.min.js')}}
  <![endif]-->
</head>

<body class="body">

  <section id="sign-in">

    <!-- Background Bubbles -->
    <canvas id="bubble-canvas"></canvas>
    <!-- /Background Bubbles -->

    <!-- Sign In Form -->
   {{ Form::open(array('route'=>'login'))}}

      <div class="card-panel">

      <div class="card-panel blue lighten-4" style="color:#000; text-align:center; "><strong>تسجيل الدخول للوحة التحكم</strong></div>

        <div class="row">
          <div class="col"></div>
        </div>
<br>
          <!-- Username -->
        <div class="input-field">
          <i class="fa fa-user prefix"></i>
          <input id="username-input" type="text"  value="{{Input::old('username')}}" name="username" class="validate">
        <div style="text-align: right;">
         <ul class="parsley-errors-list filled" id="parsley-id-5202">
             <li class="parsley-required">@if($errors->has('username')){{ $errors->First('username') }} @endif</li>
         </ul>
          </div>
          <label for="username-input">اسم المدير</label>
        </div>
        <!-- /Username -->

        <!-- Password -->
        <div class="input-field">
          <i class="fa fa-unlock-alt prefix"></i>
          <input id="password-input" value="{{Input::old('password')}}" type="password" name="password" class="validate">
          <div style="text-align: right;">
            <ul class="parsley-errors-list filled" id="parsley-id-5202">
                <li class="parsley-required">@if($errors->has('password')){{ $errors->First('password') }} @endif</li>
            </ul>
          </div>
          <label for="password-input">كلمة المرور</label>

        </div>

        <!-- /Password -->
          <!-- co_id -->
          <div class="col s12 l1">
              <div class="input-field">

                  <label style=" margin: 0 40% " for="co_id-input">رقم الشركة </label>
                  <input style=" margin: 0 40%; width:100px " id="co_id-input" type="number"  value="{{Input::old('co_id')}}" name="co_id" class="validate">
                  <div style="text-align: right;">
                      <ul class="parsley-errors-list filled" id="parsley-id-5202">
                          <li class="parsley-required">@if($errors->has('co_id')){{ $errors->First('co_id') }} @endif</li>
                      </ul>
                  </div>
              </div>
          </div>
          <!-- /co_id -->
 @if(Session::has('error'))
  <div style="text-align: right;">
   <ul class="parsley-errors-list filled" id="parsley-id-5202">
                <li class="parsley-required">  <?php $msg =  Session::get('error'); echo $msg;?></li>
            </ul>
  </div>
  @endif

       

        <button class="waves-effect waves-light btn-large z-depth-0 z-depth-1-hover">تسجيل الدخول</button>
          <div dir="rtl">
              <a style="font-size: 14px !important; text-align: right; text-decoration: underline; " href="add-new-company"> تسجيل شركة جديدة  </a>
          </div>

      </div>

      {{ Form::close() }}
    <!-- /Sign In Form -->

  </section>

  {{ HTML::script('dashboard/assets/_con/js/_demo.js')}}
  {{ HTML::script('dashboard/assets/jquery/jquery.min.js')}}
  {{ HTML::script('dashboard/assets/jqueryRAF/jquery.requestAnimationFrame.min.js')}}
  {{ HTML::script('dashboard/assets/nanoScroller/jquery.nanoscroller.min.js')}}
  {{ HTML::script('dashboard/assets/materialize/js/materialize.min.js')}}
  {{ HTML::script('dashboard/assets/sortable/Sortable.min.js')}}
  {{ HTML::script('dashboard/assets/_con/js/_con.min.js')}}


</body>

</html>