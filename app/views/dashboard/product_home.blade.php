     @extends('dashboard.main')
 @section('content')
     <!-- Breadcrumb -->
     <div class="ecommerce-title">

       <div class="row">
         <div class="col s12 m9 l10">
           <!--h1>@@title</h1-->
           <nav>
             <ul class="left">
             <li>
             <a href="/admin/hr">شئون العاملين </a>
             </li>
            <li>
            <a href="/admin/accounts">الحسابات </a>
            </li>
               <li class="active" >
               <a href="/admin/product">الاصناف </a>
               </li>
               <li  >
               <a href="/admin/setting">بيانات الموقع</a>
               </li>
                <li>
               <a href="/admin">الرئيسية</a>
               </li>
             </ul>
           </nav>
         </div>

       </div>

     </div>
     <!-- /Breadcrumb -->


    <div class="row">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s3"><a href="#products">الاصناف</a></li>
          <li class="tab col s3"><a class="active"   href="#product_cat">فئات الاصناف</a></li>
          <li class="tab col s3"><a  href="#product_trademark">الماركات</a></li>
          <li class="tab col s3"><a href="#product_models">المودلايات</a></li>
          <li class="tab col s3"><a href="#product_seasons"> المواسم</a></li>
        </ul>
      </div>

            {{--الاصناف--}}
            @include('dashboard.products')
                     {{--فئات الاصناف--}}
            @include('dashboard.product_cat')
              {{--الماركات--}}
            @include('dashboard.product_trademark')
              {{--الموديلات--}}
            @include('dashboard.product_models')
                {{--المواسم--}}
            @include('dashboard.product_seasons')


    </div>



  </section>
  <!-- /Main Content -->

@include('include.search')


  @stop