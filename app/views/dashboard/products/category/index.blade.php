@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
<div id="product_cat" class="col s12">
 <!-- الاصناف  -->
        <div class="card {{ @$categoryMini }}">
          <div class="title">
            <h5>
                <i class="mdi mdi-notification-event-available"></i> @lang('main.addNewItem')  </h5>
            <a class="minimize" href="#">
              <i class="mdi-navigation-expand-less"></i>
            </a>
          </div>
          <div class="content">
              @include('include.messages')

          @if(isset($editCategory->name))
                {{ Form::model($editCategory,array('route'=>array('updateCategory',$editCategory->id))) }}
              @else
                {{ Form::open(array('route'=>'storeCategory')) }}
              @endif
        <div class="row no-margin-top">
          <div class="col s12 l2">
            <label for="name">
                اسم الفئة
            </label>
          </div>
          <div class="col s12 m6 l6">
            <div class="input-field">
              <i class="mdi mdi-social-person prefix"></i>

                {{Form::text('name',null,array('required','placeholder'=>'اسم الفئة', 'id'=>'name')) }}
                  {{--<input value="{{ null }}" name="cat_name" id="cat-name" type="text" placeholder="اسم  {{@$arabicName}}">--}}
            </div>
          </div>
        </div>
                  <div class="input-field">
                  {{--<p>--}}
                  {{--<label for="cat_name">ادخال المورد اجباري عند تعريف الصنف </label>--}}
                  {{--{{ Form::checkbox('cat_name', 1,null,array('id'=>'cat_name')) }}--}}
                  {{--</p>--}}
</div>
                  <div class="row">
                    <div class="col s12 l12">

                        @if(isset($editCategory->name))
                            <button class="waves-effect btn">@lang('main.edit') </button>
                        @else
                            <button class="waves-effect btn">@lang('main.add') </button>
                        @endif

                        {{ Form::close() }}
                    </div>
                      <br/>
                      <br/>
                      <hr/>
                </div>
                </div>




                  @include('dashboard.products._table_view')
        </div>
</div>
        <!-- /عرض الفروع -->




</section>
@stop