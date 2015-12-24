@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    @if(Route::currentRouteName() == 'addLoans')
        {{ Form::open(array('route'=>array('storeLoans'))) }}
    @elseif(Route::currentRouteName() == 'editLoans')
        {{ Form::model($employee,array('route'=>array('updateLoans',$employee->id))) }}
    @endif
    @if(PerC::isShow('hr','loans','edit','editLoans')||PerC::isShow('hr','loans','add','addLoans'))
    <div class=" card ">
        <div class="title">
            <h5> <i class="fa fa-cog"></i> @lang('main.add_new_loan') </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">
            @include('include.messages')
            <div class="row">
                <div class="col s12 l3">
                    {{--<i class="fa fa-tag prefix"></i>--}}
                    <div class="input-field">
                        {{ Form::label('employee_id',' ') }}
                        {{ Form::select('employee_id', array(NULL => Lang::get('main.chose_employee')) +$co_info->employees->lists('name','id'),null,array('id'=>'employee_id')) }}
                        <p class="parsley-required error-validation">{{ $errors ->first('employee_id') }} </p>
                    </div>
                    </div>
                    <div class="col s12 l3">
                        <div class="input-field">
                            <i class="fa fa-dollar prefix"></i>
                            {{ Form::text('loan_val',null,array('data-parsley-id'=>'4370','class'=>($errors->first('loan_val'))?'parsley-error':null,'required','id'=>'loan_val',)) }}
                            {{ Form::label('loan_val',Lang::get('main.salary_loan')) }}
                            <p class="parsley-required error-validation">{{ $errors ->first('loan_val') }} </p>
                        </div>
                    </div>
                <div class="col s12 l3">
                        <div class="input-field">
                            <i class="fa fa-puzzle-piece prefix"></i>
                            {{ Form::text('loan_currBal',null,array('data-parsley-id'=>'4370','class'=>($errors->first('loan_currBal'))?'parsley-error':null,'required','id'=>'loan_currBal',)) }}
                            {{ Form::label('loan_currBal', lang::get('main.monthly_quantity') )     }}
                        </div>
                    <p class="parsley-required error-validation">{{ $errors ->first('loan_currBal') }} </p>

                </div>
                </div>
                <div class="row">
                    <div class="col s12 l1" style="margin-left: 1%">
                        <div class="input-field">
                            <i class="fa fa-calendar prefix"></i>
                            {{--{{ Form::checkbox('cancelDate',1,null,array('id'=>'cancelDate')) }}--}}
                            {{ Form::label('loan_date',lang::get('main.loan_date')) }}
                        </div>
                        <p class="parsley-required error-validation">{{ $errors ->first('loan_date') }} </p>
                    </div>
                    <div class="col s12 l2">
                        <div class="input-field">
                            {{--<i class="mdi mdi-action-language prefix"></i>--}}
                            {{ Form::text('loan_date',null,array('data-parsley-id'=>'4370','class'=>($errors->first('loan_date'))?'parsley-error pikaday':'pikaday','required','id'=>'loan_date')) }}
                        </div>

                    </div>
                    <div class="col s12 l1" style="margin-left: 1%">
                        <div class="input-field">
                            <i class="fa fa-calendar prefix"></i>
                            {{--{{ Form::checkbox('cancelDate',1,null,array('id'=>'cancelDate')) }}--}}
                            {{ Form::label('loan_start',lang::get('main.loan_start')) }}

                        </div>
                        <p class="parsley-required error-validation">{{ $errors ->first('loan_date') }} </p>

                    </div>
                    <div class="col s12 l2">
                        <div class="input-field">
                            {{--<i class="mdi mdi-action-language prefix"></i>--}}
                            {{ Form::text('loan_start',null,array('data-parsley-id'=>'4370','class'=>($errors->first('loan_start'))?'parsley-error pikaday':'pikaday','required','id'=>'loan_start','class'=>'pikaday')) }}

                        </div>
                    </div>

                </div>
            <div class="row">
                <div class="col s4 l4"  style="padding: 1% 3% 0 0">


                    @if(Route::currentRouteName() == 'editLoans')
                        <button class="waves-effect btn">@lang('main.edit') </button>
                    @elseif(Route::currentRouteName() == 'addLoans')
                        <button class="waves-effect btn">@lang('main.add') </button>
                    @endif

                    {{ Form::close() }}

                </div>

            </div>
            <br/>

         </div>


    </div>
            @endif
           @if(PerC::isShow('hr','loans','add_show_edit'))
        <br/>
        @include('dashboard.hr.loans._table_view');
    @endif


        </section>
        @stop