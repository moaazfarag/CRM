@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    @if(Route::currentRouteName() == 'addDesded')
        {{ Form::open(array('route'=>array('storeDesded'))) }}
    @elseif(Route::currentRouteName() == 'editDesded')
        {{ Form::model($employee,array('route'=>array('updateDesded',$employee->id))) }}
    @endif
    @if(PerC::isShow('hr','Desdeds','edit','editDesded')||PerC::isShow('hr','Desdeds','add','addDesded'))
    <div class=" card ">
        <div class="title">
            <h5>

                <i class="fa fa-cog"></i> @lang('main.add_new_clause') </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">
            @include('include.messages')

            <div class="row">
                <div class="col s12 l3 ">
                    <div class="input-field">
                        <i class="mdi mdi-action-description prefix"></i>
                        {{ Form::text('name',null,array('required','id'=>'name',)) }}
                        {{ Form::label('name',Lang::get("main.clause") )}}
                        <p class="parsley-required error-validation">{{ $errors ->first('name') }} </p>
                    </div>
                </div>
                <div class="col s12 l3">
                    <div class="input-field">
                        {{ Form::select('ds_type', $ds_type ,null,array('id'=>'ds_type')) }}

                        <p class="parsley-required error-validation">{{ $errors ->first('ds_type') }} </p>
                    </div>
                </div>
                <div class="col s12 l1">
                    <div class="input-field">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::radio('ds_cat',lang::get('main.fixed'),null,array('id'=>'ds_cat')) }}
                        {{ Form::label('ds_cat',lang::get('main.fixed')) }}
                    </div>

                </div>
                <div class="col s12 l1">
                    <div class="input-field">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::radio('ds_cat',lang::get('main.variable'),null,array('id'=>'change_cat')) }}
                        {{ Form::label('change_cat',lang::get('main.variable')) }}

                    </div>

                </div>

                <div class="col s12 l2">
                   <div class="input-field">
                    <p class="parsley-required error-validation">{{ $errors ->first('ds_cat') }} </p>
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l12">
                    @if(Route::currentRouteName() == 'addDesded')
                        {{--{{Form::submit('  اضف ')}}--}}
                        <button type="submit" class="waves-effect btn">@lang('main.add') </button>
                    @elseif(Route::currentRouteName() == 'editDesded')
                        {{--{{Form::submit('  تعديل ')}}--}}
                        <button type="submit" class="waves-effect btn">@lang('main.edit') </button>
                    @endif
                </div>
                {{ Form::close() }}

            </div>{{--submit  row end--}}
            <br/>

        </div>

    </div>
    @endif
    @if(PerC::isShow('hr','Desdeds','add_show_edit'))
<br>
        @include('dashboard.hr.deduction._table_view');
    @endif
    </section>
    @stop

