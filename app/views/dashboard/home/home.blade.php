@extends('dashboard.main')

@section('content')
    <section class="content-wrap">

    <div class="card-panel">
        <table class="profile-info">
            <tbody>
            <tr>
                    {{--@if(Session::has('logo'))--}}
                        {{--<td class="photo">--}}
                            {{--<img src="{{ URL::asset(Session::get('logo')) }}" style="width:150px; margin:3px;height:150px;clear: both;" alt="logo">--}}
                        {{--</td>--}}
                    {{--@endif--}}
                <td>
                    <!-- Name -->
                    <h3>{{@$home_page->title }}</h3>
                    <!-- /Name -->

                    <!-- Status Message -->
                    <span>
                        {{@$home_page->details }}
                    </span>
                    <!-- /Status Message -->

                    <!-- Contact Buttons -->
                    <div class="contacts">
                        <a href="{{@$home_page->facebook }}" class="blue darken-3 white-text waves-effect">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="{{@$home_page->twitter }}" class="blue lighten-2 white-text waves-effect">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="{{@$home_page->google }}" class="red white-text waves-effect">
                            <i class="fa fa-google-plus"></i>
                        </a>
                        <a href="{{@$home_page->youtube }}" class="blue lighten-1 white-text waves-effect">
                            <i class="fa fa-youtube"></i>
                        </a>
                        <a href="{{@$home_page->linkedin }}" class="grey darken-3 white-text waves-effect">
                            <i class="fa fa-linkedin"></i>
                        </a>
                        <a href="{{@$home_page->instgram }}" class="pink lighten-1 white-text waves-effect">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <!-- /Contact Buttons -->
                </td>


            </tr>
            </tbody>
        </table>
    </div>

    <div class="row">

        <div class="col s12 l9">

            <!-- About -->
            <div class="card minimized" >
                <div class="title">
                    <h5><i class="fa fa-user"></i> {{@$home_page->about }}</h5>
                    <a class="close" href="#">
                        <i class="mdi-content-clear"></i>
                    </a>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content">
                    {{@$home_page->about_content }}
                </div>
            </div>
            <!-- /About -->

            @if(!empty($topics))
                @foreach($topics as $topic)
                    <?php $class =  Lang::get('main.'.$topic->type.'_class'); ?>
                    <div class="{{$class}}">
                        <h5>{{ $topic->title }}</h5>
                        {{ $topic->content }}


                    </div>

                @endforeach
                    <?php echo $topics->links(); ?>

            @endif

        </div>

        <div class="col s12 l3">
            @include('include.messages')

            <p></p>
            <!-- clender -->
            <div class="card">
                <div class="title">
                    <h5><i class="fa fa-user"></i>
                        التقويم
                    </h5>
                    <a class="close" href="#">
                        <i class="mdi-content-clear"></i>
                    </a>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content">
                    <script type="text/javascript" src="http://100widgets.com/js_data.php?id=105"></script>
                </div>
            </div>
            <!-- /clender -->
            <p></p>
            <!-- clender -->
            <div class="card">
                <div class="title">
                    <h5><i class="fa fa-user"></i>
الساعة
                    </h5>
                    <a class="close" href="#">
                        <i class="mdi-content-clear"></i>
                    </a>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content">
                    <script type="text/javascript" src="http://100widgets.com/js_data.php?id=27"></script>            <!-- /clender -->

            <p></p>
                </div>
            </div>
            <!-- Send Message -->
            <div class="card">
                <div class="title">
                    <h5><i class="fa fa-user"></i>
إرسال رسالة
                    </h5>
                    <a class="close" href="#">
                        <i class="mdi-content-clear"></i>
                    </a>
                    <a class="minimize" href="#">
                        <i class="mdi-navigation-expand-less"></i>
                    </a>
                </div>
                <div class="content">
                {{ Form::open(array('route'=>'sendMailForAdmin')) }}
                    <div class="input-field">
                            <textarea id="textarea1" class="materialize-textarea" name="message"></textarea>
                            <label for="textarea1">
                                إرسال رسالة الى مدير الموقع

                            </label>
                        </div>
                        <button type="submit" class="btn">إرسال</button>
                    {{ Form::close('') }}
                </div>
            </div>
            <!-- /Send Message -->
            <p></p>





    </section>
@stop