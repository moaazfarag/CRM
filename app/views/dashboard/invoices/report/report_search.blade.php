
@extends('dashboard.main')
@section('content')
        <!-- Main Content -->
<section class="content-wrap ecommerce-dashboard" ng-app="itemApp"  ng-controller="mainController">
    {{ Form::open(array('route'=>array('InvoiceReport',$type))) }}
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

                {{--branches start--}}
                @if($branch == 1)


                        <div class="col s6 l2">
                            {{ Form::select('br_id',array(null=>"اختر الفرع")+ $co_info->branches->lists('br_name','id'),null,array('id'=>'br_id')) }}
                            <p class="parsley-required">{{ $errors ->first('br_id') }} </p>
                        </div>
                @endif
                {{--branches end--}}

                {{--category--}}
                <div class="col s12 l2">

                    {{ Form::select('cat_id', array('' => 'اختر الفئة') + $co_info->cat->lists('name','id'),null,array('id'=>'cat_id')) }}

                    <p class="parsley-required">{{ $errors ->first('cat_id') }} </p>
                </div> {{--category--}}
                {{--end category --}}

                </div> <!-- end row -->

                <div class="row">

                 {{--account    --}}

                    <div class="col s12 l2">

                        {{ Form::select('account',array(null=>lang::get('main.select_account'))+ $account_type,null,array('id'=>'account','ng-required'=>'pay_type == "on_account"','ng-model'=>'account.type','ng-change'=>'getAccountsByType()')) }}
                        <p class="parsley-required">{{ $errors ->first('account') }} </p>
                    </div>{{--account--}}
                    <div ng_show="account.type" class="col s12 l2">

                        <select  name="account_id" ng-required='pay_type == "on_account"' ng-change='getAccountInfo()' ng-model="account.id"  class='browser-default'>
                            <option value="@{{ account.id }}" ng-repeat="account in accounts">@{{ account.acc_name }}</option>
                        </select>
                          <span style="color: red">
                              @{{ isLimit() }}
                          </span>
                        @{{  seletedAccount.pricing }}
                        {{--{{ Form::select('account',array(null=>"اختر   نوع الحساب ")+ $account_type,null,array('id'=>'account','ng-model'=>'account.type','ng-change'=>'getAccountsByType()','class'=>'browser-default')) }}--}}
                        <p class="parsley-required">{{ $errors ->first('account_id') }} </p>
                    </div>{{--account--}}


                 {{--end account--}}

                 {{--pay type --}}

                    <div class="col s2 l3">

                        {{ Form::select('pay_type',$pay_type,null,array('id'=>'pay_type','ng-model'=>'pay_type')) }}
                        <p class="parsley-required">{{ $errors ->first('pay_type') }} </p>
                    </div>
                    {{--end pay type--}}


                    {{--item --}}

                    <div class="col s2 l3">

                        {{ Form::select('item_id',array(null=>"اختر الصنف")+$items ,null,array('id'=>'item_id')) }}
                        <p class="parsley-required">{{ $errors ->first('item_id') }} </p>
                    </div>
                    {{--end item--}}

            </div>

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
    @if(Route::currentRouteName() == "prepMsHeader")
        @include('dashboard.hr.msheader._table_view');
    @endif
</section>
@stop

