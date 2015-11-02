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
                @if(PerC::isShow('main_info','cat','edit', "editCategory" )||PerC::isShow('main_info','cat','add', "addCategory" ))
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
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            @endif
                            @if(isset($editCategory->name))
                                @if(PerC::isShow('main_info','cat','edit', "editCategory" ))
                                    <button class="waves-effect btn">@lang('main.edit') </button>
                                @endif
                            @else
                                @if(PerC::isShow('main_info','cat','add', "addCategory" ))
                                    <button class="waves-effect btn">@lang('main.add') </button>
                                @endif

                            {{ Form::close() }}
                        </div>

                    </div>
                @endif
            </div>

                        <br/>
            @if(PerC::isShow('main_info','cat','add_edit_show'))
                                <hr/>
                @include('dashboard.products._table_view')
            @endif
        </div>
    </div>
    <!-- /عرض الفروع -->


</section>
@stop