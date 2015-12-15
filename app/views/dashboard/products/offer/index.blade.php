@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    <div id="product_cat" class="col s12">
        <!-- الاصناف  -->
        <div class="card {{ @$categoryMini }}">
            <div class="title">
                <h5>
                    <i class="mdi mdi-notification-event-available"></i> @lang('main.addNewOffer')  </h5>
                <a class="minimize" href="#">
                    <i class="mdi-navigation-expand-less"></i>
                </a>

            </div>
            <div class="content">
                @include('include.messages')
                @if(isset($offer->name))
                    {{ Form::model($offer,array('route'=>array('updateOffer',$offer->id))) }}
                @else
                    {{ Form::open(array('route'=>'storeOffer')) }}
                @endif
                @if(PerC::isShow('main_info','offer','edit', "editOffer" )||PerC::isShow('main_info','offer','add', "addOffer" ))
                    <div class="row no-margin-top">
                        <div class="col s2 l1">
                            <label for="name">
                                @lang('main.nameOfOffer')
                            </label>
                        </div>
                        <div class="col s12 m3 l2">
                            <div class="input-field">
                                <i class="mdi mdi-action-wallet-giftcard prefix"></i>
                                {{Form::text('name',null,array('required','placeholder'=>Lang::get('main.nameOfOffer'), 'id'=>'name','data-parsley-id'=>'4370','class'=>($errors->first('name'))?'parsley-error':null)) }}
                                <p class="parsley-required">{{ $errors ->first('offer') }} </p>
                            </div>
                        </div>
                        <div class="col s12 l2">
                            <div class="input-field">
                                <i class="mdi mdi-content-undo prefix"></i>
                                {{ Form::number('offer',null,array('id'=>'offer','required','max'=>100,'min'=>1,'data-parsley-id'=>'4370','class'=>($errors->first('offer'))?'parsley-error':null)) }}
                                <p class="parsley-required">{{ $errors ->first('offer') }} </p>

                                <label for="offer">
                                    نسبة الخصم
                                </label>
                            </div>
                        </div>
                        <div class="col s12 l3">
                            <div class="input-field">
                                <i class="fa fa-calendar prefix"></i>
                                {{ Form::text('from',null,array('id'=>'from','data-parsley-id'=>'4370','class'=>($errors->first('from'))?'parsley-error pikaday':'pikaday')) }}
                                <p class="parsley-required">{{ $errors ->first('from') }} </p>

                                <label for="from">
                                    بداية من
                                </label>
                            </div>
                        </div>


                        <div class="col s12 l3">
                            <div class="input-field">
                                <i class="fa fa-calendar prefix"></i>
                                {{ Form::text('to',null,array('id'=>'to','data-parsley-id'=>'4370','class'=>($errors->first('to'))?'parsley-error pikaday':'pikaday')) }}
                                <p class="parsley-required">{{ $errors ->first('to') }} </p>

                                <label for="to">
                                    حتى
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col s12 l12">
                            @endif
                            @if(isset($offer->name))
                                @if(PerC::isShow('main_info','offer','edit', "editOffer" ))
                                    <button class="waves-effect btn">@lang('main.edit') </button>
                                @endif
                            @else
                                @if(PerC::isShow('main_info','offer','add', "addOffer" ))
                                    <button class="waves-effect btn">@lang('main.add') </button>
                                @endif
                                {{ Form::close() }}
                        </div>
                    </div>
                    <br/>
                @endif
            </div>
        </div>
    </div>

    @if(PerC::isShow('main_info','offer','add_edit_show'))
        <br/>
        @include('dashboard.products.offer._table_view')
        @endif

</section>
@stop