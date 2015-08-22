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
                <div class="col s2 l1">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::label('trans_date','   التاريخ') }}
                        <p class="parsley-required">{{ $errors ->first('trans_date') }} </p>
                    </div>
                </div>
                <div class="col s1 l2">
                    <div class="input-field">
                        {{ Form::text('trans_date',null,array('required','id'=>'trans_date','class'=>'pikaday')) }}
                    </div>
                </div>
                <div class="col s12 l5">
                    <div class="input-field">
                        {{ Form::label('employee_id',' ') }}
                        {{ Form::select('employee_id', array(NULL => 'الموظف  ') +$co_info->employees->lists('name','id'),null,array('id'=>'employee_id','required')) }}
                        <p class="parsley-required">{{ $errors ->first('employee_id') }} </p>
                    </div>
                </div>
                <div class="col s1 l2">
                    <div class="input-field">
                        {{ Form::selectMonth('for_month') }}
                        {{ Form::label('for_month ',' عن شهر ') }}
                        <p class="parsley-required">{{ $errors ->first('for_month') }} </p>
                    </div>
                </div>
                <div class="col s1 l2">
                    <div class="input-field">
                        {{ Form::selectRange('for_year',2000,2050) }}
                        {{ Form::label('for_year ',' سنه  ') }}
                        <p class="parsley-required">{{ $errors ->first('for_year') }} </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s2 l5">
                    {{--<i class="fa fa-tag prefix"></i>--}}
                    <div class="input-field">
                        {{ Form::label('ds_id',' ') }}
                        {{ Form::select('ds_id', array(NULL => 'البنود') +$co_info->desded->lists('name','id'),null,array('id'=>'ds_id','required')) }}
                        <p class="parsley-required">{{ $errors ->first('ds_id') }} </p>
                    </div>
                </div>
                <div class="col s2 l1">
                    <div class="input-field">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::radio('day_cost','ايام',null,array('id'=>'day_cost','required')) }}
                        {{ Form::label('day_cost','ايام') }}
                        <p class="parsley-required">{{ $errors ->first('day_cost') }} </p>
                    </div>
                </div>
                <div class="col s2 l1">
                    <div class="input-field">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::radio('day_cost','مبلغ',null,array('id'=>'day_co','required')) }}
                        {{ Form::label('day_co','مبلغ') }}

                        <p class="parsley-required">{{ $errors ->first('day_cost') }} </p>
                    </div>
                </div>
                <div class="col s2 l2">
                    <div class="input-field">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::text('val',null,array('required','id'=>'val',)) }}
                        {{--{{ Form::label('val',  ' خصم التامين' )     }}--}}
                        <p class="parsley-required">{{ $errors ->first('ins_val') }} </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s2 l12">
                    <div class="input-field" >
                        <i class="fa fa-tag prefix"></i>
                        {{ Form::textarea('cause',null,array('id'=>'cause','class'=>"materialize-textarea" ,'length'=>"200")) }}
                        {{ Form::label('cause',  ' السبب  ' )     }}
                        <p class="parsley-required">{{ $errors ->first('cause') }} </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s1 l2">
                    <div class="input-field">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::checkbox('cancel_cause',1,null,array('id'=>'cancel_cause')) }}
                        {{ Form::label('cancel_cause','الغاء الحركه   ') }}

                        <p class="parsley-required">{{ $errors ->first('cancel_date') }} </p>
                    </div>
                </div>
                <div class="col s2 l10">
                    <div class="input-field" >
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        {{ Form::textarea('cancel_cause',null,array('id'=>'cancel_cause','class'=>"materialize-textarea" ,'length'=>"200")) }}
                        {{ Form::label('cancel_cause','سبب الالغاء') }}
                        <p class="parsley-required">{{ $errors ->first('cancel_cause') }} </p>
                    </div>
                </div>
            </div>
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