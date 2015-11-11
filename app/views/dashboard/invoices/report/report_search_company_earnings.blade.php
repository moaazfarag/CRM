
@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard" ng-app="itemApp"  ng-controller="mainController">
    {{ Form::open(array('route'=>array('companyEarnings'))) }}
    <div class=" card ">
        <div class="title">
            <h5>
                <i class="fa fa-cog"></i>
                {{ $title }}
            </h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">
            <div class="row">
                <div class="col s12 l3">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::text('date_from',null,array('required','id'=>'date_from','class'=>'pikaday')) }}
                        <p class="parsley-required">{{ $errors ->first('date_from') }} </p>

                        <label for="date_from">
                            بداية من
                        </label>
                    </div>
                </div>


                <div class="col s12 l3">
                    <div class="input-field">
                        <i class="mdi mdi-action-language prefix"></i>
                        {{ Form::text('date_to',null,array('required','id'=>'date_to','class'=>'pikaday')) }}
                        <p class="parsley-required">{{ $errors ->first('date_to') }} </p>

                        <label for="date_to">
                            حتى
                        </label>
                    </div>
                </div>
            </div> <!-- end row -->

            <div class="row">
                <div class="col s12 l12" style="padding: 2%;">

                    <button type="submit" class="waves-effect btn">
                        عرض
                    </button>
                </div>


                {{ Form::hidden('sum',$sum) }}
                {{ Form::hidden('invoice_type',$type) }}
                {{ Form::close() }}
            </div>{{--submit  row end--}}
        </div>



    </div>

</section>
@stop

