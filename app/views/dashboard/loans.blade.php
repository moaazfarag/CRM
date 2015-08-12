@extends('dashboard.main')
@section('content')
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
                        {{ Form::label('empCode',' ') }}
                        {{ Form::select('empCode', array(NULL => 'اختار الموظف ') +$co_info->employees->lists('empName','id'),null,array('id'=>'empCode','required')) }}
                        <p class="parsley-required">{{ $errors ->first('empCode') }} </p>
                    </div>
                    </div>
                    <div class="col s12 l3">
                        <div class="input-field">
                            <i class="mdi mdi-action-language prefix"></i>
                            {{ Form::text('loanVal',null,array('required','id'=>'loanVal',)) }}
                            {{ Form::label('loanVal',  'المبلغ' )     }}
                            <p class="parsley-required">{{ $errors ->first('loanVal') }} </p>
                        </div>
                    </div>
                <div class="col s12 l4">
                        <div class="input-field">
                            <i class="mdi mdi-action-language prefix"></i>
                            {{ Form::text('loanCurrBal',null,array('required','id'=>'loanCurrBal',)) }}
                            {{ Form::label('loanCurrBal',  'القسط الشهرى' )     }}
                            <p class="parsley-required">{{ $errors ->first('loanCurrBal') }} </p>
                        </div>
                    </div>
                <div class="row">
                    <div class="col s1 l2">
                        <div class="input-field">
                            <i class="fa fa-tag prefix"></i>
                            {{--{{ Form::checkbox('cancelDate',1,null,array('id'=>'cancelDate')) }}--}}
                            {{ Form::label('loanDate','  ت.السلفه  ') }}

                            <p class="parsley-required">{{ $errors ->first('loanDate') }} </p>
                        </div>
                    </div>
                    <div class="col s2 l2">
                        <div class="input-field">
                            {{--<i class="mdi mdi-action-language prefix"></i>--}}
                            {{ Form::text('loanDate',null,array('required','id'=>'loanDate','class'=>'pikaday')) }}
                        </div>

                    </div>
                    <div class="col s1 l2">
                        <div class="input-field">
                            <i class="fa fa-tag prefix"></i>
                            {{--{{ Form::checkbox('cancelDate',1,null,array('id'=>'cancelDate')) }}--}}
                            {{ Form::label('loanStart','  بدء القسط  ') }}

                            <p class="parsley-required">{{ $errors ->first('loanStart') }} </p>
                        </div>
                    </div>
                    <div class="col s2 l2">
                        <div class="input-field">
                            {{--<i class="mdi mdi-action-language prefix"></i>--}}
                            {{ Form::text('loanStart',null,array('required','id'=>'loanStart','class'=>'pikaday')) }}

                        </div>
                    </div>

                    <div class="col s1 l2">
                        <div class="input-field">
                            <i class="fa fa-tag prefix"></i>
                            {{--{{ Form::checkbox('cancelDate',1,null,array('id'=>'cancelDate')) }}--}}
                            {{ Form::label('loanEnd','  انتهاء الاقساط   ') }}

                            <p class="parsley-required">{{ $errors ->first('loanEnd') }} </p>
                        </div>
                    </div>
                    <div class="col s2 l2">
                        <div class="input-field">
                            {{--<i class="mdi mdi-action-language prefix"></i>--}}
                            {{ Form::text('loanEnd',null,array('required','id'=>'loanEnd','class'=>'pikaday')) }}

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
    @include('dashboard.loans_table_view');
        </section>
        @stop