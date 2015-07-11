     @extends('dashboard.main')
 @section('content')
     <!-- Breadcrumb -->



    <div class="row">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s3"><a href="#products">الاصناف</a></li>
          <li class="tab col s3"><a class="{{ @$catActive }}"   href="#product_cat">فئات الاصناف</a></li>
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