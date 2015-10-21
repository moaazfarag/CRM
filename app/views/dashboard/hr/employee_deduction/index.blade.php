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
    <div class="card">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i> @lang('main.employee_debt_clause') </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>

        <div class="content">
            @include('include.messages')


            <div class="row">
            <div class="col s12 l4">
                {{--<i class="fa fa-tag prefix"></i>--}}
                <div class="input-field">
                    {{ Form::label('employee_id',' ') }}
                    <?php $select_employee =  Lang::get('main.select_employee'); ?>
                    {{ Form::select('employee_id', array(NULL => $select_employee ) +$co_info->employees->lists('name','id'),null,array('id'=>'employee_id')) }}
                    <p class="parsley-required error-validation">{{ $errors ->first('employee_id') }} </p>
                </div>
            </div>
        <div class="col s2 l4">
            {{--<i class="fa fa-tag prefix"></i>--}}
            <div class="input-field">
                {{ Form::label('ds_id',' ') }}
                <?php $debt_credit_clause =  Lang::get('main.debt_credit_clause'); ?>
                <?php $fixed = Lang::get('main.fixed')?>
                {{ Form::select('ds_id', array(NULL => $debt_credit_clause ) +$deduction->where('ds_cat',$fixed)->lists('name','id'),null,array('id'=>'ds_id')) }}
                <p class="parsley-required error-validation">{{ $errors ->first('ds_id') }} </p>
            </div>
        </div>
            <div class="col s12 l3">
                <div class="input-field">
                    <i class="mdi mdi-action-language prefix"></i>
                    {{ Form::number('val',null,array('id'=>'val','step'=>'0.01')) }}
                    <?php $value =  Lang::get('main.value'); ?>
                    {{ Form::label('val', $value)}}
                    <p class="parsley-required error-validation">{{ $errors ->first('val') }} </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l12">

                @if(Route::currentRouteName() == 'addEmpdesded')
                    {{--{{Form::submit('  اضف ')}}--}}
                    <button type="submit" class="waves-effect btn"> @lang('main.add') </button>
                @elseif(Route::currentRouteName() == 'editEmpdesded')
                    {{--{{Form::submit('  تعديل ')}}--}}
                    <button type="submit" class="waves-effect btn">@lang('main.edit') </button>
                @endif
            </div>
            {{ Form::close() }}
        </div>{{--submit  row end--}}
          <br/>
            <hr/>
        </div>
    </div>
    @include('dashboard.hr.employee_deduction._table_view');
   </section>
    @stop