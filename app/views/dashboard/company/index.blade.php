@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard">
    <!-- Store Settings  بيانات الشركة  -->
@if(PerC::isShow('main_info','company','edit_show'))
<?php (PerC::isShow('main_info','company','show')&& !PerC::isShow('main_info','company','edit'))?$readOnly='readonly':null; ?>
    <div class="card {{ isset($miniComInfo)?$miniComInfo:"minimized" }}">
        <div class="title">
            <h5><i class="fa fa-cog"></i> @lang('main.companyInfo')</h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>

        <div class="content">
            @include('include.messages')

            {{ Form::model($companyInfo, array('route'=>array('updateCompanyInfo',Auth::user()->co_id),'data-parsley-validate')) }}

            <div class="row no-margin-top">
                <div class="col s12 l1">
                    <label for="ecommerce-name">
                        @lang('main.companyName')
                    </label>
                </div>
                <div class="col s12 m6 l5">
                    <div class="input-field">
                        <i class="mdi mdi-action-home prefix"></i>
                    <?php $companyName = Lang::get('main.companyName') ?>
                    {{--<input name="co_name" id="ecommerce-name" type="text" placeholder="اسم الشركة">--}}
                    {{ Form::text('co_name',null,array('required','placeholder'=>$companyName,@$readOnly)) }}

                    </div>
                </div>



            <div class="col s12 l1">
                <label for="ecommerce-adress">
                    @lang('main.address')
                </label>
            </div>
            <div class="col s12 l5">
                <div class="input-field">
                    <i class="mdi mdi-action-language prefix"></i>
                    <?php $address = Lang::get('main.address') ?>
                    {{ Form::text('co_address',null,array('required','placeholder'=>$address,@$readOnly)) }}
                    {{--<input name="co_adress" id="ecommerce-adress" type="text" placeholder="العنوان">--}}
                </div>
            </div>
            </div>

        <div class="row no-margin-top">
            <div class="col s12 l1">
                <label for="ecommerce-tel">
                    @lang('main.phoneNum')
                </label>
            </div>
            <div class="col s12 l5">
                <div class="input-field">
                    <i class="mdi mdi-communication-phone prefix"></i>
                    <?php $phoneNum = Lang::get('main.phoneNum') ?>
                    {{--<input name="co_tel" id="ecommerce-tel" type="text" placeholder="رقم الهاتف ">--}}
                    {{ Form::text('co_tel',null,array('required','placeholder'=>$phoneNum,@$readOnly)) }}

                </div>
            </div>


            <div class="col s12 l1">
                <?php $print_size = Lang::get('main.print_size') ?>
                {{ Form::label('ecommerce-printsize',$print_size) }}
            </div>

            <div class="col s12 l5">

                <div class="input-field">


                    {{ Form::select('co_print_size', array('' => lang::get('main.print_size')) + $print_size_types,null,array('id'=>'ecommerce-printsize',@$readOnly)) }}

                    <p dir="rtl" class="parsley-required">{{ $errors ->first('br_id') }} </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 l1">
                <label for="ecommerce-currency">
                    @lang('main.currency')
                </label>
            </div>
            <div class="col s12 l5">
                <div class="input-field">
                    <i class="mdi mdi-editor-attach-money prefix"></i>
                    <?php $currency = Lang::get('main.currency') ?>
                    {{--<input name="co_carrency" id="ecommerce-currency" type="text" placeholder="العملة">--}}
                    {{ Form::text('co_currency',null,array('required','placeholder'=>$currency,@$readOnly)) }}
                </div>

            </div>
        </div>
            @if(!@$readOnly)
            <hr/>
        <div class="row">
            <div class="col s12 l2" style="padding-bottom:2% ">
                <label for="">
                    @lang('main.settingSit')
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col s12 l5">

                {{ Form::checkbox('co_use_serial', 1,null,array('id'=>'co_use_serial')) }}
                <label for="co_use_serial">@lang('main.co_use_serial')</label>
            </div>
            <div class="col s12 l5">
                {{ Form::checkbox('co_supplier_must', 1,null,array('id'=>'co_supplier_must')) }}
                <label for="co_supplier_must">@lang('main.co_supplier_must')</label>
            </div>
        </div>{{--end row --}}

        <div class="row">
            <div class="col s12 l5">

                {{ Form::checkbox('co_use_season', 1,null,array('id'=>'co_use_season')) }}
                <label for="co_use_season">@lang('main.co_use_season')</label>
            </div>
            <div class="col s12 l5">

                {{ Form::checkbox('co_use_markes_models', 1,null,array('id'=>'co_use_markes_models')) }}
                <label for="co_use_markes_models">@lang('main.co_use_markes_models')</label>
            </div>
        </div>


        <div class="row">
            <div class="col s12 l10" style="padding:2%;">

                <button class="waves-effect btn">@lang('main.edit') </button>
                {{ Form::close() }}
            </div>
        </div>
            @endif


    </div>
</div>
    </div>
    @endif
@if(PerC::isShow('main_info','branch','add_edit_show'))

    <div class="card {{ isset($miniBranch)?$miniBranch:"minimized" }}">
        <div class="title">
            <h5><i class="mdi mdi-notification-event-available"></i> @lang('main.branches')</h5>
            <a class="minimize" href="#">
                <i class="mdi-navigation-expand-less"></i>
            </a>
        </div>
        <div class="content">
            @if(Session::has('error_br'))
                <div id="hidden" class="alert">

                    {{ Session::get('error_br') }}
                </div>
            @endif

            @if(Session::has('success_br'))

                <div id="hidden_br" class="alert green lighten-4 green-text text-darken-2">
                    {{ Session::get('success_br') }}
                </div>
            @endif



            @if(Route::currentRouteName() == "editBranch" )
                {{ Form::open(array('route'=>array('updateBranch',$branch->id),'data-parsley-validate')) }}
            @else
                {{ Form::open(array('route'=>array('storeBranch'),'data-parsley-validate')) }}
            @endif
                @if(PerC::isShow('main_info','branch','edit',"editBranch" )||PerC::isShow('main_info','branch','add' ,"addBranch"))
            <div class="row no-margin-top">
                <div class="col s12 l2">
                    <label for="branch-name">
                        @lang('main.branchName')
                    </label>
                </div>
                <div class="col s12 m6 l6">
                    <div class="input-field">
                        <i class="mdi mdi-social-person prefix"></i>
                        <input value="{{ isset($branch->br_name)?$branch->br_name:null }}" name="branch_name"
                               id="branch-name" type="text" placeholder=@lang('main.branchName')>
                    </div>
                </div>

            </div>
            <div class="row no-margin-top">
                <div class="col s12 l2">
                    <label for="branch-address">
                        @lang('main.branchAddress')
                    </label>
                </div>
                <div class="col s12 m6 l8">
                    <div class="input-field">
                        <i class="mdi mdi-social-person prefix"></i>
                        <input value="{{ isset($branch->br_address)?$branch->br_address :null }}" name="branch_address"
                               id="branch-address" type="text" placeholder= @lang('main.branchAddress')>
                    </div>
                </div>

            </div>

            <div class="row">
                {{ form::close() }}

@endif
                <div class="col s12 l12">
                    @if(PerC::isShow('main_info','branch','edit',"editBranch" ) )
                        <button class="waves-effect btn">@lang('main.edit')</button>
                    @elseif(PerC::isShow('main_info','branch','add',"addBranch" ) )
                        <button class="waves-effect btn">@lang('main.add') </button>
                    @endif
                </div>
            </div>
            <br/>
            <hr/>
            <!-- /عرض الفروع -->
                @if(PerC::isShow('main_info','branch','show'))
            @include('dashboard.company._branches_table_view')
                    @endif
        </div>
    </div>
    <!-- /Store Policies -->
    @endif

</section>
<!-- /Main Content -->


@stop