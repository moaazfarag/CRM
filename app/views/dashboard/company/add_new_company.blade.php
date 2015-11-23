@extends('dashboard.company.main')
@section('content')
        <style>
            .bannerimage{
                width:100%;
                min-height: 100px;
                height:auto;
                position: relative;
                display:block;
                margin:5px auto;
            }
            .bannerimage img{
                width:100% !important;
                height:100% !important;
                min-height: 100px;
                display:block;
            }
            .banner {
                width:auto;
                height: 140px;
                /*margin: 1%;*/
                background: url({{ URL::asset('dashboard/img/banner4.jpg') }});
                background-size: cover;
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                border-radius: 2px;
                padding-bottom: 1%;
            }
           .body_add_company{
               width:100%;
               height:100%;
               background: url({{ URL::asset('dashboard/img/bg.png') }});
               background-repeat: repeat;
               padding-bottom: 5%;
               padding: 5px;
           }
        </style>
   <!-- start container -->
        <div class="body_add_company">

    <div class="container card" style="min-height: 500px; padding-top:1%; padding-bottom: 3%; margin-top: 2%; ">

            <div class="bannerimage">
                <img src="{{ URL::asset('dashboard/img/banner4.jpg') }}">

            </div>
        <div class="row">
            @include('include.messages')
            <div class="col m12 l6" >
        <!-- ################### company data ############################-->
                <div class="card" >
                    <div class="title">
                        <h4>بيانات الشركة </h4>

                    </div><!-- end title -->
                    <div class="content" style=" padding-bottom:13.5%; ">
                        {{ Form::open(array('route'=>array('storeNewCompany'))) }}
                            <div class="row no-margin-top">

                            <div class="col s11 l11">
                                <div class="input-field">
                                    <i class="mdi mdi-action-home prefix"></i>
                                    <?php $companyName=Lang::get('main.companyName') ?>
                                    {{--<input name="co_name" id="ecommerce-name" type="text" placeholder="اسم الشركة">--}}
                                    {{ Form::text('co_name',null,array('placeholder'=>$companyName)) }}
                                    <p class="parsley-required">{{ $errors ->first('co_name') }} </p>
                                </div>
                             </div>{{--end company name--}}


                            </div> {{--end row--}}

                             <div class="row no-margin-top">

                                 <div class="col s11 l11">
                                     <div class="input-field">
                                         <i class="mdi mdi-communication-location-on prefix"></i>
                                         <?php $address=Lang::get('main.address') ?>
                                         {{ Form::text('co_address',null,array('placeholder'=>$address)) }}
                                         <p class="parsley-required">{{ $errors ->first('co_address') }} </p>
                                     </div>
                                 </div>
                             </div>

                        <div class="row no-margin-top">
                            <div class="col s11 l11">
                                <div class="input-field">
                                    <i class="mdi mdi-communication-phone prefix"></i>
                                    <?php $phoneNum  =Lang::get('main.phone') ?>
                                    {{ Form::text('co_tel',null,array('placeholder'=>$phoneNum)) }}
                                    <p class="parsley-required">{{ $errors ->first('co_tel') }} </p>
                                </div>
                            </div>
                        </div>

                    </div> {{--end div content--}}
                </div>{{--div card--}}

                </div>
                <div class="col m12 l6">

    <!-- ################### user data ############################-->

        <div class="card" style=" margin-top:0;margin-bottom: 2%;">
            <div class="title">
                <h4>بيانات المدير الرئيسى للشركة </h4>

            </div><!-- end title -->
            <div class="content">


                <div class="row no-margin-top">

                    <div class="col s12 l11">
                        <div class="input-field">
                            <i class="fa fa-user prefix active"></i>
                            <?php $userName=Lang::get('main.name') ?>
                            {{ Form::text('username',null,array('placeholder'=>$userName)) }}
                            <p class="parsley-required">{{ $errors ->first('username') }} </p>
                        </div>
                    </div>{{--end company name--}}
                </div> {{--end row--}}

                <div class="row no-margin-top">

                    <div class="col s12 l11">
                        <div class="input-field">
                            <i class="mdi mdi-communication-email prefix active"></i>
                            <?php $email=Lang::get('main.email') ?>
                            {{ Form::text('email',null,array('placeholder'=>$email)) }}
                            <p class="parsley-required">{{ $errors ->first('email') }} </p>
                        </div>
                    </div>{{--end company name--}}
                </div> {{--end row--}}

                <div class="row no-margin-top">

                    <div class="col s12 l6">
                        <div class="input-field">
                            <i class="mdi mdi-action-lock prefix"></i>
                            <?php $password=Lang::get('main.password') ?>
                            {{ Form::password('password',array('placeholder'=>$password)) }}
                            <p class="parsley-required">{{ $errors ->first('password') }} </p>
                        </div>
                    </div>

                    <div class="col s12 l5">
                        <div class="input-field">
                            <i class="mdi mdi-action-lock prefix"></i>
                            <?php $phoneNum=Lang::get('main.password_confirm') ?>
                            {{ Form::password('password_confirm',array('placeholder'=>$phoneNum)) }}
                            <p class="parsley-required">{{ $errors ->first('password_confirm') }} </p>

                        </div>
                    </div>
                </div>


            </div> {{--end div content--}}
        </div>{{--div card--}}





        </div>
            </div>
        <!-- ################### submit button ################-->
        <div class="row no-margin-top">
            
{{Form::captcha()}}

            <div  style="background-color:#ccc; width:100px; text-align:center;margin:1% auto;">  <button type="submit" class="waves-effect btn">@lang('main.submit') <i class="mdi-content-send right"></i></button>
                {{ Form::close() }}
            </div>
        </div>



    </div>{{--div container--}}
        </div>
@stop