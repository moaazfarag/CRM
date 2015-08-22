@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    @if(Route::currentRouteName() == 'addLoans')
        {{ Form::open(array('route'=>array('storeLoans'))) }}
    @elseif(Route::currentRouteName() == 'editLoans')
        {{ Form::model($employee,array('route'=>array('updateLoans',$employee->id))) }}
    @endif
    <div class=" card ">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i> اضف قرض جديد  </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">
            <div class="row">
                <div class="col s12 l5">
                    {{--<i class="fa fa-tag prefix"></i>--}}
                    <div class="input-field">
                        {{ Form::label('employee_id',' ') }}
                        {{ Form::select('employee_id', array(NULL => 'اختار الموظف ') +$co_info->employees->lists('name','id'),null,array('id'=>'employee_id','required')) }}
                        <p class="parsley-required">{{ $errors ->first('employee_id') }} </p>
                    </div>
                    </div>
                    <div class="col s12 l3">
                        <div class="input-field">
                            <i class="mdi mdi-action-language prefix"></i>
                            {{ Form::text('loan_val',null,array('required','id'=>'loan_val',)) }}
                            {{ Form::label('loan_val',  'المبلغ' )     }}
                            <p class="parsley-required">{{ $errors ->first('loan_val') }} </p>
                        </div>
                    </div>
                <div class="col s12 l4">
                        <div class="input-field">
                            <i class="mdi mdi-action-language prefix"></i>
                            {{ Form::text('loan_currBal',null,array('required','id'=>'loan_currBal',)) }}
                            {{ Form::label('loan_currBal',  'القسط الشهرى' )     }}
                            <p class="parsley-required">{{ $errors ->first('loan_currBal') }} </p>
                        </div>
                    </div>
                <div class="row">
                    <div class="col s1 l2">
                        <div class="input-field">
                            <i class="fa fa-tag prefix"></i>
                            {{--{{ Form::checkbox('cancelDate',1,null,array('id'=>'cancelDate')) }}--}}
                            {{ Form::label('loan_date','  ت.السلفه  ') }}
                            <p class="parsley-required">{{ $errors ->first('loan_date') }} </p>
                        </div>
                    </div>
                    <div class="col s2 l2">
                        <div class="input-field">
                            {{--<i class="mdi mdi-action-language prefix"></i>--}}
                            {{ Form::text('loan_date',null,array('required','id'=>'loan_date','class'=>'pikaday')) }}
                        </div>

                    </div>
                    <div class="col s1 l2">
                        <div class="input-field">
                            <i class="fa fa-tag prefix"></i>
                            {{--{{ Form::checkbox('cancelDate',1,null,array('id'=>'cancelDate')) }}--}}
                            {{ Form::label('loan_start','  بدء القسط  ') }}

                            <p class="parsley-required">{{ $errors ->first('loan_start') }} </p>
                        </div>
                    </div>
                    <div class="col s2 l2">
                        <div class="input-field">
                            {{--<i class="mdi mdi-action-language prefix"></i>--}}
                            {{ Form::text('loan_start',null,array('required','id'=>'loan_start','class'=>'pikaday')) }}

                        </div>
                    </div>

                    <div class="col s1 l2">
                        <div class="input-field">
                            <i class="fa fa-tag prefix"></i>
                            {{--{{ Form::checkbox('cancelDate',1,null,array('id'=>'cancelDate')) }}--}}
                            {{ Form::label('loan_end','  انتهاء الاقساط   ') }}

                            <p class="parsley-required">{{ $errors ->first('loan_end') }} </p>
                        </div>
                    </div>
                    <div class="col s2 l2">
                        <div class="input-field">
                            {{--<i class="mdi mdi-action-language prefix"></i>--}}
                            {{ Form::text('loan_end',null,array('required','id'=>'loan_end','class'=>'pikaday')) }}

                        </div>
                    </div>


                </div>

         </div>
            <div class="row">
                <div class="col s12 l12">

                    @if(isset($editLoans->depName))
                        <button class="waves-effect btn">@lang('main.edit') </button>
                    @else
                        <button class="waves-effect btn">@lang('main.add') </button>
                    @endif

                    {{ Form::close() }}
                </div>
            </div>
            </div>
        </div>
    @include('dashboard.hr.loans._table_view');
        </section>
        @stop