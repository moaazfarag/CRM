@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">

    <div id="product_cat" class="col s12">
        <!-- الاصناف  -->
        <div class="card {{ @$modelMini }}">
            <div class="title">
                <h5>
                    <i class="mdi mdi-notification-event-available"></i> @lang('main.addNewMark')
                </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
            <div class="content">
                @include('include.messages')
                @if(PerC::isShow('main_info','mark_model','edit', "editModel" )||PerC::isShow('main_info','mark_model','add', "addModel" ) || PerC::isShow('main_info','mark_model','edit', "editMark" )||PerC::isShow('main_info','mark_model','add', "addMark" ))
                @if(isset($editMark->name))
                    {{ Form::model($editMark,array('route'=>array('updateMark',$editMark->id))) }}
                    @else
                    {{ Form::open(array('route'=>'storeMark')) }}
                    @endif
                <div class="row no-margin-top">
                    <div class="col s12 l2">
                        <label for="name">
                            اسم {{Lang::get('main.marka')}}
                        </label>

                    </div>
                    <div class="col s12 m6 l6">
                        <div class="input-field">
                            <i class="mdi mdi-social-person prefix"></i>
                            {{Form::text('name',null,array('required','placeholder'=>"اسم   ". Lang::get('main.marka'),'id'=>'name')) }}
                            {{--<input value="{{ null }}" name="cat_name" id="cat-name" type="text" placeholder="اسم  {{@$arabicName}}">--}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l12">

                        @if(isset($editMark->name))
                            <button class="waves-effect btn">@lang('main.edit') </button>
                        @else
                            <button class="waves-effect btn">@lang('main.add') </button>
                        @endif

                        {{ Form::close() }}

                    </div>
                </div>
                                @endif
            </div>
                        <br/>
                        @if(PerC::isShow('main_info','mark_model','show'))
                                            <hr/>
            @include('dashboard.products._table_view')
                        @endif
        </div>
    </div>
    <!-- /عرض الفروع -->
    </section>
@stop