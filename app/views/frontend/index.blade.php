<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>الراصد لإدارة المحلات والشركات</title>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

    <!-- CSS
    ================================================== -->
    {{ HTML::style('frontend/css/bootstrap.min.css') }}
    {{ HTML::style('frontend/css/font-awesome.min.css') }}
    {{ HTML::style('frontend/css/superslides.css') }}
    {{ HTML::style('frontend/css/slick.css') }}
    {{ HTML::style('frontend/css/animate.css') }}
    {{ HTML::style('frontend/css/elastic_grid.css') }}
    {{ HTML::style('frontend/css/themes/default-theme.css') }}
    <link rel='stylesheet prefetch' href='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/css/jquery.circliful.css'>

    {{ HTML::style('frontend/css/style.css') }}
    {{ HTML::script('frontend/js/maxcdn.js') }}
    {{ HTML::script('frontend/js/respond.js') }}

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Varela' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

<style>
    #status {
        width:200px;
        height:200px;
        position:absolute;
        left:50%; /* centers the loading animation horizontally one the screen */
        top:50%; /* centers the loading animation vertically one the screen */
        background-image:url({{ URL::asset('frontend/img/status.gif') }}); /* path to your loading animation */
        background-repeat:no-repeat;
        background-position:center;
        margin:-100px 0 0 -100px; /* is width and height divided by two */
    }
</style>
</head>
<body>
<!-- BEGAIN PRELOADER -->
{{--<div id="preloader">--}}
{{--<div id="status">&nbsp;</div>--}}
{{--</div>--}}
<!-- END PRELOADER -->

<!-- SCROLL TOP BUTTON -->
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<!-- END SCROLL TOP BUTTON -->

<!--=========== BEGIN HEADER SECTION ================-->
<header id="header">
    <!-- BEGIN MENU -->
    <div class="menu_area">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- LOGO -->

                    <!-- TEXT BASED LOGO -->
                    <a class="navbar-brand" href="#">El<span>rased</span></a>

                    <!-- IMG BASED LOGO  -->
                    {{--<!--  <a class="navbar-brand" href="#"> <img src="{{ URL::asset('frontend/img/logo.png" ')}} alt="logo"></a> -->--}}


                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul id="top-menu" class="nav navbar-nav navbar-right main_nav">
                        <li><a href="{{ URL::route('login') }}">تسجيل الدخول  </a></li>
                        <li><a href="#contact">تواصل معنا </a></li>
                        <li><a href="#clients"> عن الشركة </a></li>
                        <li><a href="{{ URL::route('addNewCompany') }}">سجل شركتك الان</a></li>
                        <li><a href="#pricing">الإشتراك فى الموقع</a></li>
                        <li><a href="#works">شاشات من الموقع</a></li>
                        <li><a href="#service">لماذا موقع الراصد</a></li>
                        <li><a href="#about">موقع الراصد </a></li>
                        <li class="active"><a href="#">الرئيسية</a></li>

                    </ul>

                </div><!--/.nav-collapse -->
            </div>
        </nav>
    </div>
    <!-- END MENU -->

    <!-- BEGIN SLIDER AREA-->
    <div class="slider_area">
        <!-- BEGIN SLIDER-->
        <div id="slides">
            <ul class="slides-container">

                <!-- THE FIRST SLIDE-->
                <li>
                    <!-- FIRST SLIDE OVERLAY -->
                    <div class="slider_overlay"></div>
                    <!-- FIRST SLIDE MAIN IMAGE -->
                     <img src="{{ URL::asset('frontend/img/full-slider/full-slide7.jpg')}}" alt="img">
                    <!-- FIRST SLIDE CAPTION-->
                    <div class="slider_caption">
                        <h2>أهلا بكم </h2>
                        <p>فى موقع الراصد لإدارة الشركات</p>
                        <a href="#" class="slider_btn">Who We are</a>
                    </div>
                </li>

                <!-- THE SECOND SLIDE-->
                <li>
                    <!-- SECOND SLIDE OVERLAY -->
                    <div class="slider_overlay"></div>
                    <!-- SECOND SLIDE MAIN IMAGE -->
                     <img src="{{ URL::asset('frontend/img/full-slider/full-slide1.jpg')}}" alt="img">
                    <!-- SECOND SLIDE CAPTION-->
                    <div class="slider_caption">
                        <h2>الحسابات</h2>
                        <p>نظام حسابات متكامل لإدارة حسابات الشركة </p>
                        <a href="#" class="slider_btn">Who We are</a>
                    </div>
                </li>

                <!-- THE THIRD SLIDE-->
                <li>
                    <!-- THIRD SLIDE OVERLAY -->
                    <div class="slider_overlay"></div>
                    <!-- THIRD SLIDE MAIN IMAGE -->
                     <img src="{{ URL::asset('frontend/img/full-slider/full-slide2.jpg')}}" alt="img">
                    <!-- THIRD SLIDE CAPTION-->
                    <div class="slider_caption">
                        <h2>شئون الموظفين</h2>
                        <p>نظام  لحساب كل ما يخص موظفين الشركة</p>
                        <a href="#" class="slider_btn">Who We are</a>
                    </div>
                </li>
            </ul>
            <!-- BEGAIN SLIDER NAVIGATION -->
            <nav class="slides-navigation">
                <!-- PREV IN THE SLIDE -->
                <a class="prev" href="/item1">
                    <span class="icon-wrap"></span>
                    <h3><strong>Prev</strong></h3>
                </a>
                <!-- NEXT IN THE SLIDE -->
                <a class="next" href="/item3">
                    <span class="icon-wrap"></span>
                    <h3><strong>Next</strong></h3>
                </a>
            </nav>
        </div>
        <!-- END SLIDER-->
    </div>
    <!-- END SLIDER AREA -->
</header>
<!--=========== End HEADER SECTION ================-->


<!--=========== BEGIN ABOUT SECTION ================-->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="about_area">
                    <!-- START ABOUT HEADING -->
                    <div class="heading">
                        <h2 class="wow fadeInRightBig">موقع الراصد لإدارة المحلات والشركات</h2>

                    </div>

                    <!-- START ABOUT CONTENT -->
                    <div class="about_content">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="about_slider">
                                    <!-- BEGAIN FEATURED SLIDER -->
                                    <div class="featured_slider">
                                        <!-- SINGLE SLIDE IN THE SLIDER -->
                                        <div class="single_iteam">
                                            <a href="#">  <img src="{{ URL::asset('frontend/img/rsz_feature_img1.jpg')}}" alt="img"></a>
                                        </div>
                                        <!-- SINGLE SLIDE IN THE SLIDER -->
                                        <div class="single_iteam">
                                            <a href="#">  <img src="{{ URL::asset('frontend/img/rsz_feature_img2.jpg')}}" alt="img"></a>
                                        </div>
                                        <!-- SINGLE SLIDE IN THE SLIDER -->
                                        <div class="single_iteam">
                                            <a href="#">  <img src="{{ URL::asset('frontend/img/rsz_feature_img3.jpg')}}" alt="img"></a>
                                        </div>
                                        <!-- SINGLE SLIDE IN THE SLIDER -->
                                        <div class="single_iteam">
                                            <a href="#">  <img src="{{ URL::asset('frontend/img/rsz_feature_img4.jpg')}}" alt="img"></a>
                                        </div>
                                        <!-- SINGLE SLIDE IN THE SLIDER -->

                                    </div>
                                    <!-- END FEATURED SLIDER -->
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="about_featured">
                                    <div class="panel-group" id="accordion">
                                        <!-- START SINGLE FEATURED ITEAM #1-->
                                        <div class="panel panel-default wow fadeInRight">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                        <span class="fa fa-check-square-o"></span>
                                                        نظام حسابات متكامل لإدارة الحسابات
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    يوجد بالموقع قائمة خاصة بإدارة الحسابات يمكنك متابعة يومية الخزينة وتسجيل الحركات المباشرة ومتابعة حسابات العملاء والموردين والشركاء وحسابات المصروفات والإيرادات الأخرى
                                                </div>
                                            </div>
                                            <!-- START SINGLE FEATURED ITEAM #2 -->
                                            <div class="panel panel-default wow fadeInLeft">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                            <span class="fa fa-check-square-o"></span>
                                                            نظام لشئون الموظفين لحساب كل ما يخص الموظف
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        قائمة خاصة بشئون الموظفين والعاملين بالمؤسسة شاملة القسم والوظيفة والراتب الأساسى وبنود الراتب
                                                        <br/>
                                                        تسجيل وحساب جميع المتغيرات التى تطرأ على راتب أى موظف من استحقاقات وإستقطاعات ثابتة ومتغيرة
                                                        <br/>
                                                        تجهيز وطباعة المرتبات الشهرية للموظفين
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- START SINGLE FEATURED ITEAM #3 -->
                                            <div class="panel panel-default wow fadeInLeft">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                            <span class="fa fa-check-square-o"></span>
                                                            نظام للمخازن وطباعة فواتير البيع والشراء والباركود
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseThree" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        أدارة كاملة لكل مخازن المؤسسة حيث يمكنكم تسجيل جميع فئات الأصناف والماركات والموديلات والأصناف والمواسم التى تخص منتجاتكم
                                                        <br/>
                                                        ثم بعد ذلك ادخال الأرصدة الإفتتاحية وعندها بإستطاعتكم عمل حركات البيع والشراء وإستخراج الفواتير وطباعة الباركود
                                                        <br/>
                                                        ويمكنكم أيضاً  أدخال تسويات الإضافة والخصم
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- START SINGLE FEATURED ITEAM #4 -->
                                            <div class="panel panel-default wow fadeInLeft">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                                            <span class="fa fa-check-square-o"></span>
                                                            ﻗﺎﺋﻤﺔ راﺋﻌﺔ ﻣﻦ اﻟﺘﻘﺎرﯾﺮ التى تخدم أدارة المؤسسة
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseFour" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        يمكنكم استخراج التقارير الإجمالية والتحليلية  عن المرتبات المنصرفة وعن   المخازن والحسابات والفواتير كل ذلك وأكثر فى موقعكم  الراصد                            </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=========== END ABOUT SECTION ================-->

<!--=========== BEGIN SERVICE SECTION ================-->
<section id="service">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- BEGAIN SERVICE HEADING -->
                <div class="heading">
                    <h2 class="wow fadeInLeftBig">لماذا ( موقع الراصد ) !!؟</h2>

                </div>
            </div>
        </div>
        <div class="row">
            <style>
                .service_area p{
                    text-align: center;
                    font-size: 1.2em;
                    font-weight: 600;
                }
                #our_services li{
                    font-size: 1.2em;
                    font-weight: 600;
                    list-style: circle ;
                    direction: rtl;
                }

            </style>
            <div class="col-lg-12 col-md-12">
                <!-- BEGAIN SERVICE  -->
                <div class="service_area">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <!--     BEGAIN SINGLE SERVICE -->
                            <div class="single_service wow fadeInLeft">
                                <div class="service_iconarea">
                                     <img src="{{ URL::asset('frontend/img/icon_6.png" style="width:150px; height:150px')}}" alt="img">
                                </div>
                                <h3 class="service_title">التجاوب</h3>
                                <p style="text-align: center;">
                                    الموقع متجاوب مع جميع الشاشات
                                    <br/>
                                    ( الكمبيوتر - التابلت - الموبايل)
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <!-- BEGAIN SINGLE SERVICE -->
                            <div class="single_service wow fadeInRight">
                                <div class="service_iconarea">
                                     <img src="{{ URL::asset('frontend/img/icon_5.png" style="width:150px; height:150px')}}" alt="img">
                                </div>
                                <h3 class="service_title">الطباعة وإستخراج التقارير</h3>
                                <p>
                                    يمكنكم طباعة  التقارير عن حركات البيع وأرباح المؤسسة والمرتبات المنصرفة
                                    لمساعدة المديرين فى إتخاذ القارات
                                    بناء على معلومات دقيقة
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <!-- BEGAIN SINGLE SERVICE -->
                            <div class="single_service wow fadeInLeft">
                                <div class="service_iconarea">
                                     <img src="{{ URL::asset('frontend/img/icon_4.png" style="width:150px; height:150px')}}" alt="img">
                                </div>
                                <h3 class="service_title">سرية وأمن البيانات </h3>
                                <p>
                                    البيانات مؤمنة بالكامل حيث لا يسمح بالدخول للبيانات الا بكتابة اسم المستخدم وكلمة المرور
                                    بشكل صحيح

                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <!-- BEGAIN SINGLE SERVICE -->
                            <div class="single_service wow fadeInRight">
                                <div class="service_iconarea">
                                     <img src="{{ URL::asset('frontend/img/icon_3.png" style="width:150px; height:150px')}}" alt="img">
                                </div>
                                <h3 class="service_title">خدمة ما بعد البيع </h3>
                                <p>
                                    لدينا فريق من المبرمجين والدعم الفنى للرد على تساؤلاتكم واقتراحاتكم وحل المشاكل التى تواجهكم
                                    كما أن الفريق يعمل على تطوير الموقع بإستمرارية ليتناسب مع طموحاتكم
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <!-- BEGAIN SINGLE SERVICE -->
                            <div class="single_service wow fadeInLeft">
                                <div class="service_iconarea">
                                     <img src="{{ URL::asset('frontend/img/icon_2.png" style="width:150px; height:150px')}}" alt="img">
                                </div>
                                <h3 class="service_title">مستخدمين النظام</h3>
                                <p>
                                    يمكنكم إضافة عدد لا نهائى من المستخدمين
                                    بدون أى تكاليف إضافية
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <!-- BEGAIN SINGLE SERVICE -->
                            <div class="single_service wow fadeInRight">
                                <div class="service_iconarea">
                                     <img src="{{ URL::asset('frontend/img/icon_1.png" style="width:150px; height:150px')}}" alt="img">
                                </div>
                                <h3 class="service_title">صلاحيات المستخدمين</h3>
                                <p>
                                    يمكنكم التحكم فى صلاحيات كل مستخدم
                                    من  ( استعراض-إضافة- تعديل- حذف ) البيانات
                                    بحيث لا يمكن لمستخدم التحكم فى أى بيانات غير التى خصصت له
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=========== END SERVICE SECTION ================-->

<!--=========== BEGAIN WORKS SECTION ================-->
<section id="works">


    <!-- BEGAIN FORTFOLIO WORSK SECTION -->
    <div class="row">
        <div class="portfolio_area">
            <!-- BEGAIN PORTFOLIO HEADER -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="container">
                        <div class="heading">
                            <style>
                                .heading p{
                                    font-size: 1.4em;
                                }

                            </style>
                            <h2 class="wow fadeInLeftBig">شاشات الموقع </h2>
                            <p>
                                إليكم بعض شاشات الموقع
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PORTFOLIO HEADER -->

            <!-- BEGAIN PORTFOLIO GALLERY -->
            <div class="row">
                <div class="portfolio_gallery">
                    <div id="elastic_grid_demo"></div>
                </div>
            </div>
            <!-- END PORTFOLIO GALLERY -->
        </div>
    </div>
    <!-- END FORTFOLIO WORSK SECTION -->
</section>
<!--=========== END WORKS SECTION ================-->



<!--=========== BEGAIN PRICING SECTION ================-->
<section id="pricing">
    <div class="container">
        <div class="row col-lg-12 col-md-12">
            <!-- START ABOUT HEADING -->
            <div class="heading">
                <h2 class="wow fadeInLeftBig">الإشتراك فى موقع الراصد</h2>
                <p>
                    قيمة الإشتراك  فى موقع الراصد لإدارة المحلات والشركات
                    هى 400 جنية مصرى سنوياً فقط لا غير

                </p>
            </div>
        </div>
    </div>
</section>
<!--=========== END PRICING SECTION ================-->

<!--=========== BEGAIN WE ARE SECTION ================-->
<section id="clients">
    <div class="container">
        <div class="row col-lg-12 col-md-12">
            <!-- START ABOUT HEADING -->
            <div class="heading">
                <h2 class="wow fadeInLeftBig">شركة كليك فور داتا</h2>
              <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="about_slider">
                          <!-- BEGAIN FEATURED SLIDER -->
                          <div class="featured_slider">
                              <!-- SINGLE SLIDE IN THE SLIDER -->
                              <div class="single_iteam">
                                  <a href="#">  <img src="{{ URL::asset('frontend/img/we_are1.jpg')}}" alt="img"></a>
                              </div>
                              <!-- SINGLE SLIDE IN THE SLIDER -->
                              <div class="single_iteam">
                                  <a href="#">  <img src="{{ URL::asset('frontend/img/we_are2.jpg')}}" alt="img"></a>
                              </div>
                              <!-- SINGLE SLIDE IN THE SLIDER -->
                              <div class="single_iteam">
                                  <a href="#">  <img src="{{ URL::asset('frontend/img/we_are3.jpg')}}" alt="img"></a>
                              </div>
                              <!-- SINGLE SLIDE IN THE SLIDER -->
                              <div class="single_iteam">
                                  <a href="#">  <img src="{{ URL::asset('frontend/img/we_are4.jpg')}}" alt="img"></a>
                              </div>
                              <!-- SINGLE SLIDE IN THE SLIDER -->

                          </div>
                          <!-- END FEATURED SLIDER -->
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                      <p>

                          تتحدد مهمة شركة
                           <span style="color: #1157aa">
كليك فور داتا
 </span>



                          في توظيف خبرتها الشاملة في مجال تكنولوجيا المعلومات لتقديم مستوى عملي حقيقي يمكن عملائها من الاستفادة الفعالة من تكنولوجيا العصر،
                          ونبذل قصارى جهدنا لبناء علاقات راسخة مبنية على الاحترام والثقة المتبادلة مع زبائننا
                      </p>
                      <h3>
                          خدماتنا
                      </h3>
                      <p style="width:100%">
                      <ul id="our_services">
                          <li>ادارة توفير الموارد البشرية</li>
                          <li>ادارة البرمجيات.</li>
                          <li>تصميم المواقع</li>
                          <li>أنظمة مراقبة</li>
                          <li>خدمات الانترنت</li>
                      </ul>
                      </p>

                  </div>

                  </div>

            </div>
        </div>
    </div>
</section>
<!--=========== END PRICING SECTION ================-->




<!--=========== BEGAIN CLIENTS SECTION ================-->
<section id="clients_2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <!-- START BLOG HEADING -->
                <div class="heading">
                    <h2 class="wow fadeInLeftBig">عملائنا </h2>

                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="clients_content">
                    <div class="row">
                        <!-- BEGAIN CLIENTS SLIDER -->
                        <div class="clients_slider">
                            <!-- BEGAIN SINGLE CLIENT SLIDE#1 -->
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="single_client">
                                     <img src="{{ URL::asset('frontend/img/clients_img1.jpg')}}" alt="clients Brand">
                                </div>
                            </div>
                            <!-- BEGAIN SINGLE CLIENT SLIDE#2 -->
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="single_client">
                                     <img src="{{ URL::asset('frontend/img/clients_img2.jpg')}}" alt="clients Brand">
                                </div>
                            </div>
                            <!-- BEGAIN SINGLE CLIENT SLIDE#3 -->
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="single_client">
                                     <img src="{{ URL::asset('frontend/img/clients_img4.jpg')}}" alt="clients Brand">
                                </div>
                            </div>
                            <!-- BEGAIN SINGLE CLIENT SLIDE#4 -->
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="single_client">
                                     <img src="{{ URL::asset('frontend/img/clients_img3.jpg')}}" alt="clients Brand">
                                </div>
                            </div>
                            <!-- BEGAIN SINGLE CLIENT SLIDE#5 -->
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="single_client">
                                     <img src="{{ URL::asset('frontend/img/clients_img4.jpg')}}" alt="clients Brand">
                                </div>
                            </div>
                            <!-- BEGAIN SINGLE CLIENT SLIDE#6 -->
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="single_client">
                                     <img src="{{ URL::asset('frontend/img/clients_img5.jpg')}}" alt="clients Brand">
                                </div>
                            </div>
                            <!-- BEGAIN SINGLE CLIENT SLIDE#7 -->
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="single_client">
                                     <img src="{{ URL::asset('frontend/img/clients_img1.jpg')}}" alt="clients Brand">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=========== END CLIENTS SECTION ================-->

<!--=========== BEGAIN CONTACT SECTION ================-->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <!-- START CONTACT HEADING -->
                <div class="heading">
                    <h2 class="wow fadeInLeftBig"> أتصل بنا </h2>
                    <p>
                        يسعدنا تلقى رسائلكم وإقتراحاتكم
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- BEGAIN CONTACT CONTENT -->
            <div class="contact_content">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="" style="overflow: hidden; padding:auto 5%;   ">
                      <div style="width:90%">

                          <script type="text/javascript" src="http://www.webestools.com/google_map_gen.js?lati=30.125623&long=31.376985&zoom=19&width=600&height=400&mapType=normal&map_btn_normal=yes&map_btn_satelite=yes&map_btn_mixte=yes&map_small=yes&marqueur=yes&info_bulle="></script><br /><a href="http://www.webestools.com/google-maps-code-generator-insert-map-on-website-javascript-free-google-map-script.html"></a>                    </div>
                    </div>
                </div>
                <!-- BEGAIN CONTACT FORM -->
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="contact_form">

                        <!-- FOR CONTACT FORM MESSAGE -->
                        <div id="form-messages"></div>

                        <form dir="rtl">
                            <input class="form-control" type="text" placeholder="الأسم">
                            <input class="form-control" type="email" placeholder="البريد الألكترونى">
                            <input class="form-control" type="text" placeholder=" عنوان الرسالة">
                            <textarea class="form-control" cols="30" rows="10" placeholder="رسالتك"></textarea>
                            <input class="submit_btn" type="submit" value="إرسال">
                        </form>
                    </div>
                </div>
                <!-- BEGAIN CONTACT MAP -->

            </div>
        </div>
    </div>
</section>
<!--=========== END CONTACT SECTION ================-->

<!--=========== BEGAIN CONTACT FEATURE SECTION ================-->
<section id="contactFeature">
    <!-- SKILLS COUNTER OVERLAY -->
    <div class="slider_overlay" style="background-image: url({{ URL::asset('frontend/img/contact-feature-bg.png') }})"></div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="container">
                <div class="contact_feature">
                    <!-- BEGAIN CALL US FEATURE -->
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="single_contact_feaured wow fadeInUp">
                            <i class="fa fa-phone"></i>
                            <h4>اتصل بنا</h4>
                            <p>1-265-596-580</p>
                            <br/>

                        </div>
                    </div>
                    <!-- BEGAIN CALL US FEATURE -->
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="single_contact_feaured wow fadeInUp">
                            <i class="fa fa-envelope-o"></i>
                            <h4>راسلنا على هذا الايميل</h4>
                            <p>share@clickfordata.net</p>
                            <br/>
                        </div>
                    </div>
                    <!-- BEGAIN CALL US FEATURE -->
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="single_contact_feaured wow fadeInUp">
                            <i class="fa fa-map-marker"></i>
                            <h4> عنوان الشركة </h4>
                            <p>شارع المدينه المنوره رقم 7 الدور الـ 5 شقه 11 خلف بى تيك المطار </p>
                        </div>
                    </div>
                    <!-- BEGAIN CALL US FEATURE -->
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="single_contact_feaured wow fadeInUp">
                            <i class="fa fa-clock-o"></i>
                            <h4>ساعات العمل</h4>
                            <p>
                                من الساعة 10 صباحاً حتى الساعة 7 مساءً
                                <br/>
                                ما عدا يوم الجمعة
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=========== END CONTACT FEATURE SECTION ================-->

<!--=========== BEGAIN SUBSCRIBE SECTION ================-->
<section id="subscribe">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- START SUBSCRIBE HEADING -->
                <div class="heading">
                    <h2 class="wow fadeInLeftBig">تابعنا </h2>
                    <p>
                        يرجى أدخال بريدك الألكترونى ليصلك كل جديد
                    </p>
                </div>
                <!-- BEGAIN SUBSCRIVE FORM -->
                <form class="subscribe_form" dir="rtl">
                    <div class="subscrive_group wow fadeInUp">
                        <input class="form-control subscribe_mail" type="email" placeholder="أدخل البريد الألكترونى">
                        <input class="subscr_btn" type="submit" value="متابعة">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--=========== END SUBSCRIBE SECTION ================-->

<!--=========== BEGAIN FOOTER ================-->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="footer_left">
                    <!--=========== Designed By WpFreeware Team ================-->
                    <p>Designed By <a href="http://www.clickfordata.net">click for data company</a>.</p>
                    <!--=========== Designed By WpFreeware Team ================-->
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="footer_right">
                    <ul class="social_nav">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--=========== END FOOTER ================-->

<!-- Javascript Files
================================================== -->
{{ HTML::script('frontend/js/ajax.js') }}
{{ HTML::script('frontend/js/map.js') }}
{{ HTML::script('frontend/js/jquery.ui.map.js') }}
{{ HTML::script('frontend/js/wow.min.js') }}
{{ HTML::script('frontend/js/bootstrap.min.js') }}
{{ HTML::script('frontend/js/jquery.superslides.min.js') }}
{{ HTML::script('frontend/js/slick.min.js') }}
{{ HTML::script('frontend/js/circliful.js') }}
{{ HTML::script('frontend/js/modernizr.custom.js') }}
{{ HTML::script('frontend/js/classie.js') }}
{{ HTML::script('frontend/js/elastic_grid.min.js') }}
{{ HTML::script('frontend/js/portfolio_slider.js') }}
{{ HTML::script('frontend/js/custom.js') }}


</body>
</html>