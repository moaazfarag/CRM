@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    @if(Route::currentRouteName() == "addMsHeader")
        {{ Form::open(array('route'=>array('prepMsHeader'))) }}
    <div class=" card ">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i> @lang('main.salary_equipment')</h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">
            <div class="row">
                <div class="col s1 l2">
                    <div class="input-field">
                        {{ Form::selectRange('for_month','1','12') }}
                        {{ Form::label('for_month ',lang::get('main.for_the_month')) }}
                        <p class="parsley-required">{{ $errors ->first('for_month') }} </p>
                    </div>
                </div>
                <div class="col s1 l2">
                    <div class="input-field">
                        {{ Form::selectRange('for_year',2015,2017) }}
                        {{ Form::label('for_year ',lang::get('main.year')) }}
                        <p class="parsley-required">{{ $errors ->first('for_year') }} </p>
                    </div>
                </div>

                    <div class="col s12 l5">
                        <div class="input-field">
                            {{ Form::label('employee_id',' ') }}
                            {{ Form::select('employee_id', array(NULL =>lang::get('main.employee')) +$co_info->employees->lists('name','id'),null,array('id'=>'employee_id')) }}
                            <p class="parsley-required">{{ $errors ->first('employee_id') }} </p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col s12 l12">

                        <button type="submit" class="waves-effect btn">  @lang('main.monthly_salary_equipment') </button>
                    @endif
                </div>
                {{ Form::close() }}
            </div>{{--submit  row end--}}
        </div>



    </div>
            @if(Route::currentRouteName() == "prepMsHeader")
                @include('dashboard.hr.msheader._table_view');
            @endif
</section>
@stop

