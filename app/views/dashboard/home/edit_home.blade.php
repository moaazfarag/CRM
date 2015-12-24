@extends('dashboard.main')
@section('content')
<!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    <div class="card-panel">

        <div class="content">
            @include('include.messages')

            <div class="card-panel blue lighten-5 center_title">

           بيانات الصفحة الرئيسية
            </div>
            <p></p>
        <!-- ???????  -->
        <div class="card minimized">
            <div class="title">
                <h5><i class="mdi mdi-notification-event-available"></i> تعديل بيانات رأس الصفحة</h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
            <div class="content" >
                @include('include.messages')

                {{--{{ dd($editSeason->name) }}--}}

                {{ Form::model($home_page,array('route'=>array('updateHome','header'))) }}

                <div class="row no-margin-top">
                    <div class="col s12 l1">
                        <label for="title">
               أسم الشركة
                        </label>

                    </div>
                    <div class="col s12 m5 l5">
                        <div class="input-field">

                            {{Form::text('title',null,array('required','placeholder'=>" ".  @$holder,'data-parsley-id'=>'4370','class'=>($errors->first('title'))?'parsley-error':null,'id'=>'title')) }}
                            {{--<input value="{{ null }}" name="cat_name" id="cat-name" type="text" placeholder="???  {{@$arabicName}}">--}}
                            <p class="parsley-required error-validation">{{ $errors ->first('title') }} </p>
                        </div>
                    </div>
                </div>
                <div class="row no-margin-top">
                <div class="col s12 l1">
                    <label for="ckeditor2">
وصف الشركة
                    </label>

                </div>
                <div class="col s12 l9">

                    <div class="input-field">
                        {{ Form::textarea('details',null,array('id'=>'ckeditor2','data-parsley-id'=>'4370','class'=>($errors->first('details'))?'parsley-error':"materialize-textarea")) }}
                        <div id="ckeditorb"></div>

                        <p class="parsley-required">{{ $errors ->first('details') }} </p>
                    </div>
                </div>
                </div>

                <div class="row">
                    <div class="col s12 l12">

                        <button class="waves-effect btn">@lang('main.edit') </button>

                        {{ Form::close() }}
                    </div>

                </div>
                <br/>
            </div>
        </div>

            <div class="card minimized">
                <div class="title">
                    <h5><i class="mdi mdi-notification-event-available"></i>تعديل بيانات من نحن </h5>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content">
                    <div class="row no-margin-top">
                        {{ Form::model($home_page,array('route'=>array('updateHome','about_us'))) }}

                        <div class="col s12 l1">
                            <label for="title">
                                من نحن
                            </label>

                        </div>
                        <div class="col s12 m5 l5">
                            <div class="input-field">

                                {{Form::text('about',null,array('required','placeholder'=>" ".  @$holder,'data-parsley-id'=>'4370','class'=>($errors->first('about'))?'parsley-error':null,'id'=>'title')) }}
                                <p class="parsley-required error-validation">{{ $errors ->first('about') }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin-top">
                        <div class="col s12 l1">
                            <label for="ckeditor1">
                                موضوع من نحن
                            </label>

                        </div>
                        <div class="col s12 l9">

                            <div class="input-field">
                                {{ Form::textarea('about_content',null,array("id"=>"ckeditor1",'data-parsley-id'=>'4370','class'=>($errors->first('about_content'))?'parsley-error materialize-textarea':'materialize-textarea')) }}
                                <p class="parsley-required">{{ $errors ->first('about_content') }} </p>
                            </div>
                        </div>
                        <div id="ckeditora"></div>

                    </div>
                    <div class="row">
                        <div class="col s12 l12">

                            <button class="waves-effect btn">@lang('main.edit') </button>

                            {{ Form::close() }}
                        </div>

                    </div>
                </div>
                </div>

            <div class="card minimized">
                {{ Form::model($home_page,array('route'=>array('updateHome','sochial'))) }}

                <div class="title">
                    <h5><i class="mdi mdi-notification-event-available"></i>  روابط مواقع التواصل الإجتماعى  </h5>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content">
                    <div class="row no-margin-top">
                        <div class="col s12 l1">
                            <label for="title">
فيس بوك
                            </label>

                        </div>
                        <div class="col s12 m5 l5">
                            <div class="input-field">
                                <i class="fa fa-facebook-square prefix"></i>
                                {{Form::text('facebook',null,array('required','placeholder'=>" ".  @$holder,'data-parsley-id'=>'4370','class'=>($errors->first(''))?'parsley-error':null,'id'=>'title')) }}
                                <p class="parsley-required error-validation">{{ $errors ->first('facebook') }} </p>
                            </div>
                        </div>
                        <div class="col s12 l1">
                            <label for="title">
تويتر
                            </label>

                        </div>
                        <div class="col s12 m5 l5">
                            <div class="input-field">
                                <i class="fa fa-twitter-square prefix"></i>
                                {{Form::text('twitter',null,array('required','placeholder'=>" ".  @$holder,'id'=>'title','data-parsley-id'=>'4370','class'=>($errors->first('twitter'))?'parsley-error':null)) }}
                                <p class="parsley-required error-validation">{{ $errors ->first('twitter') }} </p>
                            </div>
                        </div>
                    </div>

                    <div class="row no-margin-top">
                        <div class="col s12 l1">
                            <label for="title">
جوجل بلس
                            </label>

                        </div>
                        <div class="col s12 m5 l5">
                            <div class="input-field">
                                <i class="fa fa-google-plus-square  prefix"></i>

                                {{Form::text('google',null,array('required','placeholder'=>" ".  @$holder,'id'=>'title','data-parsley-id'=>'4370','class'=>($errors->first('google'))?'parsley-error':null)) }}
                                <p class="parsley-required error-validation">{{ $errors ->first('google') }} </p>
                            </div>
                        </div>
                        <div class="col s12 l1">
                            <label for="title">
يوتيوب
                            </label>

                        </div>
                        <div class="col s12 m5 l5">
                            <div class="input-field">
                                <i class="fa fa-youtube-square prefix"></i>

                                {{Form::text('youtube',null,array('required','placeholder'=>" ".  @$holder,'id'=>'title','data-parsley-id'=>'4370','class'=>($errors->first('youtube'))?'parsley-error':null)) }}
                                <p class="parsley-required error-validation">{{ $errors ->first('youtube') }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="row no-margin-top">
                        <div class="col s12 l1">
                            <label for="title">
لينكدإن
                            </label>
                        </div>
                        <div class="col s12 m5 l5">
                            <div class="input-field">
                                <i class="fa fa-linkedin-square  prefix"></i>
                                {{Form::text('linkedin',null,array('required','placeholder'=>" ".  @$holder,'id'=>'title','data-parsley-id'=>'4370','class'=>($errors->first('linkedin'))?'parsley-error':null)) }}
                                <p class="parsley-required error-validation">{{ $errors ->first('linkedin') }} </p>
                            </div>
                        </div>
                        <div class="col s12 l1">
                            <label for="title">
إنستجرام
                            </label>

                        </div>
                        <div class="col s12 m5 l5">
                            <div class="input-field">
                                <i class="fa fa-instagram prefix"></i>
                                {{Form::text('instgram',null,array('required','placeholder'=>" ".  @$holder,'id'=>'title','data-parsley-id'=>'4370','class'=>($errors->first('instgram'))?'parsley-error':null)) }}
                                <p class="parsley-required error-validation">{{ $errors ->first('instgram') }} </p>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col s12 l12">

                            <button class="waves-effect btn">@lang('main.edit') </button>

                            {{ Form::close() }}
                        </div>

                    </div>
                </div>
            </div>

            <div class="card minimized">
                <div class="title">
                    <h5><i class="mdi mdi-notification-event-available"></i> البريد الإلكترونى لتلقى الرسائل من المستخدمين  </h5>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content">
                    <div class="row no-margin-top">
                        {{ Form::model($home_page,array('route'=>array('updateHome','email'))) }}

                        <div class="col s12 l1">
                            <label for="title">
البريد الألكترونى
                            </label>

                        </div>
                        <div class="col s12 m5 l5">
                            <div class="input-field">

                                {{Form::text('email',null,array('required','placeholder'=>" ".  @$holder,'id'=>'title','data-parsley-id'=>'4370','class'=>($errors->first('email'))?'parsley-error':null)) }}
                                {{--<input value="{{ null }}" name="cat_name" id="cat-name" type="text" placeholder="???  {{@$arabicName}}">--}}
                                <p class="parsley-required error-validation">{{ $errors ->first('email') }} </p>
                            </div>
                        </div>
                        <div class="col s12 l3">

                            <button class="waves-effect btn">@lang('main.edit') </button>

                            {{ Form::close() }}
                        </div>

                    </div>


               </div>
            </div>
      </div>
    </div>
</section>
@stop