@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">

    <div id="product_cat" class="col s12">
        <!-- الاصناف  -->
        <div class="card {{ @$modelMini }}">
            <div class="title">
                <h5>
                    <i class="mdi mdi-notification-event-available"></i> @lang('main.addNewModel')  </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
            <div class="content">
                @include('include.messages')
                @if(PerC::isShow('main_info','mark_model','edit', "editModel" )||PerC::isShow('main_info','mark_model','add', "addModel" ))
                @if(isset($editModel->name))
                    {{ Form::model($editModel,array('route'=>array('updateModel',$editModel->id))) }}
                @else
                    {{ Form::open(array('route'=>'storeModel')) }}
                @endif
                <div class="row no-margin-top">
                    <div class="col s12 l2">
                        <label for="name">
                            اسم {{Lang::get('main.model')}}
                        </label>

                    </div>
                    <div class="col s12 m6 l6">
                        <div class="input-field">
                            <i class="mdi mdi-social-person prefix"></i>
                            {{Form::text('name',null,array('data-parsley-id'=>'4370','class'=>($errors->first('name'))?'parsley-error':null,'required','placeholder'=>"اسم   ". Lang::get('main.model'),'id'=>'name')) }}
                            {{--<input value="{{ null }}" name="cat_name" id="cat-name" type="text" placeholder="اسم  {{@$arabicName}}">--}}
                        </div>
                    </div>

                </div>

                <div class="row no-margin-top">

                    <div class="col s12 l2">
                        <label for="mark_id">
                            {{Lang::get('main.select_mark')}}
                        </label>

                    </div>
                    <div class="col s12 l2">

                        {{ Form::select('marks_id', array('' => 'أختر الماركة') + $co_info->marks->lists('name','id'),null,array('id'=>'mark_id')) }}

                    </div>
                </div>
                <div class="row">
                    <div class="col s12 l12">

                        @if(isset($editModel->name))
                            <button class="waves-effect btn">@lang('main.edit') </button>
                        @else
                            <button class="waves-effect btn">@lang('main.add') </button>
                        @endif

                        {{ Form::close() }}
                       <br/>
                        <hr/>
                    </div>
                </div>
                                @endif
            </div>
                        <br/>
                                    @if(PerC::isShow('main_info','mark_model','add_edit_show'))
                                                        <hr/>
            @include('dashboard.products._table_view')
                                    @endif
        </div>
    </div>
    <!-- /عرض الفروع -->




    </section>
@stop