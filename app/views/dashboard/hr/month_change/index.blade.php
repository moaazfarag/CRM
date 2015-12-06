@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    @if(Route::currentRouteName() == 'addMonthChange')
        {{ Form::open(array('route'=>array('storeMonthChange'))) }}
    @elseif(Route::currentRouteName() == 'editMonthChange')
        {{ Form::model($employee,array('route'=>array('updateMonthChange',$employee->id))) }}
    @endif
    @if(PerC::isShow('hr','MonthChange','edit','editMonthChange')||PerC::isShow('hr','MonthChange','add','addMonthChange'))
        <div class=" card ">
            <div class="title">
                <h5>
                    <i class="fa fa-cog"></i> @lang('main.month_change') </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>

            <div class="content">
                @include('include.messages')

                <div class="row">

                    <div class="col s12 l5">
                        <div class="input-field">
                            {{ Form::label('employee_id',' ') }}
                            {{ Form::select('employee_id', array(NULL => lang::get('main.employee')) +$co_info->employees->lists('name','id'),null,array('id'=>'employee_id')) }}
                            <p class="parsley-required error-validation">{{ $errors ->first('employee_id') }} </p>
                        </div>
                    </div>
                    <div class="col s2 l6">
                        {{--<i class="fa fa-tag prefix"></i>--}}
                        <div class="input-field">
                            {{ Form::label('ds_id',' ') }}
                            {{ Form::select('ds_id', array(NULL => lang::get("main.clauses")) +$co_info->desded()->where('deleted',0)->where('ds_cat','متغير')->lists('name','id'),null,array('id'=>'ds_id')) }}
                            <p class="parsley-required error-validation">{{ $errors ->first('ds_id') }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col  l1">
                        <div class="input-field">
                            <i class="mdi mdi-action-language prefix"></i>
                            {{ Form::label('trans_date',lang::get('main.date')) }}
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


                        </div>
                    </div>

                    <div class="col  l3">
                        <div class="input-field">
                            {{ Form::select('for_month', array(NULL => lang::get('main.select_month')) +BaseController::$months,null,array('id'=>'for_month')) }}
                            <p class="parsley-required error-validation">{{ $errors ->first('for_month') }} </p>
                        </div>
                    </div>

                    <div class="col  l1 s12">
                        <div class="input-field">
                        </div>
                    </div>

                    <div class="col  l3 s12">
                        <div class="input-field">


                            {{ Form::select('for_year', array(NULL => lang::get('main.select_year')) +BaseController::$years,null,array('id'=>'for_year')) }}
                            <p class="parsley-required error-validation">{{ $errors ->first('for_year') }} </p>


                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col  l2 s12">
                        <div class="input-field">
                            {{--<i class="fa fa-tag prefix"></i>--}}
                            {{ Form::radio('day_cost',lang::get('main.days'),null,array('id'=>'day_cost')) }}
                            {{ Form::label('day_cost',lang::get('main.days')) }}
                        </div>
                        <div class="input-field">
                            {{--<i class="fa fa-tag prefix"></i>--}}
                            {{ Form::radio('day_cost',lang::get('main.amount'),null,array('id'=>'day_co')) }}
                            {{ Form::label('day_co',lang::get('main.amount')) }}

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
                        <div class="col s12 l2">
                            <div class="input-field">

                                {{--<i class="fa fa-tag prefix"></i>--}}
                                @if(Route::currentRouteName() == 'editMonthChange')
                                    {{ Form::checkbox('canceled',1,null,array('id'=>'canceled')) }}
                                @else
                                    {{ Form::checkbox('canceled',1,true,array('id'=>'canceled')) }}
                                @endif
                                {{ Form::label('canceled',lang::get('main.delete_movement')) }}

                                <p class="parsley-required error-validation">{{ $errors ->first('canceled') }} </p>
                            </div>
                        </div>
                        <div class="col s2 l10">
                            <div class="input-field">
                                {{--<i class="fa fa-tag prefix"></i>--}}
                                {{ Form::textarea('cancel_cause',null,array('id'=>'cancel_cause','class'=>"materialize-textarea" ,'length'=>"200")) }}
                                {{ Form::label('cancel_cause',lang::get('main.cancellation_reason')) }}
                                <p class="parsley-required error-validation">{{ $errors ->first('cancel_cause') }} </p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col s12 l12">
                        @if(Route::currentRouteName() == 'addMonthChange')
                            {{--{{Form::submit('  اضف ')}}--}}
                            <button type="submit" class="waves-effect btn">@lang('main.add') </button>
                        @elseif(Route::currentRouteName() == 'editMonthChange')
                            {{--{{Form::submit('  تعديل ')}}--}}
                            <button type="submit" class="waves-effect btn">@lang('main.edit') </button>
                        @endif
                    </div>
                    {{ Form::close() }}
                </div>{{--submit  row end--}}
                <br>
            </div>
        </div>
    @endif
    @if(PerC::isShow('hr','MonthChange','add_show_edit'))
        <br>
        @include('dashboard.hr.month_change._table_view');
    @endif
</section>
@stop