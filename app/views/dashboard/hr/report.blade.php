@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
        {{ Form::open(array('route'=>array('prepMsHeader'))) }}
        <div class=" card ">
            <div class="title">
                <h5>
                    <i class="fa fa-cog"></i>
                المرتبات المنصرفة خلال فترة
                </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col s12 l5">
                        <div class="input-field">
                            <i class="mdi mdi-action-language prefix"></i>
                            {{ Form::text('date_from',null,array('required','id'=>'employee_date','class'=>'pikaday')) }}
                            <p class="parsley-required">{{ $errors ->first('employee_date') }} </p>

                            <label for="employee_date">
                            بداية من
                            </label>
                        </div>
                    </div>


                    <div class="col s12 l5">
                        <div class="input-field">
                            <i class="mdi mdi-action-language prefix"></i>
                            {{ Form::text('date_to',null,array('required','id'=>'employee_date','class'=>'pikaday')) }}
                            <p class="parsley-required">{{ $errors ->first('employee_date') }} </p>

                            <label for="employee_date">
       حتى
                            </label>
                        </div>
                    </div>



            </div>

            <div class="row">
                <div class="col s12 l12" style="padding: 2%;">

                    <button type="submit" class="waves-effect btn">
                        عرض المرتبات المنصرفة
                    </button>
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

