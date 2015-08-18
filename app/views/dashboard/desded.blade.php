@extends('dashboard.main')
@section('content')

    @if(Route::currentRouteName() == 'addDesded')
        {{ Form::open(array('route'=>array('storeDesded'))) }}
    @elseif(Route::currentRouteName() == 'editDesded')
        {{ Form::model($employee,array('route'=>array('updateDesded',$employee->id))) }}
    @endif

    <div class=" card ">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i> اضف بند جدبد  </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field">
                        <i class="fa fa-tag prefix"></i>
                        {{ Form::text('name',null,array('required','id'=>'name',)) }}
                        {{ Form::label('name',  'البند' )     }}
                        <p class="parsley-required">{{ $errors ->first('name') }} </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s8 l4">
                    <div class="input-field">
                        <i class="fa fa-tag prefix"></i>
                        {{ Form::select('ds_type', $ds_type ,null,array('id'=>'ds_type','required')) }}
                        {{ Form::label('ds_type',' نوع البند') }}
                        <p class="parsley-required">{{ $errors ->first('ds_type') }} </p>
                    </div>
                </div>
                <div class="col s2 l1">
                    <div class="input-field">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::radio('ds_cat','ثابت',null,array('id'=>'ds_cat','required')) }}
                        {{ Form::label('ds_cat','ثابت') }}
                        <p class="parsley-required">{{ $errors ->first('ds_cat') }} </p>
                    </div>
                </div>
                <div class="col s2 l2">
                    <div class="input-field">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::radio('ds_cat','متغير',null,array('id'=>'change_cat','required')) }}
                        {{ Form::label('change_cat','متغير') }}

                        <p class="parsley-required">{{ $errors ->first('ds_cat') }} </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 l12">
                    @if(Route::currentRouteName() == 'addDesded')
                        {{--{{Form::submit('  اضف ')}}--}}
                        <button type="submit" class="waves-effect btn">اضف </button>
                    @elseif(Route::currentRouteName() == 'editDesded')
                        {{--{{Form::submit('  تعديل ')}}--}}
                        <button type="submit" class="waves-effect btn">تعديل </button>
                    @endif
                </div>
                {{ Form::close() }}
            </div>{{--submit  row end--}}

        </div>

    </div>
    @include('dashboard.desded_table_view');
    </section>
    @stop

