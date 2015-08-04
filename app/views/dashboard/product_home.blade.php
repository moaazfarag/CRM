     @extends('dashboard.main')
 @section('content')
     <!-- Breadcrumb -->



    <div class="row">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s3"><a href="#products">@lang('main.items')</a></li>
          <li class="tab col s3"><a class="{{ @$catActive }}"   href="#product_cat">@lang('main.itemCat') </a></li>
          <li class="tab col s3"><a  href="#product_trademark">@lang('main.tradMark')</a></li>
          <li class="tab col s3"><a href="#product_models">@lang('main.modelat')</a></li>
          <li class="tab col s3"><a href="#product_seasons"> @lang('main.seasons')</a></li>
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