@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    @if(Route::currentRouteName() == 'addMonthChange')
        {{ Form::open(array('route'=>array('storeMonthChange'))) }}
    @elseif(Route::currentRouteName() == 'editMonthChange')
        {{ Form::model($employee,array('route'=>array('updateMonthChange',$employee->id))) }}
    @endif
    <div class=" card ">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i> اضف تغيرات شهريه </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>

        <div class="content">
            <div class="row">

                <div class="col s12 l5">
                    <div class="input-field">
                        {{ Form::label('employee_id',' ') }}
                        {{ Form::select('employee_id', array(NULL => 'الموظف  ') +$co_info->employees->lists('name','id'),null,array('id'=>'employee_id')) }}
                        <p class="parsley-required error-validation">{{ $errors ->first('employee_id') }} </p>
                    </div>
                </div>
                <div class="col s2 l6">
                    {{--<i class="fa fa-tag prefix"></i>--}}
                    <div class="input-field">
                        {{ Form::label('ds_id',' ') }}
                        {{ Form::select('ds_id', array(NULL => 'البنود') +$co_info->desded()->where('ds_cat','متغير')->lists('name','id'),null,array('id'=>'ds_id')) }}
                        <p class="parsley-required error-validation">{{ $errors ->first('ds_id') }} </p>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col  l1">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::label('trans_date','   التاريخ') }}
                    </div>
                </div>
                <div class="col  l2">
                    <div class="input-field">
                        {{ Form::text('trans_date',null,array('id'=>'trans_date','class'=>'pikaday')) }}
                        <p class="parsley-required error-validation">{{ $errors ->first('trans_date') }} </p>
                    </div>
                </div>

                <div class="col  l1">
                    <div class="input-field">

                        {{ Form::label('for_month',' عن شهر ') }}
                    </div>
                </div>

                <div class="col  l3">
                    <div class="input-field">
                        {{ Form::select('for_month', array(NULL => 'أختر الشهر') +BaseController::$months,null,array('id'=>'for_month')) }}
                        <p class="parsley-required error-validation">{{ $errors ->first('for_month') }} </p>


                    </div>
                </div>

                <div class="col  l1 s12">
                    <div class="input-field">
                        {{ Form::label('for_year ',' سنه  ') }}
                    </div>
                </div>

                <div class="col  l3 s12">
                    <div class="input-field">
                        {{ Form::select('for_year', array(NULL => 'أختر السنة ') +BaseController::$years,null,array('id'=>'for_year')) }}
                        <p class="parsley-required error-validation">{{ $errors ->first('for_year') }} </p>

                    </div>
                </div>
            </div>
            <div class="row">

            <div class="col  l2 s12">
                    <div class="input-field">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::radio('day_cost','ايام',null,array('id'=>'day_cost')) }}
                        {{ Form::label('day_cost','ايام') }}
                    </div>
                <div class="input-field">
                    {{--<i class="fa fa-tag prefix"></i>--}}
                    {{ Form::radio('day_cost','مبلغ',null,array('id'=>'day_co')) }}
                    {{ Form::label('day_co','مبلغ') }}

                </div>
                <p class="parsley-required error-validation">{{ $errors ->first('day_cost') }} </p>

            </div>

                <div class="col  l3 s12">
                    <div class="input-field">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::text('val',null,array('id'=>'val',)) }}
                        {{--{{ Form::label('val',  ' خصم التامين' )     }}--}}
                        <p class="parsley-required error-validation">{{ $errors ->first('val') }} </p>
                    </div>
                </div>
            </div>
            @if(Route::currentRouteName() != 'addMonthChange')
            <div class="row">
                <div class="col s12 l12">
                    <div class="input-field" >
                        <i class="fa fa-tag prefix"></i>
                        {{ Form::textarea('cause',null,array('id'=>'cause','class'=>"materialize-textarea" ,'length'=>"200")) }}
                        {{ Form::label('cause',  ' السبب  ' )     }}
                        <p class="parsley-required error-validation">{{ $errors ->first('cause') }} </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 l2">
                    <div class="input-field">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::checkbox('canceled',1,null,array('id'=>'canceled')) }}
                        {{ Form::label('canceled','الغاء الحركه   ') }}

                        <p class="parsley-required error-validation">{{ $errors ->first('canceled') }} </p>
                    </div>
                </div>
                <div class="col s2 l10">
                    <div class="input-field" >
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::textarea('cancel_cause',null,array('id'=>'cancel_cause','class'=>"materialize-textarea" ,'length'=>"200")) }}
                        {{ Form::label('cancel_cause','سبب الالغاء') }}
                        <p class="parsley-required error-validation">{{ $errors ->first('cancel_cause') }} </p>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col s12 l12">
                    @if(Route::currentRouteName() == 'addMonthChange')
                        {{--{{Form::submit('  اضف ')}}--}}
                        <button type="submit" class="waves-effect btn">اضف </button>
                    @elseif(Route::currentRouteName() == 'editMonthChange')
                        {{--{{Form::submit('  تعديل ')}}--}}
                        <button type="submit" class="waves-effect btn">تعديل </button>
                    @endif
                </div>
                {{ Form::close() }}
            </div>{{--submit  row end--}}
        </div>
        </div>
    @include('dashboard.hr.month_change._table_view');

    </section>
    @stop