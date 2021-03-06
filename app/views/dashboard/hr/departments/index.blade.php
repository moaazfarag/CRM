@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
                @if(PerC::isShow('hr','Departments','edit','editDep')||PerC::isShow('hr','Departments','add','addDep'))
    <div id="product_cat" class="col s12">
        <!-- ???????  -->
        <div class="card {{ @$modelMini }}">
            <div class="title">
                <h5><i class="mdi mdi-notification-event-available"></i> @lang('main.add_new_dep')   </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>
            </div>
            <div class="content">
                    @include('include.messages')

                {{--{{ dd($editSeason->name) }}--}}
                @if(isset($editDep->name))
                    {{ Form::model($editDep,array('route'=>array('updateDep',$editDep->id))) }}
                @else
                    {{ Form::open(array('route'=>'storeDep')) }}
                @endif
                <div class="row no-margin-top">
                    <div class="col s12 l2">
                        <label for="name">
                            {{@$arabicName}}
                        </label>

                    </div>
                    <div class="col s12 m6 l6">
                        <div class="input-field">
                            <i class="fa fa-shield prefix"></i>

                            {{Form::text('name',null,array('data-parsley-id'=>'4370','class'=>($errors->first('name'))?'parsley-error':null,'required','placeholder'=>" ".  @$holder,'id'=>'name')) }}
                            {{--<input value="{{ null }}" name="cat_name" id="cat-name" type="text" placeholder="???  {{@$arabicName}}">--}}
                            <p class="parsley-required error-validation">{{ $errors ->first('name') }} </p>
                        </div>
                    </div>
                </div>
                <div class="input-field">
                </div>
                <div class="row">
                    <div class="col s12 l12">

                        @if(isset($editDep->name))
                            <button class="waves-effect btn">@lang('main.edit') </button>
                        @else
                            <button class="waves-effect btn">@lang('main.add') </button>
                        @endif

                        {{ Form::close() }}
                    </div>

                </div>
                <br/>
            </div>
        </div>
    </div>
                    @endif
    @if(PerC::isShow('hr','Departments','add_show_edit'))
        <br/>
        @include('dashboard.hr.departments._table_view')
    @endif
            <!-- /??? ?????? -->


</section>
@stop