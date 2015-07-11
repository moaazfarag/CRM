@extends('dashboard.main')
@section('content')
    @include('dashboard.product_nav')

    <div id="product_cat" class="col s12">
        <!-- الاصناف  -->
        <div class="card {{ @$seasonMini }}">
            <div class="title">
                <h5>
                    <i class="mdi mdi-notification-event-available"></i> اضف موسم جديدة</h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
            <div class="content">
                {{--{{ dd($editSeason->name) }}--}}
                @if(isset($editSeason->name))
                    {{ Form::model($editSeason,array('route'=>array('updateSeason',$editSeason->id))) }}
                @else
                    {{ Form::open(array('route'=>'storeSeason')) }}
                @endif
                <div class="row no-margin-top">
                    <div class="col s12 l2">
                        <label for="name">
                            اسم  {{@$arabicName}}
                        </label>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="input-field">
                            <i class="mdi mdi-social-person prefix"></i>
                            {{Form::text('name',null,array('required','placeholder'=>"اسم   ". @$arabicName,'id'=>'name')) }}
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

                        @if(isset($editSeason->name))
                            <button class="waves-effect btn">تعديل </button>
                        @else
                            <button class="waves-effect btn">اضف </button>
                        @endif

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.product_table_view')
    </div>
    <!-- /عرض الفروع -->


    @include('include.search')

    </section>

@stop