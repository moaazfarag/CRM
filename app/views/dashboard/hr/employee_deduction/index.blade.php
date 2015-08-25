@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    @if(Route::currentRouteName() == 'addEmpdesded')
        {{ Form::open(array('route'=>array('storeEmpdesded'))) }}
    @elseif(Route::currentRouteName() == 'editEmpdesded')
        {{ Form::model($employee,array('route'=>array('updateEmpdesded',$employee->id))) }}
    @endif
    {{--{{ Form::model($employee,array('route'=>array('updateEmp',1))) }}--}}
    <div class=" card ">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i> بنود استحقاقات الموظف </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="row">
            <div class="col s12 l4">
                {{--<i class="fa fa-tag prefix"></i>--}}
                <div class="input-field">
                    {{ Form::label('employee_id',' ') }}
                    {{ Form::select('employee_id', array(NULL => 'اختار الموظف ') +$co_info->employees->lists('name','id'),null,array('id'=>'employee_id','required')) }}
                    <p class="parsley-required">{{ $errors ->first('employee_id') }} </p>
                </div>
            </div>
        <div class="col s2 l4">
            {{--<i class="fa fa-tag prefix"></i>--}}
            <div class="input-field">
                {{ Form::label('ds_id',' ') }}
                {{ Form::select('ds_id', array(NULL => '             بنود الاستحقاق والاستقطاع') +$deduction->where('ds_cat','ثابت')->lists('name','id'),null,array('id'=>'ds_id','required')) }}
                <p class="parsley-required">{{ $errors ->first('ds_id') }} </p>
            </div>
        </div>
            <div class="col s12 l3">
                <div class="input-field">
                    <i class="mdi mdi-action-language prefix"></i>
                    {{ Form::number('val',null,array('required','id'=>'val',)) }}
                    {{ Form::label('val',  'القيمه' )     }}
                    <p class="parsley-required">{{ $errors ->first('val') }} </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l12">
                @if(Route::currentRouteName() == 'addEmpdesded')
                    {{--{{Form::submit('  اضف ')}}--}}
                    <button type="submit" class="waves-effect btn">اضف </button>
                @elseif(Route::currentRouteName() == 'editEmpdesded')
                    {{--{{Form::submit('  تعديل ')}}--}}
                    <button type="submit" class="waves-effect btn">تعديل </button>
                @endif
            </div>
            {{ Form::close() }}
        </div>{{--submit  row end--}}

    </div>
    @include('dashboard.hr.employee_deduction._table_view');
   </section>
    @stop